$(document).ready(function () {
    $('#submit-btn').click(function (e) {
        e.preventDefault(); // Evita el envío del formulario por defecto

        var form = $('#contact-form');
        var formData = form.serialize(); // Serializa los datos del formulario

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: formData
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