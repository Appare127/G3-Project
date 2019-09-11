<?php
try{
require_once('connectg3.php');
$date=$pdo->query('select * from resv_order');
$dateRow=$date->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($dateRow);


}catch (PDOException $e) {
	$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
	$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
}
?>