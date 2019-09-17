<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update area SET area_name=:area_name, area_img=:area_img WHERE area_no=:area_no";
  $area = $pdo->prepare($sql);
  $area->bindValue(":area_name",$_REQUEST['area_name']);
  $area->bindValue(":area_img",$_REQUEST['area_img']);
  $area->bindValue(":area_no", $_REQUEST["area_no"]);
  $area->execute(); 

  if( $area->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:area.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>