<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update head SET head_name=:head_name, head_img=:head_img, head_environment1=:head_environment1, head_environment2=:head_environment2, head_environment3=:head_environment3, head_status=:head_status , head_ch_name=:head_ch_name WHERE head_no=:head_no";
  $animal_head = $pdo->prepare($sql);
  $animal_head->bindValue(":head_name",$_REQUEST['head_name']);
  $animal_head->bindValue(":head_img",$_REQUEST['head_img']);
  $animal_head->bindValue(":head_environment1",$_REQUEST['head_environment1']);
  $animal_head->bindValue(":head_environment2",$_REQUEST['head_environment2']);
  $animal_head->bindValue(":head_environment3",$_REQUEST['head_environment3']);
  $animal_head->bindValue(":head_status",$_REQUEST['head_status']);
  $animal_head->bindValue(":head_ch_name",$_REQUEST['head_ch_name']);
  $animal_head->bindValue(":head_no", $_REQUEST["head_no"]);
  $animal_head->execute(); 

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