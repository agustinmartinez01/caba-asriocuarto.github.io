<?php

require("class.phpmailer.php");
require("class.smtp.php");

$errorMSG = "";

if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}

if (empty($_POST["email"])) {
    $errorMSG = "Email is required ";
} else {
    $email = $_POST["email"];
}

if (empty($_POST["message"])) {
    $errorMSG = "Message is required ";
} else {
    $message = $_POST["message"];
}

// Valores enviados desde el formulario
if ( !isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["message"]) ) {
    $errorMSG = "Es necesario completar todos los datos del formulario";
}
$nombre = $_POST["name"];
$mensaje = $_POST["message"];
$email = $_POST["email"];
$mensajeFinal ="Correo PaginaWeb de ".$nombre." Email: ".$email."\n"." Mando el mensaje ". $mensaje;

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = " c1980739.ferozo.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "no-reply@c1980739.ferozo.com";  // Mi cuenta de correo
$smtpClave = "a4WQ3c74ic";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "cabañasriocuarto@gmail.com";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587; 
$mail->SMTPDebug = 3;
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario
$mail->AddReplyTo($email); // Esto es para que al recibir el correo y poner Responder, lo haga a la cuenta del visitante. 
$mail->Subject = "formulario de contacto"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensajeFinal);
$mail->Body = "{$mensajeHtml} <br /><br />Formulario de contacto<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n Formulario de contacto"; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

// send email

if ($mail->send()) {
    echo "success";
} else {
    echo "Fallo";
    
}


?>