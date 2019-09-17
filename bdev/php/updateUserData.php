<?php
try{
  require_once("connectg3.php");
  $sql = "update user SET user_status=:user_status WHERE user_no=:user_no";
  $user = $pdo->prepare($sql);
  $user->bindValue(":user_status", $_GET["user_status"]);
  $user->bindValue(":user_no", $_GET["user_no"]);
  $user->execute(); 

  if( $user->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:user.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>