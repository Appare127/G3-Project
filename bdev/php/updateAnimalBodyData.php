<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update body SET body_name=:body_name, body_img=:body_img, body_img_combination=:body_img_combination, body_health=:body_health, body_environment1=:body_environment1, body_environment2=:body_environment2, body_environment3=:body_environment3, body_status=:body_status , body_ch_name=:body_ch_name WHERE body_no=:body_no";
  $animal_body = $pdo->prepare($sql);
  $animal_body->bindValue(":body_name",$_REQUEST['body_name']);
  $animal_body->bindValue(":body_img",$_REQUEST['body_img']);
  $animal_body->bindValue(":body_img_combination",$_REQUEST['body_img_combination']);
  $animal_body->bindValue(":body_health",$_REQUEST['body_health']);
  $animal_body->bindValue(":body_environment1",$_REQUEST['body_environment1']);
  $animal_body->bindValue(":body_environment2",$_REQUEST['body_environment2']);
  $animal_body->bindValue(":body_environment3",$_REQUEST['body_environment3']);
  $animal_body->bindValue(":body_status",$_REQUEST['body_status']);
  $animal_body->bindValue(":body_ch_name",$_REQUEST['body_ch_name']);
  $animal_body->bindValue(":body_no", $_REQUEST["body_no"]);
  $animal_body->execute();
  
  $body_name = $_REQUEST['body_name'];
  $body_no= $_REQUEST["body_no"];

  if( $_FILES["body_img"]["error"] == UPLOAD_ERR_OK){

    // 後台的存檔路徑
    $upload_dir = "../img/modify/";

    //實際寫進資料庫 給前台使用的路徑
    $save_directory = "img/modify/";

    //先檢查images資料夾存不存在
    if( file_exists("modify") === false){
        mkdir("modify");
    }

    //檔案名稱都要變成body_xxx.png
    $fileName = "body_" . $body_name .".png";
    $fileName2 = "p_body_" . $body_name .".png";

    //右側選單圖
    $from = $_FILES["body_img"]["tmp_name"];
    $to = "$upload_dir" . "$fileName";
    copy( $from, $to);

    // 左側組合圖
    $from = $_FILES["body_img_combination"]["tmp_name"];
    $to = "$upload_dir" . "$fileName2";
    copy( $from, $to);

    //將檔案名稱寫回資料庫
    $sql = "update body set body_img = :body_img,  body_img_combination= :body_img_combination where body_no = $body_no";
    $newbody = $pdo->prepare($sql);
    $newbody -> bindValue(":body_img", "$save_directory"."$fileName");
    $newbody -> bindValue(":body_img_combination", "$save_directory"."$fileName2");
    $newbody -> execute();
    echo "新增成功~";
			

    }else{
      echo "錯誤代碼 : {$_FILES["body_img"]["error"]} <br>";
      echo "新增失敗<br>";
    }


  if( $animal_body->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:animalBody.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>