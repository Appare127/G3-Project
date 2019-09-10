<?php
try{
require_once('../connectg3.php');
$date=$pdo->query('select date_unavailable from unavailable_date');
$dateRow=[];
while($dateRow1=$date->fetch(PDO::FETCH_NUM)){
$dateRow =$dateRow + $dateRow1[0];
};
print_r( $dateRow);



}catch (PDOException $e) {
	$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
	$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
}
?>