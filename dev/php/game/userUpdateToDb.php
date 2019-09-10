<?php
$errMsg = "";
//game_record = IF(:game_record >= game_record, game_record = :game_record, game_record )
try {
    require_once("connectBooks.php");
	$sql ="update user set game_money= game_money + :game_money, game_record = :game_record where user_no=:user_no";
    $userData = $pdo->prepare( $sql);
    $userData->bindValue(":game_money", $_REQUEST["game_money"]);
    $userData->bindValue(":game_record", $_REQUEST["game_record"]);
    $userData->bindValue(":user_no", $_REQUEST["user_no"]);
    $userData->execute();
    echo "遊戲紀錄更新成功";
}catch(PDOExeption $e){
    $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
    $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
 
}



?>