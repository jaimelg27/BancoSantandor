<?php
$db_host = "db5002502322.hosting-data.io:3306";
$db_user = "dbu431085";
$db_password = "Hormiga2015*";
$db_name = "dbs1991557";
$db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$db_connection) {
    die('No se ha podido conectar a la base de datos.');
}
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = mysqli_real_escape_string($db_connection, $_POST['username']);
    $password = mysqli_real_escape_string($db_connection, $_POST['password']);

    $sql = "SELECT id FROM admin WHERE username = '$dni' and passcode = '$password'";
    $result = mysqli_query($db_connection, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['login_user'] = $dni;
        header("../../user/index.html");
    } else {
        $error = "Su DNI o contraseña es incorrecta.";
    }
}
?>


