$(document).ready(function () {
    $('#formCreate-relacionesComunitarias').on('submit', add_relacionComunitaria_form);
    function add_relacionComunitaria_form(event) {
        // Prevenir que se envíe el formulario de forma tradicional
        event.preventDefault();

        let form = $(this),
            data = new FormData(form.get(0));
        // Obtener los valores de los campos del formulario
        let val_nombresApellidos = $('[name="namesSurnames"]', form).val();
        let val_direccion = $('[name="direction"]', form).val();
        let val_correoElectronico = $('[name="mail"]', form).val();
        let val_celular = $('[name="mobile"]', form).val();
        let val_organizacion = $('[name="organization"]', form).val();
        let val_acompañantes = $('[name="escort"]', form).val();
        let val_frasesMencionadas = $('[name="phrasesMentioned"]', form).val();
        let val_personasReferidas = $('[name="referredPeople"]', form).val();
        let val_sucesosEnTiempo = $('[name="eventsInTime"]', form).val();

        // Enviar la solicitud Ajax
        $.ajax({
            type: 'POST',
            url: 'controllers/controllerRelacionesComunitarias.php',
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: data,
            beforeSend: function () {
                form.waitMe();
            },
            success: function (response) {
                // La solicitud se ha completado con éxito
                // Procesar la respuesta del servidor
            },
            error: function (error) {
                // Hubo un error
            }
        }).done(function (res) {
            if (res.status === 201) {
                toastr.success(res.msg, '¡Bien!');
                //$('[name="name-product"]', form).val('');
            } else {
                toastr.error(res.msg, '¡Upss!');
            }
        }).fail(function (err) {
            toastr.error('Hubo un error en la petición', '¡Upss!');
        }).always(function () {
            form.waitMe('hide');
        });
    }
});