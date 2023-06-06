$(document).ready(function () {
    $('#contact-form').submit(function (e) {
        e.preventDefault(); // Evita el envío del formulario por defecto

        var nombre = $('#nombre').val();
        var correo = $('#correo').val();
        var telefono = $('#telefono').val();
        var expresion = /\w+@\w+\.+[a-z]/;

        if (nombre === "" || correo === "" || telefono === "") {
            alert("Todos los campos son obligatorios");
            return false;
        } else if (nombre.length > 30) {
            alert("El nombre es muy largo");
            return false;
        } else if (correo.length > 100) {
            alert("El correo es muy largo");
            return false;
        } else if (!expresion.test(correo)) {
            alert("El correo no es válido");
            return false;
        } else if (telefono.length > 10) {
            alert("El teléfono es muy largo");
            return false;
        } else if (isNaN(telefono)) {
            alert("El teléfono ingresado no es un número");
            return false;
        }

        var form = $(this);
        var formData = form.serialize(); // Serializa los datos del formulario

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: formData,
        })
            .done(function (response) {
                // Mostrar mensaje de éxito
                const exito = $('<p>').text('El mensaje se envió correctamente');
                exito.addClass('exito');
                form.append(exito);

                // Desaparece después de 5 segundos
                setTimeout(function () {
                    exito.remove();
                    location.reload();
                }, 5000);
            })
            .fail(function () {
                // Mostrar mensaje de error
                const error = $('<p>').text('Ocurrió un error al enviar el mensaje');
                error.addClass('error');
                form.append(error);

                // Desaparece después de 5 segundos
                setTimeout(function () {
                    error.remove();
                }, 5000);
            })
            .always(function () {
                // Limpiar los campos del formulario
                form.trigger('reset');
            });
    });
});
