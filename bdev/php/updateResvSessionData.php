<?php
try{
  require_once("connectg3.php");
  $sql = "update resv_session_capacity SET start_time=:start_time, length=:length, max_capacity=:max_capacity WHERE session_no=:session_no";
  $resvSession = $pdo->prepare($sql);
  $resvSession->bindValue(":start_time", $_GET["start_time"]);
  $resvSession->bindValue(":length", $_GET["length"]);
  $resvSession->bindValue(":max_capacity", $_GET["max_capacity"]);
  $resvSession->bindValue(":session_no", $_GET["session_no"]);
  $resvSession->execute(); 

  if( $resvSession->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:resvSessionCapacity.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>