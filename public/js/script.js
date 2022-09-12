$(function() {
    // Validate data form add equipment
    $(".form-add-equipment1").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            status: {
                required: true,
                number: true
            },
            category_id: {
                required: true,
                number: true
            },
            approve_level: {
                required: true,
                number: true
            },
            description: {
                maxlength: 255
            },
            image: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please types device's name",
                maxlength: "The device's name is too long. Please truncates your device's name!"
            },
            status: {
                required: "Please choose device's status",
                number: "Invalid device's status"
            },
            category_id: {
                required: "Please choose category",
                number: "Invalid category"
            },
            approve_level: {
                required: "Please choose approve level",
                number: "Invalid approve level"
            },
            description: {
                maxlength: "The device's description is too long. Please truncates your description!"
            },
            image: {
                required: "Please choose image of device"
            }
        }
    });
})