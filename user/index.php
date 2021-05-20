<?php
session_start();

if (empty($_SESSION['login_id'])) {
    session_start();
    session_destroy();
    header("Location: ../login.html");
}
$dni = $_SESSION['login_id'];

$db_host = "db5002502322.hosting-data.io:3306";
$db_user = "dbu431085";
$db_password = "Hormiga2015*";
$db_name = "dbs1991557";
$db_table_name = "clientes";
$db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$db_connection) {
    die('No se ha podido conectar a la base de datos: ' . $db_connection->connect_error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario | Banco Santandor</title>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/ico" href="../resources/img/favicon.ico"/>
    <!--Stylesheets-->
    <link rel="stylesheet" href="../resources/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <!--Scripts-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../resources/js/cookies.js"></script>
    <script type="text/javascript" src="../resources/js/index-js.js"></script>
</head>
<body>
<header class="header">
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container"><a href="../index.html" class="navbar-brand text-uppercase font-weight-bold">Banco
                Santandor</a>
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="index.php" class="nav-link text-uppercase font-weight-bold">Inicio
                            <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a href="money.php" class="nav-link text-uppercase font-weight-bold">Sacar/Ingresar</a>
                    </li>
                    <li class="nav-item"><a href="transfer.php" class="nav-link text-uppercase font-weight-bold">Transferencias</a>
                    </li>
                    <li class="nav-item"><a href="branches-ATMs.php" class="nav-link text-uppercase font-weight-bold">Oficinas
                            y
                            Cajeros</a>
                    </li>
                    <li class="nav-item"><a href="contact.php"
                                            class="nav-link text-uppercase font-weight-bold">Contacto</a>
                    </li>
                    <li class="nav-item"><a href="../resources/php/logout.php"
                                            class="nav-link text-uppercase font-weight-bold">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="container">
    <div class="pt-5 text-white">
        <header class="py-5 mt-5">
            <h1 class="display-4">Bienvenido <?php
                $sql = "SELECT First_Name from clientes WHERE DNI='$dni'";
                $resultado = $db_connection->query($sql);
                $datos = $resultado->fetch_array();
                echo $datos['First_Name'] ?></h1>
            <p class="lead mb-0"> Su posición global:
            </p>
        </header>
        <hr>
        <p class="lead mb-0">Sus cuentas bancarias:</p>
        <form action="create-account.php">
            <input type="submit" value="Crea tu cuenta aqui!" class="btn btn-primary rounded-0 py-2 px-4"
                   style="float: right;">
        </form>
        <?php
        $sql = "SELECT * from cuentasbancarias WHERE Client='$dni'";
        $resultado2 = $db_connection->query($sql);
        ?>
        <table width="70%" align="center">
            <tr>
                <td align="center"><b>Número Cuenta</b></td>
                <td align="center"><b>Nombre Cuenta</b></td>
                <td align="center"><b>Saldo</b></td>
            </tr>
            <?php
            if (mysqli_num_rows($resultado2) == 0) {
                ?>
                <tr>
                    <td align="center" colspan="3">No dispone de ninguna cuenta bancaria.</td>
                </tr>
                <?php
            } else {
                while ($datos = $resultado2->fetch_array()) {
                    ?>
                    <tr>
                        <td align="center"><b><?php echo $datos["Account_Num"] ?></b></td>
                        <td align="center"><?php echo $datos["Nombre"] ?></td>
                        <?php if ($datos["Saldo"] == null) {
                            echo '<td align="center">No hay dinero</td>';
                        } else {
                            $money = $datos["Saldo"];
                            $number = (string)$money;
                            $format_number = str_replace('.', ',', $number);
                            if ($datos["Saldo"] < 0) {
                                echo '<td align="center" style="color: red">' . $format_number . " €" . '</td>';
                            } else {
                                echo '<td align="center">' . $format_number . " €" . '</td>';
                            }
                        } ?>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <hr>
        <p class="lead mb-0">Sus tarjetas:</p>
        <form action="create-cc.php">
            <input type="submit" value="Solicitar nueva tarjeta" class="btn btn-primary rounded-0 py-2 px-4"
                   style="float: right;">
        </form>
        <?php
        $sql = "SELECT * from tarjetasbancarias WHERE Client='$dni'";
        $resultado3 = $db_connection->query($sql);
        ?>
        <table width="70%" align="center">
            <tr>
                <td align="center"><b>Número Tarjeta</b></td>
                <td align="center"><b>Nombre Tarjeta</b></td>
                <td align="center"><b>Cuenta Asignada</b></td>
            </tr>
            <?php
            if (mysqli_num_rows($resultado3) == 0) {
                ?>
                <tr>
                    <td align="center" colspan="3">No dispone de ninguna tarjeta</td>
                </tr>
                <?php
            } else {
                while ($datos3 = $resultado3->fetch_array()) {
                    ?>
                    <tr>
                        <td align="center"><b><?php echo $datos3["Tarjeta_Num"] ?></b></td>
                        <td align="center"><?php echo $datos3["Nombre"] ?></td>
                        <td align="center"><?php echo $datos3["Account_Num"] ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <hr>
        <p class="lead mb-0">Sus préstamos:</p>
        <form action="">
            <input type="button" value="Solicitar Préstamo" class="btn btn-primary rounded-0 py-2 px-4"
                   style="float: right;">
        </form>
        <table width="70%" align="center">
            <tr>
                <td align="center"><b>Número Préstamo</b></td>
                <td align="center"><b>Razón Préstamo</b></td>
                <td align="center"><b>Pendiente Pago</b></td>
                <td align="center"><b>Total Préstamo</b></td>
            </tr>
            <tr>
                <td colspan="4" align="center">No hay préstamos solicitados.</td>
            </tr>
        </table>
    </div>
</div>
<footer class="social-footer">
    <center><p>Banco Santandor 2021-2021©</p></center>
</footer>
</body>
</html>