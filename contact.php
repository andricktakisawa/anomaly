<?php
/*

   _ \    _ \ \ \        /  ____|   _ \   ____|  __ \       __ ) \ \   /     _ _|   \  |   ___|   _ \ __ __|  ____| 
  |   |  |   | \ \  \   /   __|    |   |  __|    |   |      __ \  \   /        |     \ |  |      |   |   |    __|   
  ___/   |   |  \ \  \ /    |      __ <   |      |   |      |   |    |         |   |\  |  |      |   |   |    |     
 _|     \___/    \_/\_/    _____| _| \_\ _____| ____/      ____/    _|       ___| _| \_| \____| \___/   _|   _____| 
                                                                                                   
 https://incote.click
 
 */

require_once __DIR__ . '/vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/*

   _ \    _ \ \ \        /  ____|   _ \   ____|  __ \       __ ) \ \   /     _ _|   \  |   ___|   _ \ __ __|  ____| 
  |   |  |   | \ \  \   /   __|    |   |  __|    |   |      __ \  \   /        |     \ |  |      |   |   |    __|   
  ___/   |   |  \ \  \ /    |      __ <   |      |   |      |   |    |         |   |\  |  |      |   |   |    |     
 _|     \___/    \_/\_/    _____| _| \_\ _____| ____/      ____/    _|       ___| _| \_| \____| \___/   _|   _____| 
                                                                                                   
 https://incote.click
 
 */

require "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = "andricktakizawa@gmail.com"; // correo electrónico de administrador
    $subject = "Mensaje de contacto";
    $name = $_POST['Name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sender  = "register@anomalyfestival.com";

    $sql = "INSERT INTO registros (nombre, email, telefono) VALUES ('$name', '$email', '$phone')";

    // Ejecutar la consulta
    if ($con->query($sql) === TRUE) {
        echo "Registro almacenado correctamente";
    } else {
        echo "Error al almacenar el registro: " . $con->error;
    }

    // Cerrar la conexión
    $con->close();

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = 'mail.anomalyfestival.com'; // servidor SMTP
        $mail->Username   = 'register@anomalyfestival.com'; // usuario de correo electrónico
        $mail->Password   = 'Anomaly2023*'; // contraseña de correo electrónico
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Configuración del mensaje de correo electrónico
        $mail->setFrom($sender, 'Anomaly');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "¡Hola! Alguien ha enviado un formulario de contacto desde Anomaly <br>" .
            "Nombre: " . $name . "<br>" .
            "Email: " . $email . "<br>" .
            "WhatsApp: " . $phone . "<br>";


        $mail->send();
        echo "Message has been sent";
    } catch (Exception $e) {
        echo "An error occurred while sending the message: " . $mail->ErrorInfo;
    }
}

/*

   _ \    _ \ \ \        /  ____|   _ \   ____|  __ \       __ ) \ \   /     _ _|   \  |   ___|   _ \ __ __|  ____| 
  |   |  |   | \ \  \   /   __|    |   |  __|    |   |      __ \  \   /        |     \ |  |      |   |   |    __|   
  ___/   |   |  \ \  \ /    |      __ <   |      |   |      |   |    |         |   |\  |  |      |   |   |    |     
 _|     \___/    \_/\_/    _____| _| \_\ _____| ____/      ____/    _|       ___| _| \_| \____| \___/   _|   _____| 
                                                                                                   
 https://incote.click
 
 */
