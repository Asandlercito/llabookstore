<?php
$sql_server="localhost";
$sql_database="bellecxo_llabookshop";
$sql_user="bellecxo_llabookshop";
$sql_password="JOcare526341@@";
$cjconnectcj = mysqli_connect($sql_server, $sql_user, $sql_password, $sql_database);
$cjusuario = "users";
$cjcompras = "plan_orders";
$cjconfpag = "admin_payment_settings";
if (mysqli_connect_errno()) {
    printf("Error al conectarse: %s\n", mysqli_connect_error());
    exit();
}

// Cargamos Requests y Culqi PHP
include_once 'Requests/library/Requests.php';
Requests::register_autoloader();
include_once 'culqi-php/lib/culqi.php';

// Configurar tu API Key y autenticacion
$sqsk = "SELECT id,value FROM ".$cjconfpag." WHERE id='28' ";
$cnfsk = mysqli_query($cjconnectcj, $sqsk);
$ressk = mysqli_num_rows($cnfsk);
if($ressk>0)
{
    $rowssk = mysqli_fetch_array($cnfsk);
    $cjllsk = $rowssk['value'];
}

$SECRET_KEY = "$cjllsk";
$culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));

//Crear Cliente
/* $culqi->Customers->create(
  array(
    "address" => "Av. Lima 123",
    "address_city" => "Lima",
    "country_code" => "PE",
    "email" => $_POST['email'],
    "first_name" => $_POST['nomu'],
    "last_name" => $_POST['nomu'],
    "phone_number" => 999999999
  )
); */

//Crear Cargo
$charge = $culqi->Charges->create(
 array(
     "amount" => $_POST['precio'],
     "currency_code" => "PEN",
     "description" => $_POST['producto'],
     "email" => $_POST['email'],
     "source_id" => $_POST['token']
   )
);

echo 'Correcto';

$cjorderid = strtoupper(str_replace('.', '', uniqid('', true)));
$nombreu = $_POST['nomu'];
$emailu = $_POST['email'];
$nmplan = $_POST['producto'];
$idplan = $_POST['idplan'];
$precio = $_POST['precio']/100;
$cupon = $_POST['ncup'];
$dscupon = $_POST['dscup'];
$currenc = "PEN";
$pystat = "succeeded";
$uid = $_POST['cju'];
$paytyp = $_POST['tipag'];
$fechpag = date("Y-m-d",time());

$cjinsrplan= mysqli_query($cjconnectcj, "INSERT INTO ".$cjcompras." (order_id,name,email,plan_name,plan_id,price,coupon,discount_price,price_currency,payment_status,user_id,payment_type,created_at,updated_at) VALUES ('$cjorderid','$nombreu','$emailu','$nmplan','$idplan','$precio','$cupon','$dscupon','$currenc','$pystat','$uid','$paytyp','$fechpag','$fechpag')");

//$cjupdtuser = mysqli_query($cjconnectcj, "UPDATE ".$cjusuario." SET group_id=$groupid WHERE id=$cjuserid");
                                
?>