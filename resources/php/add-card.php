<?php
session_start();
$db_host = "db5002502322.hosting-data.io:3306";
$db_user = "dbu431085";
$db_password = "Hormiga2015*";
$db_name = "dbs1991557";
$db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$db_connection) {
    die('No se ha podido conectar a la base de datos.');
}
//Obtenemos datos del cliente y el nombre que ha introducido para la cuenta en el formulario.
$dni = $_SESSION['login_id'];
$type = $_POST['type'];
$cardname = $_POST['cardname'];
$account=$_POST['account'];

if ($type=='debit'){
    $namecard="Debito";
} else if ($type=='credit'){
    $namecard="Credito";
}
$namecard .=" ".$cardname;

//Generamos numero de cuenta
$cadena_base = '0123456789';

$limite = strlen($cadena_base) - 1;

for ($i = 0; $i < 16; $i++)
    $cardnum .= $cadena_base[rand(0, $limite)];

//Consulta SQL
$sql = "INSERT INTO tarjetasbancarias VALUES ('$cardnum', '$namecard', '$dni', '$account')";

if ($db_connection->query($sql) === TRUE) { ?>
    <script language="javascript" type="text/javascript">
        alert('Tarjeta creada correctamente.');
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
