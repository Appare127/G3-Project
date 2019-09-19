<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update tail SET tail_name=:tail_name, tail_img=:tail_img, tail_img_combination=:tail_img_combination,tail_status=:tail_status , tail_ch_name=:tail_ch_name WHERE tail_no=:tail_no";
  $animal_tail = $pdo->prepare($sql);
  $animal_tail->bindValue(":tail_name",$_REQUEST['tail_name']);
  $animal_tail->bindValue(":tail_img","");
  $animal_tail->bindValue(":tail_img_combination","");
  $animal_tail->bindValue(":tail_status",$_REQUEST['tail_status']);
  $animal_tail->bindValue(":tail_ch_name",$_REQUEST['tail_ch_name']);
  $animal_tail->bindValue(":tail_no", $_REQUEST["tail_no"]);
  $animal_tail->execute();
  
  $tail_name = $_REQUEST['tail_name'];
  $tail_no= $_REQUEST["tail_no"];

  if( $_FILES["tail_img"]["error"] == UPLOAD_ERR_OK){

    // 後台的存檔路徑
    $upload_dir = "../img/modify/";

    //實際寫進資料庫 給前台使用的路徑
    $save_directory = "img/modify/";

    //先檢查images資料夾存不存在
    if( file_exists("modify") === false){
        mkdir("modify");
    }

    //檔案名稱都要變成tail_xxx.png
    $fileName = "tail_" . $tail_name .".png";
    $fileName2 = "p_tail_" . $tail_name .".png";

    //右側選單圖
    $from = $_FILES["tail_img"]["tmp_name"];
    $to = "$upload_dir" . "$fileName";
    copy( $from, $to);

    // 左側組合圖
    $from = $_FILES["tail_img_combination"]["tmp_name"];
    $to = "$upload_dir" . "$fileName2";
    copy( $from, $to);

    //將檔案名稱寫回資料庫
    $sql = "update tail set tail_img = :tail_img,  tail_img_combination= :tail_img_combination where tail_no = $tail_no";
    $newtail = $pdo->prepare($sql);
    $newtail -> bindValue(":tail_img", "$save_directory"."$fileName");
    $newtail -> bindValue(":tail_img_combination", "$save_directory"."$fileName2");
    $newtail -> execute();
    echo "新增成功~";
			

    }else{
      echo "錯誤代碼 : {$_FILES["tail_img"]["error"]} <br>";
      echo "新增失敗<br>";
    }


  if( $animal_tail->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:animalTail.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>