$(document).on('click', '#btn-terminosCondiciones', function (e) {
    e.preventDefault();
    $('#md-terminosCondiciones').modal('show');
});

$(document).on('click', '#btnAceept-terminosCondiciones', function (e) {
    e.preventDefault();
    $("#check-terminosCondiciones").prop("checked", true);
});

$('input:radio[name=anonymityactCorruption]').change(function () {
    if (this.value == 'Si') {
        document.getElementById('form-denouncesAnonymity').style.display = 'none';
    }
    else if (this.value == 'No') {
        document.getElementById('form-denouncesAnonymity').style.display = 'block';
    }
});

// Restrincciones Formulario
document.getElementById("namesSurnames-actCorruption").addEventListener("input", (e) => {
    let value = e.target.value;
    e.target.value = value.replace(/[0-9]/g, "");
});
document.getElementById("dni-actCorruption").addEventListener("input", (e) => {
    let value = e.target.value;
    e.target.value = value.replace(/[^\d-]/g, "");
});
document.getElementById("cellphone-actCorruption").addEventListener("input", (e) => {
    let value = e.target.value;
    e.target.value = value.replace(/[^\d-]/g, "");
});

/* function setErrorFor(input, message) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    const formControl = input.parentElement;
    const div = formControl.querySelector('div');
    div.className = 'invalid-feedback';
    div.innerText = message;
}

function setSuccessFor(input) {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
    const formControl = input.parentElement;
    const div = formControl.querySelector('div');
    div.className = 'valid-feedback';
    div.innerText = '';
} */

$('#formCreate-actCorruption').on('submit', add_actCorruption_form);
// Agrega Producto
function add_actCorruption_form(e) {
    e.preventDefault();

    let form = $(this),
        data = new FormData(form.get(0));

    let val_nombresApellidos = $('[name="namesSurnames"]', form).val();
    let val_dni = $('[name="dni"]', form).val();
    let val_telefono = $('[name="cellphone"]', form).val();
    let val_direccion = $('[name="address"]', form).val();
    let val_correo = $('[name="email"]', form).val();
    let val_acceptedTerms = 0;

    if (document.getElementById('check-terminosCondiciones').checked) {
        val_acceptedTerms = 1;
    }

    data.append("acceptedTerms", val_acceptedTerms);

    /* if (val_nombresApellidos === '') {
        setErrorFor(val_nombresApellidos, 'No puede dejar el Nombre en blanco');
    } else {
        setSuccessFor(val_nombresApellidos);
    }
    for (var pair of data.entries()) {

        console.log(pair[0] + ', ' + pair[1]);

    } */

    /* console.table(data);
    console.log(data);
    console.log(data.entries()); */

    // AJAX
    $.ajax({
        url: 'controllers/controllerActoCorrupcion.php',
        type: 'post',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        data: data,
        beforeSend: function () {
            form.waitMe();
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
    })
}