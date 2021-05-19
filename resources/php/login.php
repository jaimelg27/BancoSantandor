<?php
$db_host = "db5002502322.hosting-data.io:3306";
$db_user = "dbu431085";
$db_password = "Hormiga2015*";
$db_name = "dbs1991557";
$db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$db_connection) {
    die('No se ha podido conectar a la base de datos.');
}
$username = $_POST['id'];
$password = $_POST['password'];

$username = stripcslashes($username);
$password = stripcslashes($password);
$dni = mysqli_real_escape_string($db_connection, $username);
$password = mysqli_real_escape_string($db_connection, $password);

$sql = "SELECT * FROM clientes WHERE DNI = '$dni'and Password = '$password'";
$result = mysqli_query($db_connection, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count == 1) {
    session_start();
    $_SESSION['login_id'] = $dni;
    header("Location: ../../user/index.php");
} else {
    ?>
    <script language="javascript" type="text/javascript">
        alert('El DNI y/o la contraseña no es correcta.');
        window.location = '../../login.html';
    </script>
    <?php
}
?>


