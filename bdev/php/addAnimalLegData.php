<?php
$errMsg = "";
try {
		require_once("connectg3.php");
		
		
		$sql = "insert into leg (leg_no, leg_name, leg_img ,leg_jump, leg_environment1, leg_environment2, leg_environment3, leg_status, leg_ch_name) values (null, :leg_name, :leg_img, :leg_jump, :leg_environment1, :leg_environment2, :leg_environment3,:leg_status, :leg_ch_name)";
		$newleg = $pdo->prepare($sql);
		$newleg->bindValue(":leg_name",$_REQUEST['leg_name']);
		$newleg->bindValue(":leg_img",$_REQUEST['leg_img']);
		$newleg->bindValue(":leg_jump",$_REQUEST['leg_jump']);
		$newleg->bindValue(":leg_environment1",$_REQUEST['leg_environment1']);
		$newleg->bindValue(":leg_environment2",$_REQUEST['leg_environment2']);
		$newleg->bindValue(":leg_environment3",$_REQUEST['leg_environment3']);
		$newleg->bindValue(":leg_status",$_REQUEST['leg_status']);
		$newleg->bindValue(":leg_ch_name",$_REQUEST['leg_ch_name']);
		$newleg->execute();
		//取得自動創號的動物頭部號碼
        $leg_no = $pdo->lastInsertId();
        echo "新增動物頭部成功";
    	header('Location:animalLeg.php');
	} catch (PDOException $e) {
		$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
		$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
		// $pdo->rollback();
	}

?>