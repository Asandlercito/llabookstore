<?php
if (empty($_POST)) {
    echo "NADA";
}
$abc = $_POST['kr-answer'];
$data = json_decode($abc);
if($data->orderStatus == "PAID")
echo "PAGADO";
?>
