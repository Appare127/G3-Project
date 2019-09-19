<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update leg SET leg_name=:leg_name, leg_img=:leg_img, leg_img_combination=:leg_img_combination, leg_jump=:leg_jump, leg_environment1=:leg_environment1, leg_environment2=:leg_environment2, leg_environment3=:leg_environment3, leg_status=:leg_status , leg_ch_name=:leg_ch_name WHERE leg_no=:leg_no";
  $animal_leg = $pdo->prepare($sql);
  $animal_leg->bindValue(":leg_name",$_REQUEST['leg_name']);
  $animal_leg->bindValue(":leg_img","");
  $animal_leg->bindValue(":leg_img_combination","");
  $animal_leg->bindValue(":leg_jump",$_REQUEST['leg_jump']);
  $animal_leg->bindValue(":leg_environment1",$_REQUEST['leg_environment1']);
  $animal_leg->bindValue(":leg_environment2",$_REQUEST['leg_environment2']);
  $animal_leg->bindValue(":leg_environment3",$_REQUEST['leg_environment3']);
  $animal_leg->bindValue(":leg_status",$_REQUEST['leg_status']);
  $animal_leg->bindValue(":leg_ch_name",$_REQUEST['leg_ch_name']);
  $animal_leg->bindValue(":leg_no", $_REQUEST["leg_no"]);
  $animal_leg->execute();
  
  $leg_name = $_REQUEST['leg_name'];
  $leg_no= $_REQUEST["leg_no"];

  if( $_FILES["leg_img"]["error"] == UPLOAD_ERR_OK){

    // 後台的存檔路徑
    $upload_dir = "../img/modify/";

    //實際寫進資料庫 給前台使用的路徑
    $save_directory = "img/modify/";

    //先檢查images資料夾存不存在
    if( file_exists("modify") === false){
        mkdir("modify");
    }

    //檔案名稱都要變成leg_xxx.png
    $fileName = "leg_" . $leg_name .".png";
    $fileName2 = "p_leg_" . $leg_name .".png";

    //右側選單圖
    $from = $_FILES["leg_img"]["tmp_name"];
    $to = "$upload_dir" . "$fileName";
    copy( $from, $to);

    // 左側組合圖
    $from = $_FILES["leg_img_combination"]["tmp_name"];
    $to = "$upload_dir" . "$fileName2";
    copy( $from, $to);

    //將檔案名稱寫回資料庫
    $sql = "update leg set leg_img = :leg_img,  leg_img_combination= :leg_img_combination where leg_no = $leg_no";
    $newleg = $pdo->prepare($sql);
    $newleg -> bindValue(":leg_img", "$save_directory"."$fileName");
    $newleg -> bindValue(":leg_img_combination", "$save_directory"."$fileName2");
    $newleg -> execute();
    echo "新增成功~";
			

    }else{
      echo "錯誤代碼 : {$_FILES["leg_img"]["error"]} <br>";
      echo "新增失敗<br>";
    }


  if( $animal_leg->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:animalLeg.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>