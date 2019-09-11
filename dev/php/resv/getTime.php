<?php
try{
    if($_GET['data'] == 'time'){
        require_once('connectg3.php');
        $time=$pdo->query('select * from resv_session_capacity');
        $timeRow=$time->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($timeRow);
    }else if($_GET['data'] == 'NumRemain'){
        require_once('connectg3.php');
        $NumRemain=$pdo->query('select * from resv_order');
        $NumRemainRow=$NumRemain->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($NumRemainRow); 
    }





}catch (PDOException $e) {
	$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
	$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
}
?>