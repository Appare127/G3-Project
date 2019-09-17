<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update body SET body_name=:body_name, body_img=:body_img, body_health=:body_health, body_environment1=:body_environment1, body_environment2=:body_environment2, body_environment3=:body_environment3, body_status=:body_status , body_ch_name=:body_ch_name WHERE body_no=:body_no";
  $animal_body = $pdo->prepare($sql);
  $animal_body->bindValue(":body_name",$_REQUEST['body_name']);
  $animal_body->bindValue(":body_img",$_REQUEST['body_img']);
  $animal_body->bindValue(":body_health",$_REQUEST['body_health']);
  $animal_body->bindValue(":body_environment1",$_REQUEST['body_environment1']);
  $animal_body->bindValue(":body_environment2",$_REQUEST['body_environment2']);
  $animal_body->bindValue(":body_environment3",$_REQUEST['body_environment3']);
  $animal_body->bindValue(":body_status",$_REQUEST['body_status']);
  $animal_body->bindValue(":body_ch_name",$_REQUEST['body_ch_name']);
  $animal_body->bindValue(":body_no", $_REQUEST["body_no"]);
  $animal_body->execute(); 

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