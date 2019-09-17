<?php
$errMsg = "";
try {
		require_once("connectg3.php");
		
		
		$sql = "insert into tail (tail_no, tail_name, tail_img , tail_status, tail_ch_name) values (null, :tail_name, :tail_img, :tail_status, :tail_ch_name)";
		$newtail = $pdo->prepare($sql);
		$newtail->bindValue(":tail_name",$_REQUEST['tail_name']);
		$newtail->bindValue(":tail_img",$_REQUEST['tail_img']);
		$newtail->bindValue(":tail_status",$_REQUEST['tail_status']);
		$newtail->bindValue(":tail_ch_name",$_REQUEST['tail_ch_name']);
		$newtail->execute();
		//取得自動創號的動物頭部號碼
        $tail_no = $pdo->lastInsertId();
        echo "新增動物尾巴成功";
    	header('Location:animalTail.php');
	} catch (PDOException $e) {
		$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
		$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
		// $pdo->rollback();
	}

?>