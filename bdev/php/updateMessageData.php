<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update message SET msg_status=:msg_status WHERE msg_no=:msg_no";
  $message = $pdo->prepare($sql);
  $message->bindValue(":msg_status",$_REQUEST['msg_status']);
  $message->bindValue(":msg_no",$_REQUEST['msg_no']);
  $message->execute(); 

  if( $message->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:message.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>