<?php
session_start();
//Retrieve form data. 
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$nombre = ($_GET['nombre']) ? $_GET['nombre'] : $_POST['nombre'];
$email = ($_GET['email']) ?$_GET['email'] : $_POST['email'];
$empresa = ($_GET['empresa']) ?$_GET['empresa'] : $_POST['empresa'];
$dni = ($_GET['dni']) ?$_GET['dni'] : $_POST['dni'];

//flag to indicate which method it uses. If POST set it to 1

if ($_POST) $post=1;


//if the errors array is empty, send the mail
if (!$errors) {

	//recipient - replace your email here
	$to = 'quien@habla@gmail.com';	
	//sender - from the form
	$from = $nombre . ' <' . $email . '>';
	
	//subject and the html message
	$subject = 'Nueva consulta de ' . $nombre;	
	$message = 'Nombre: ' . $nombre . '<br/><br/>
		       E-mail: ' . $email . '<br/><br/>		
		       Empresa: ' . $empresa . '<br/><br/>
		       DNI: ' . $dni . '<br/><br/>';

	//send the mail
	$result = sendmail($to, $subject, $message, $from);
	
	//if POST was used, display the message straight away
	if ($_POST) {

		if ($result) {
			echo "Mensaje enviado";
		}else {
			echo "Error al actualizar";
		}
		
	//else if GET was used, return the boolean value so that 
	//ajax script can react accordingly
	//1 means success, 0 means failed
	} else {
		echo $result;	
	}

//if the errors array has values
} else {
	//display the errors message
	for ($i=0; $i<count($errors); $i++) echo $errors[$i] . '<br/>';
	echo '<a href="index.php">Volver</a>';
	exit;
}


//Simple mail function with HTML header
function sendmail($to, $subject, $message, $from) {
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: ' . $from . "\r\n";
	
	$result = mail($to,$subject,$message,$headers);
	
	if ($result) {
	echo "Mensaje enviado";
}else {
	echo "Error al actualizar";
}

}

?>