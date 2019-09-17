<?php
$errMsg = "";
try {
		require_once("connectg3.php");
		
		
		$sql = "insert into body (body_no, body_name, body_img ,body_health, body_environment1, body_environment2, body_environment3, body_status, body_ch_name) values (null, :body_name, :body_img, :body_health, :body_environment1, :body_environment2, :body_environment3,:body_status, :body_ch_name)";
		$newbody = $pdo->prepare($sql);
		$newbody->bindValue(":body_name",$_REQUEST['body_name']);
		$newbody->bindValue(":body_img",$_REQUEST['body_img']);
		$newbody->bindValue(":body_health",$_REQUEST['body_health']);
		$newbody->bindValue(":body_environment1",$_REQUEST['body_environment1']);
		$newbody->bindValue(":body_environment2",$_REQUEST['body_environment2']);
		$newbody->bindValue(":body_environment3",$_REQUEST['body_environment3']);
		$newbody->bindValue(":body_status",$_REQUEST['body_status']);
		$newbody->bindValue(":body_ch_name",$_REQUEST['body_ch_name']);
		$newbody->execute();
		//取得自動創號的動物頭部號碼
        $body_no = $pdo->lastInsertId();
        echo "新增動物頭部成功";
    	header('Location:animalBody.php');
	} catch (PDOException $e) {
		$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
		$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
		// $pdo->rollback();
	}

?>