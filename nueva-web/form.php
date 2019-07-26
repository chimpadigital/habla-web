<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //solo ingreso a este bloque de código si el método con el que solicita la página es POST
    $tiempoEspera = 3; //tiempo de espera para recargar la página (aplicado en la lógica de refresh)

    $origenNombre = 'Nueva cliente HABLA'; //nombre que visualiza el receptor del email como "origen" del email (es quien envía el email)
    $origenEmail = 'noreply@habla.com';//email que visualiza el receptor del email como "origen" del email (es quien envía el email)
    $destinatarioEmail = 'sprados@chimpancedigital.com.ar'.','.'quien@habla.com.ar'; //destinatario del email, o sea, a quien le estamos enviando el email

    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $empresa = $_POST['empresa'];

    
    $asuntoEmail = 'Nuevo cliente'; //asunto del email
    
    //cuerpo del email:
    $cuerpoMensaje = "Nombre: ".$nombre."\r\n";
    $cuerpoMensaje .= "DNI: ".$dni."\r\n";
    $cuerpoMensaje .= "Empresa: ".$empresa."\r\n";
    $cuerpoMensaje .= "Email: ".$email;
    //fin cuerpo del email.
    
    //cabecera del email (forma correcta de codificarla)
    $header = "From: " . $origenNombre . " <" . $origenEmail . ">\r\n";
    $header .= "Reply-To: " . $origenEmail . "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    // $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
    //armado del mensaje y attachment
    $mensaje .= $cuerpoMensaje . "\r\n\r\n";
    //envio el email y verifico la respuesta de la función "email" (true o false)
    if (mail($destinatarioEmail, $asuntoEmail, $mensaje, $header)) {
        echo 'Mensaje enviado!';
    } else {
        echo 'Error, no se pudo enviar el email';
    }
    // echo ', la página será recargada en ' . $tiempoEspera . ' segundos.';
    // echo '<meta http-equiv="refresh" content="' . $tiempoEspera . '">';
    exit();
}
?>
