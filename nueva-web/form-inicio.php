<?php
require 'PHPMailerAutoload.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');
// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
//$email_to = "sdesigncba@gmail.com";
//$email_to = "carlosdanielgutierrez@gmail.com";


// $email_to ="info@ralseff.com";

$nombre = $_POST['name'];
$telefono = $_POST['phone'];
$mensaje = $_POST['message'];


$email_subject = "Consulta home Habla";
$email_subject2 = "Confirmación de trabajo Habla!";

// Aquí se deberían validar los datos ingresados por el usuario
if(!isset($_POST['name']) ||
!isset($_POST['phone']) ||
!isset($_POST['message'])) {

echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
die();
}

$email_message2 = "<h1>Detalles del formulario :</h1><br>";
$email_message2 .= "<p>Nombre: " . $_POST['name'] ."</p>";
$email_message2 .= "<p>Teléfono: " . $_POST['phone'] ."</p>";
$email_message2 .= "<p>Mensaje: " . $_POST['message'] ."</p>";


//inicio script grabar datos en csv
$fichero = 'consultas home.csv';//nombre archivo ya creado
//crear linea de datos separado por coma
$fecha=date("d-m-y H:i:s");
$linea = $fecha.";".$nombre.";".$telefono.";".$mensaje."\n";
// Escribir la linea en el fichero
file_put_contents($fichero, $linea, FILE_APPEND | LOCK_EX);
//fin grabar datos
// $message=$message.' local='.$local;
// $mail = new PHPMailer;
// $mail->isSMTP();

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 4;
$mail->Debugoutput = 'html';

$mail->Host = 'silex14web.com';
$mail->Port = 2525;
$mail->SMTPAuth = true;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->Username = 'quien-habla.com.ar';
$mail->Password = 'Habla753';
$mail->setFrom('quien@habla.com.ar', 'Habla');

$mail->addReplyTo('quien@habla.com.ar','Habla');

$mail->addAddress('sdesigncba@gmail.com','Habla');
// $mail->addCc('cristiancastro.pr1991@gmail.com','Clínica Santia Lucia');
// $mail->addCc('quirofanosantaluciasalta@gmail.com','Clínica Santia Lucia');
$mail->isHTML(true);
$mail->Subject = $email_subject;
$mail->Body    = $email_message2;
$mail->CharSet = 'UTF-8';
$mail->Send();


if (!$mail->send()) {
    $mail_enviado=false;
    $mail_error .= 'Mailer Error: '.$mail->ErrorInfo;
} else {
    $mail_enviado=true;
    $mail_error='Mensaje Enviado, Gracias';
}


echo $mail_enviado;

// if($mail_enviado)
// {
// echo "<script>location.href='gracias.html';</script>";

// }
// else
// {
// 	echo "no se pudo enviar" ;
// }




?>