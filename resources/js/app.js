import './bootstrap';

const showToast = (message, style = {}, callback = function(){}) => {
    Toastify({
        text: message,
        duration: 15000,
        newWindow: true,
        close: true,
        gravity: "bottom",
        position: "right",
        stopOnFocus: true,
        style: style,
        onClick: callback
    }).showToast();
}

window.showToast = showToast;

window.Echo.private(`booking-director`)
.listen('CreateBookingEvent', (e) => {
    const { booking } = e;
    const message = `Employee ${booking.employee.fullname} had just booked a device!`;

    showToast(message, { background: '#ff0000' }, function() {
        window.location.href = `${document.location.origin}/booking/all-booking/${booking.id}`;
    });
});

window.Echo.private(`booking-manager.${window.User.departmentId}`)
.listen('CreateBookingEvent', (e) => {
    const { booking } = e;
    const message = `Employee ${booking.employee.fullname} had just booked a device!`;

    showToast(message, { background: '#319DA0' }, function() {
        window.location.href = `${document.location.origin}/booking/department-booking/${booking.id}`;
    });
});

