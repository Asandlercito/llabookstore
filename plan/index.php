<?php
echo'<script>if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}</script>';
    require_once 'vendor/autoload.php';
    require_once 'keys.php';
    require_once 'helpers.php';
    
    $client = new Lyra\Client();
    $formAnswer = $client->getParsedFormAnswer();
    
    if (isset( $_REQUEST['o']) && isset( $_REQUEST['p']))
    {
    if ($formAnswer['kr-answer']['orderStatus'] == 'PAID') {
    $idudu = $_REQUEST['o'];
    $idprod = $_REQUEST['p'];
    $valcup = $_REQUEST['c'];
    
    $sql_server="localhost";
    $sql_database="bellecxo_llabookshop";
    $sql_user="bellecxo_llabookshop";
    $sql_password="JOcare526341@@";
    $cjconectst = mysqli_connect($sql_server, $sql_user, $sql_password, $sql_database);
    $cjusuario = "users";
    $cjplans = "plans";
    $cjcupon = "coupons";
    $cjcompras = "plan_orders";
    $cjconfpag = "admin_payment_settings";
    if (mysqli_connect_errno()) {
        printf("Error al conectarse: %s\n", mysqli_connect_error());
        exit();
    }
    $cjorderid = strtoupper(str_replace('.', '', uniqid('', true)));

    //sacar datos del usuario
    $sqsk = "SELECT id,name,email FROM ".$cjusuario." WHERE id=$idudu ";
    $cnfsk = mysqli_query($cjconectst, $sqsk);
    $ressk = mysqli_num_rows($cnfsk);
    if($ressk>0)
    {
        $rowssk = mysqli_fetch_array($cnfsk);
        $nombreu = $rowssk['name'];
        $emailu = $rowssk['email'];
    }
    //sacar datos del plan
    $sqsk = "SELECT id,name,price FROM ".$cjplans." WHERE id=$idprod ";
    $cnfsk = mysqli_query($cjconectst, $sqsk);
    $ressk = mysqli_num_rows($cnfsk);
    if($ressk>0)
    {
        $rowssk = mysqli_fetch_array($cnfsk);
        $nmplan = $rowssk['name'];
        $precio = $rowssk['price'];
    }
    $pystat = "succeeded";
    $paytyp = "Tarjeta Credito/Debito";
    $fechpag = date("Y-m-d",time());
    $currenc = "USD";
    
    $period = 2678400;
    $expires = (time()+$period);
    $cjexpdat = date("d-m-Y",$expires);
    
    if($valcup!=""){
        //sacar datos del cupon
        $sqsk = "SELECT code,discount FROM ".$cjcupon." WHERE code='$valcup' ";
        $cnfsk = mysqli_query($cjconectst, $sqsk);
        $ressk = mysqli_num_rows($cnfsk);
        if($ressk>0)
        {
            $rowssk = mysqli_fetch_array($cnfsk);
            $dscupon = ($rowssk['discount']*$precio)/100;
            $precio = $precio-$dscupon;
        }
        else{
        $valcup = "";
        $dscupon ="";
        }
    }
    else{
    $valcup = "";
    $dscupon ="";
    }
    $cjinsrplan= mysqli_query($cjconectst, "INSERT INTO ".$cjcompras." (order_id,name,email,plan_name,plan_id,price,coupon,discount_price,price_currency,payment_status,user_id,payment_type,created_at,updated_at) VALUES ('$cjorderid','$nombreu','$emailu','$nmplan','$idprod','$precio','$valcup','$dscupon','$currenc','$pystat','$idudu','$paytyp','$fechpag','$fechpag')");
    
    $cjinsrusr= mysqli_query($cjconectst, "UPDATE ".$cjusuario." SET plan='$idprod', plan_expire_date='$cjexpdat', requested_plan='$idprod' WHERE id=$idudu");
    
    echo '<!DOCTYPE html><html><head><script src="/assets/js/sweetalert.min.js"></script></head>';
    echo "<body><script>swal({title:'¡Gracias!', text: 'Se afilió con éxito al Plan ".$nmplan."', icon: 'success', button: 'Ok',}).then((value) => {window.location.replace('https://llabook.shop/plans');});</script></body></html>";
    }
    else
    {
        echo '<!DOCTYPE html><html><head><script src="/assets/js/sweetalert.min.js"></script></head>';
        echo "<body><script>swal({title:'¡Error!', text: 'Lo sentimos hubo un error.', icon: 'error', button: 'Ok',}).then((value) => {window.location.replace('https://llabook.shop/plans');});</script></body></html>";
    }
}

?>