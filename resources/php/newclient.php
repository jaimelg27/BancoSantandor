<?php

$db_host = "db5002502322.hosting-data.io:3306";
$db_user = "dbu431085";
$db_password = "Hormiga2015*";
$db_name = "dbs1991557";
$db_table_name = "clientes";
$db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$db_connection) {
    die('No se ha podido conectar a la base de datos: '.$db_connection->connect_error);
}

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname1=$_POST['lname1'];
$lname2=$_POST['lname2'];
$email=$_POST['email'];
$telephonenum=$_POST['telephonenum'];
$adress=$_POST['adress'];
$postalcode=$_POST['postalcode'];
$city=$_POST['city'];
$lname=$lname1." ".$lname2;
$to=$email;

//Generamos la contraseña aleatoria
$cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$cadena_base .= '0123456789' ;

$password = '';
$limite = strlen($cadena_base) - 1;

for ($i=0; $i < 10; $i++)
    $password .= $cadena_base[rand(0, $limite)];

$password_cifrada=password_hash($password, PASSWORD_DEFAULT, array("cost"=>10));

//Consulta SQL
$sql= "INSERT INTO clientes VALUES ('$id', '$fname', '$lname', '$adress', '$city', '$postalcode', '$password_cifrada', '$telephonenum', '$email')";

if ($db_connection->query($sql) === TRUE) { ?>
    <script language="javascript" type="text/javascript">
        alert('Registro correcto. Habrá recibido en su correo la contraseña de acceso.');
        window.location = '../../register.html';
    </script>
<?php
} else {?>
    <script language="javascript" type="text/javascript">
        alert('Ha ocurrido un error con el registro.');
        window.location = '../../register.html';
    </script>
<?php
}
$db_connection->close();

//Envio Correo Registro
$headers = "From: no-reply@bancosantandor.jaimelopez.es\r\n";
$headers .= "Reply to: contacto@bancosantandor.jaimelopez.es\r\n";
$headers .= "Bcc: contacto@bancosantandor.jaimelopez.es\r\n";

$subject="Su registro en Banco Santandor.";

$body_message="Bienvenido al Banco Santandor."."\n";
$body_message .="A continuacion le adjuntamos sus datos de acceso a la web:"."\n";
$body_message .="DNI: ".$id."\n";
$body_message .="Su contraseña es: ".$password."\n";
$body_message .="Gracias por confiar en Banco Santandor.";

mail($to, $subject, $body_message, $headers);
?>