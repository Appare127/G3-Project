<?php
$errMsg = "";
echo $_REQUEST['head_name'];
try{
  require_once("connectg3.php");
  $sql = "update head SET head_name=:head_name, head_img=:head_img, head_img_combination=:head_img_combination, head_environment1=:head_environment1, head_environment2=:head_environment2, head_environment3=:head_environment3, head_status=:head_status , head_ch_name=:head_ch_name WHERE head_no=:head_no";
  $animal_head = $pdo->prepare($sql);
  $animal_head->bindValue(":head_name",$_REQUEST['head_name']);
  $animal_head->bindValue(":head_img","");
  $animal_head->bindValue(":head_img_combination","");
  $animal_head->bindValue(":head_environment1",$_REQUEST['head_environment1']);
  $animal_head->bindValue(":head_environment2",$_REQUEST['head_environment2']);
  $animal_head->bindValue(":head_environment3",$_REQUEST['head_environment3']);
  $animal_head->bindValue(":head_status",$_REQUEST['head_status']);
  $animal_head->bindValue(":head_ch_name",$_REQUEST['head_ch_name']);
  $animal_head->bindValue(":head_no", $_REQUEST["head_no"]);
  $animal_head->execute();
  
      $head_name = $_REQUEST['head_name'];
      $head_no= $_REQUEST["head_no"];

			if( $_FILES["head_img"]["error"] == UPLOAD_ERR_OK){

				// 後台的存檔路徑
				$upload_dir = "../img/modify/";

				//實際寫進資料庫 給前台使用的路徑
				$save_directory = "img/modify/";

				//先檢查images資料夾存不存在
				if( file_exists("modify") === false){
					mkdir("modify");
				}

				//檔案名稱都要變成head_xxx.png
				$fileName = "head_" . $head_name .".png";
				$fileName2 = "p_head_" . $head_name .".png";

				//右側選單圖
				$from = $_FILES["head_img"]["tmp_name"];
				$to = "$upload_dir" . "$fileName";
				copy( $from, $to);

				// 左側組合圖
				$from = $_FILES["head_img_combination"]["tmp_name"];
				$to = "$upload_dir" . "$fileName2";
				copy( $from, $to);

				//將檔案名稱寫回資料庫
				$sql = "update head set head_img = :head_img,  head_img_combination= :head_img_combination where head_no = $head_no";
				$newHead = $pdo->prepare($sql);
				$newHead -> bindValue(":head_img", "$save_directory"."$fileName");
				$newHead -> bindValue(":head_img_combination", "$save_directory"."$fileName2");
				$newHead -> execute();
				echo "新增成功~";
			

			}else{
				echo "錯誤代碼 : {$_FILES["head_img"]["error"]} <br>";
				echo "新增失敗<br>";
			}

  if( $animal_head->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:animalHead.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>