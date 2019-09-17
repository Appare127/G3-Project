<?php
$errMsg = "";
try {
		require_once("connectg3.php");
		
		
		$sql = "insert into area (area_no, area_name, area_img) values (null, :area_name, :area_img)";
		$newarea = $pdo->prepare($sql);
		$newarea->bindValue(":area_name",$_REQUEST['area_name']);
		$newarea->bindValue(":area_img",$_REQUEST['area_img']);
		$newarea->execute();
		//取得自動創號的地區號碼
        $area_no = $pdo->lastInsertId();
        echo "新增地區成功";
    	header('Location:area.php');
	} catch (PDOException $e) {
		$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
		$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
		// $pdo->rollback();
	}

?>