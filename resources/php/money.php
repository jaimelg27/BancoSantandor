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
$dni = $_SESSION['login_id'];
$selected_process=$_POST['type'];
$money=$_POST['money'];
$selected_account=$_POST['account'];

if ($selected_process=='save'){

} else if ($selected_process=='out'){
    $sql = "SELECT * from cuentasbancarias WHERE Account_Num='$selected_account'";
    $resultado = $db_connection->query($sql);
    $datos=$resultado->fetch_array();
    if($datos['Saldo']<0){?>
        <script language="javascript" type="text/javascript">
            alert('Su cuenta se encuentra en numeros rojos. No puede sacar dinero.');
            window.location = '../../user/money.php';
        </script>
    <?php } else {

        }

    }
}

