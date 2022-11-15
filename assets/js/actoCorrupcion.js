$(window).on('load', function () {
    $('#mdNotification').modal('show');
});

$(document).on('click', '#btn-terminosCondiciones', function (e) {
    e.preventDefault();
    $('#md-terminosCondiciones').modal('show');
});