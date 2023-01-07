$(document).ready(function () {
    $('#formCreate-laborClaim').on('submit', add_reclamoLaborale_form);
    function add_reclamoLaborale_form(event) {
        // Prevenir que se envíe el formulario de forma tradicional
        event.preventDefault();

        let form = $(this),
            data = new FormData(form.get(0));
        // Obtener los valores de los campos del formulario
        let val_nombresApellidos = $('[name="namesSurnames"]', form).val();
        let val_cargo = $('[name="position"]', form).val();
        let val_correoElectronico = $('[name="email"]', form).val();
        let val_celular = $('[name="phone"]', form).val();
        let val_situacionLaboral = $('[name="employmentSituation"]', form).val();
        let val_asunto = $('[name="matter"]', form).val();

        // Enviar la solicitud Ajax
        $.ajax({
            type: 'POST',
            url: 'controllers/controllerReclamoLaboral.php',
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