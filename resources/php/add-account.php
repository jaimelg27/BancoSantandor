<?php
session_start();
$db_host = "db5002502322.hosting-data.io:3306";
$db_user = "dbu431085";
$db_password = "BancoSantandor";
$db_name = "dbs1991557";
$db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$db_connection) {
    die('No se ha podido conectar a la base de datos.');
}
//Obtenemos datos del cliente y el nombre que ha introducido para la cuenta en el formulario.
$dni = $_SESSION['login_id'];
$accountname = $_POST['accountname'];

//Generamos numero de cuenta
$cadena_base = '0123456789';
$accountnum = 'ES';

$limite = strlen($cadena_base) - 1;

for ($i = 0; $i < 20; $i++)
    $accountnum .= $cadena_base[rand(0, $limite)];

//Consulta SQL
$sql = "INSERT INTO cuentasbancarias VALUES ('$accountnum', '$accountname', null, '$dni')";

if ($db_connection->query($sql) === TRUE) { ?>
    <script language="javascript" type="text/javascript">
        alert('Cuenta creada correctamente.');
        window.location = '../../user/index.php';
    </script>
    <?php
} else { ?>
    <script language="javascript" type="text/javascript">
        alert('Ha ocurrido un error con el registro.');
        window.location = '../../user/index.php';
    </script>
    <?php
}
$db_connection->close();
