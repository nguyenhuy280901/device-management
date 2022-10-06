$(function() {
    $("#load-pemissions").click(function(event) {
        let role_id = $("select[name=role_id]").val();

        if(role_id === "")
        {
            window.showToast('Please choose a role!', {background: '#FF4A4A'});
            return;
        }

        displayLoadingButton();

        $.ajax({
            url: `${document.location.origin}/authorize/${role_id}`
        }).then(function(permissions) {
            if(permissions !== null)
            {
                $("input.permission-check").prop('checked', false);
                $("input.permission-check").prop('disabled', false);
                $("#update-permissions").prop('disabled', false);
                $("#reset").prop('disabled', false);

                permissions.forEach(permission => {
                    $(`input.permission-check[value=${permission.id}]`).prop('checked', true);
                });
            }
            displayLoadingButton(false);
        });
    });

    $("select[name=role_id]").change(function(event) {
        $("input.permission-check").prop('checked', false);
        $("input.permission-check").prop('disabled', true);
        $("#update-permissions").prop('disabled', true);
        $("#reset").prop('disabled', true);
    });

    $("#update-permissions").click(function(event) {
        displayUpdatingButton();

        let role_id = $("select[name=role_id]").val();
        let permissions = $(".form-check input:checkbox:checked").map(function(){
            return $(this).val();
        }).get();

        if(role_id === "")
        {
            window.showToast('Please choose a role!', {background: '#FF4A4A'});
            return;
        }

        console.log(permissions);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${document.location.origin}/authorize/${role_id}`,
            method: 'PUT',
            data: {
                permissions: permissions,
                role_id: role_id
            }
        }).then(function(response) {
            displayUpdateResult(response);

            displayUpdatingButton(false);
            $("#update-permissions").prop('disabled', true);
            $("#reset").prop('disabled', true);
        });
    });

    $('#reset').click(function(event) {
        $("input.permission-check").prop('checked', false);
    });
});

function displayLoadingButton(isLoading = true)
{
    let content = isLoading ?
    `
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading ...
    ` :
    'Load Permissions';

    $("#load-pemissions").prop('disabled', isLoading);
    $("#load-pemissions").html(content);
}

function displayUpdatingButton(isUpdating = true)
{
    let content = isUpdating ?
    `
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Updating ...
    ` :
    'Update Permissions';

    $("#update-permissions").prop('disabled', isUpdating);
    $("#update-permissions").html(content);
    $("#reset").attr('disabled', isUpdating);
}

function displayUpdateResult(result)
{
    const { status, message, data } = result;
    const style = {
        background: status === 'success' ? '#319DA0' : '#FF4A4A'
    };

    $("div.result").addClass(status === 'success' ? 'bg-success' : 'bg-danger');
    $("div.result .result-message").text(message);

    window.showToast(message, style);

    if(data.permissions != null)
    {
        data.permissions.forEach(permission => {
            $(`input.permission-check[value=${permission.id}]`).prop('checked', true);
        });
    }

    $("input.permission-check").prop('disabled', true);
}