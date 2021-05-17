<?php
if (isset($_POST['email'])) {

    <
    bold >// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias</bold>
    $email_to = "contacto@bancosantandor.jaimelopez.es";
    $email_subject = "Contacto de "$_POST['nombre'];

    <
    bold >// Aquí se deberían validar los datos ingresados por el usuario</bold>
if (!isset($_POST['nombre']) ||
    !isset($_POST['email']) ||
    !isset($_POST['asunto']) ||
    !isset($_POST['comments'])) {

    echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
    echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
    die();
}

$email_message = "Detalles del formulario de contacto:\n\n";
$email_message .= "Nombre: " . $_POST['first_name'] . "\n";
$email_message .= "Apellido: " . $_POST['last_name'] . "\n";
$email_message .= "E-mail: " . $_POST['email'] . "\n";
$email_message .= "Teléfono: " . $_POST['telephone'] . "\n";
$email_message .= "Comentarios: " . $_POST['comments'] . "\n\n";


<$email_from =;bold >// Ahora se envía el e-mail usando la función mail() de PHP</bold>
    $headers = 'From: ' . $email_from . "\r\n" .
        'Reply-To: ' . $email_from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);

echo "¡El formulario se ha enviado con éxito!";
}
?>