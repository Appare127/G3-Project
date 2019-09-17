<?php
$errMsg = "";
try {
		require_once("connectg3.php");

		
			$sql = "insert into head (head_no, head_name, head_img ,head_environment1, head_environment2, head_environment3, head_status, head_ch_name) values (null, :head_name, '', :head_environment1, :head_environment2, :head_environment3,:head_status, :head_ch_name)";
			$newHead = $pdo->prepare($sql);
			$newHead->bindValue(":head_name",$_REQUEST['head_name']);
			$newHead->bindValue(":head_environment1",$_REQUEST['head_environment1']);
			$newHead->bindValue(":head_environment2",$_REQUEST['head_environment2']);
			$newHead->bindValue(":head_environment3",$_REQUEST['head_environment3']);
			$newHead->bindValue(":head_status",$_REQUEST['head_status']);
			$newHead->bindValue(":head_ch_name",$_REQUEST['head_ch_name']);
			$newHead->execute();
		
			//取得自動創號的動物頭部號碼
			$head_no = $pdo->lastInsertId();
			echo "新增動物頭部成功";
			header('Location:animalHead.php');
			$head_name = $_REQUEST['head_name'];

			if( $_FILES["head_img"]["error"] == UPLOAD_ERR_OK){

				// 後台的存檔路徑
				$upload_dir = "../img/modify/";

				//實際寫進資料庫 給前台使用的路徑
				$save_directory = "img/modify/";

				//先檢查images資料夾存不存在
				if( file_exists("modify") === false){
					mkdir("modify");
				}


				//將檔案copy到要放的路徑
				$fileInfoArr = pathinfo($_FILES["head_img"]["name"]);
				$fileName = "{$head_name}.{$fileInfoArr["extension"]}";
				// $fileName = "{$head_img}";

				$from = $_FILES["head_img"]["tmp_name"];
				$to = "$upload_dir" . "$fileName";
				copy( $from, $to);

				//將檔案名稱寫回資料庫
				$sql = "update head set head_img = :head_img where head_no = $head_no";
				$newHead = $pdo->prepare($sql);
				$newHead -> bindValue(":head_img", "$save_directory"."$fileName");
				$newHead -> execute();
				echo "新增成功~";
			

			}else{
				echo "錯誤代碼 : {$_FILES["head_img"]["error"]} <br>";
				echo "新增失敗<br>";
			}

}catch (PDOException $e) {
	$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
	$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
	echo $errMsg;
	// $pdo->rollback();
}


?>