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
$dni = $_SESSION['login_id'];
$selected_account = $_POST['account'];
$money = $_POST['money'];
$destination_account = $_POST['destinationaccount'];

//Comprobamos que la cuenta de origen no este a 0 o tenga saldo nulo
$sql0 = "SELECT * from cuentasbancarias WHERE Account_Num='$selected_account'";
$resultado0 = $db_connection->query($sql0);
$datos0 = $resultado0->fetch_array();
if (($datos0['Saldo'] <= 0) or ($datos0['Saldo'] == null) or ($datos0['Saldo']-$money<=0)) {
    ?>
    <script language="javascript" type="text/javascript">
        alert('Su cuenta se encuentra en numeros rojos, no ha introducido dinero o no dispone del dinero suficiente. No puede realizar transferencias.');
        window.location = '../../user/transfer.php';
    </script>
<?php }
else if ($selected_account==$destination_account){
    ?>
    <script language="javascript" type="text/javascript">
        alert('No puede realizar transferencia a la misma cuenta de origen.');
        window.location = '../../user/transfer.php';
    </script>
    <?php
}
//Si es valida procedemos a la transferencia
else {
    $sql1="SELECT * from cuentasbancarias WHERE Account_Num='$destination_account'";
    $resultado1=$db_connection->query($sql1);
    $datos1=$resultado1->fetch_array();
    if($datos1['Saldo']==null){
        $sql="UPDATE cuentasbancarias SET saldo = 0 where Account_Num='$destination_account'";
        $db_connection->query($sql);
    }

    $sql2 = "UPDATE cuentasbancarias SET saldo = saldo - '$money' where Account_Num='$selected_account'";
    $db_connection->query($sql2);
    $sql3 = "UPDATE cuentasbancarias SET saldo = saldo + '$money' where Account_Num='$destination_account'";
    if ($db_connection->query($sql3) == TRUE) {
        ?>
        <script language="javascript" type="text/javascript">
            alert('Ha realizado la transferencia correctamente.');
            window.location = '../../user/index.php';
        </script>
        <?php

    } else { ?>
        <script language="javascript" type="text/javascript">
            alert('Ha habido algun problema.');
            window.location = '../../user/transfer.php';
        </script>
        <?php
    }
}
