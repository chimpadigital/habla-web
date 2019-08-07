<?php
require 'PHPMailerAutoload.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');
// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
//$email_to = "sdesigncba@gmail.com";
//$email_to = "carlosdanielgutierrez@gmail.com";


// $email_to ="info@ralseff.com";

$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$empresa = $_POST['empresa'];


$email_subject = "Confirmación de trabajo Habla!";
$email_subject2 = "Confirmación de trabajo Habla!";

// Aquí se deberían validar los datos ingresados por el usuario
if(!isset($_POST['nombre']) ||
    !isset($_POST['dni']) ||
    !isset($_POST['email']) ||
    !isset($_POST['empresa'])) {
        
        echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
        echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
        die();
    }
    
    $email_message = "Confirmación de terminos y condiciones :\n\n";
    $email_message .= "<p>Este es un mail de confirmación aceptando las bases y condiciones de trabajo estipuladas por Habla! a nombre de: </p>";
    $email_message .= "<p>Nombre y Apellido: " . $_POST['nombre'] . "</p>";
    $email_message .= "<p>Gracias por elegirnos</p>";
    $email_message .= "<h5>Habla!</h5>";
    $email_message2 = "<h1>Detalles del formulario :</h1><br>";
    $email_message2 .= "<p>Nombre y Apellido: " . $_POST['nombre'] ."</p>";
    $email_message2 .= "<p>Mail: " . $_POST['email'] ."</p>";
    $email_message2 .= "<p>DNI: " . $_POST['dni'] ."</p>";
    $email_message2 .= "<p>Empresa: " . $_POST['empresa'] ."</p>";
    
    
    //inicio script grabar datos en csv
    $fichero = 'terminos y condiciones aceptados.csv';//nombre archivo ya creado
    //crear linea de datos separado por coma
    $fecha=date("d-m-y H:i:s");
    $linea = $fecha.";".$name.";".$email.";".$dni.";".$empresa."\n";
    // Escribir la linea en el fichero
    file_put_contents($fichero, $linea, FILE_APPEND | LOCK_EX);
    //fin grabar datos
    // $message=$message.' local='.$local;
    // $mail = new PHPMailer;
    // $mail->isSMTP();
    
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
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
    if(!$mail->send()) {
        $mail_enviado=false;
    } else {
        $mail_enviado=true;
    }
    
    $mail->ClearAllRecipients();
    
    $mail2 = new PHPMailer(true);
    $mail2->isSMTP();
    $mail2->Host = 'silex14web.com';
    $mail2->Port = 2525;
    $mail2->SMTPAuth = true;
    $mail2->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail2->Username = 'quien-habla.com.ar';
    $mail2->Password = 'Habla753';
    
    $mail2->setFrom('quien@habla.com.ar', 'Habla');
    $mail2->addReplyTo('quien@habla.com.ar','Habla');
    $mail2->addAddress ($email);
    $mail2->isHTML(true);
    $mail2->Subject = $email_subject2;
    $mail2->Body    = $email_message;
    $mail2->CharSet = 'UTF-8';
    if(!$mail2->send()) {
        $mail_enviado=false;
    } else {
        $mail_enviado=true;
    }
    
    
    
    // Ahora se envía el e-mail usando la función mail() de PHP
    //$headers = 'From: Ralseff <info@ralseff.com>' . "\r\n" .
    //    'Reply-To: noreply@ralseff.com' . "\r\n" .
    //    'Cc: ralseff@chimpancedigital.com.ar' . "\r\n" .
    //    'X-Mailer: PHP/' . phpversion();
    //$mail_enviado = @mail($email_to, utf8_decode($email_subject), utf8_decode($email_message), $headers);
    
    
    if($mail_enviado)
    {
        echo "<script>location.href='gracias.html';</script>";
        
    }
    else
    {
        echo "no se pudo enviar" ;
    }
    
    // Envia un e-mail para el remitente, agradeciendo la visita en el sitio, y diciendo que en breve el e-mail sera respondido.
    // $mensaje2  = "Hola" . $_POST['name'] . ". Gracias por contactarnos. Un asesor se comunicará con usted a la brevedad...";
    // $mensaje2 .= "PD - No es necesario responder este mensaje.";
    // $envia =  mail($_POST['email'],"Su mensaje fué recibido!",$mensaje2,$headers);
    
    
    
    ?>