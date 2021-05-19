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
$selected_account=$_POST['account'];
$money=$_POST['money'];
$destination_account=$_POST['destinationaccount'];

$sql = "SELECT * from cuentasbancarias WHERE Account_Num='$selected_account'";
$resultado = $db_connection->query($sql);
$datos=$resultado->fetch_array();
if(($datos['Saldo']<=0) and ($datos['Saldo']==null)){?>
    <script language="javascript" type="text/javascript">
        alert('Su cuenta se encuentra en numeros rojos o no ha introducido dinero. No puede realizar transferencias.');
        window.location = '../../user/transfer.php';
    </script>
<?php } else {
    $sql2= "UPDATE cuentasbancarias SET saldo = saldo - '$money' where Account_Num='$selected_account'";
    $sql4 = "SELECT * from cuentasbancarias WHERE Account_Num='$destination_account'";
    $resultado4 = $db_connection->query($sql4);
    $datos4=$resultado->fetch_array();
    if($datos4['Saldo']==null){
        $sql="UPDATE cuentasbancarias SET saldo = '0' where Account_Num='$destination_account'";
        $db_connection->query($sql);
    }
    $sql3= "UPDATE cuentasbancarias SET saldo = saldo + '$money' where Account_Num='$destination_account'";
    $db_connection->query($sql2);
    if ($db_connection->query($sql3)==TRUE){?>
        <script language="javascript" type="text/javascript">
            alert('Ha realizado la transferencia correctamente.');
            window.location = '../../user/index.php';
        </script>
        <?php

    } else {?>
        <script language="javascript" type="text/javascript">
            alert('Ha habido algun problema.');
            window.location = '../../user/transfer.php';
        </script>
        <?php
    }
}
