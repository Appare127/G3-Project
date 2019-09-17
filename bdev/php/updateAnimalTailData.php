<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update tail SET tail_name=:tail_name, tail_img=:tail_img, tail_status=:tail_status , tail_ch_name=:tail_ch_name WHERE tail_no=:tail_no";
  $animal_tail = $pdo->prepare($sql);
  $animal_tail->bindValue(":tail_name",$_REQUEST['tail_name']);
  $animal_tail->bindValue(":tail_img",$_REQUEST['tail_img']);
  $animal_tail->bindValue(":tail_status",$_REQUEST['tail_status']);
  $animal_tail->bindValue(":tail_ch_name",$_REQUEST['tail_ch_name']);
  $animal_tail->bindValue(":tail_no", $_REQUEST["tail_no"]);
  $animal_tail->execute(); 

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