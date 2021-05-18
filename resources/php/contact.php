<?php
$field_name = $_POST['name'];
$field_email = $_POST['email'];
$field_message = $_POST['message'];

$mail_to = 'contacto@bancosantandor.jaimelopez.es';
$subject = 'Nuevo mensaje de contacto desde la web';

$body_message = 'De: '.$field_name."\n";
$body_message .= 'Correo Electronico: '.$field_email."\n";
$body_message .= 'Mensaje: '.$field_message;

$headers = 'De: '.$field_email."\r\n";
$headers .= 'Responder a: '.$field_email."\r\n";

$mail_status = mail($mail_to, $subject, $body_message, $headers);

if ($mail_status) { ?>
    <script language="javascript" type="text/javascript">
        alert('Mensaje enviado');
        window.location = '#';
    </script>
    <?php
}
else { ?>
    <script language="javascript" type="text/javascript">
        alert('Ha habido un problema al enviar el mensaje.');
        window.location = '#';
    </script>
    <?php
}
?>