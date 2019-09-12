<?php 
$errMsg = "";
try {
    require_once('../connectg3.php');
    
  $members=$pdo->prepare('update user set user_name=:user_name,user_psw=:user_psw,user_tel=:user_tel,hint_answer=:hint_answer where user_id=:user_id');

  $members->bindValue(':user_id',$_GET["user_id"]);
  $members->bindValue(':user_name',$_GET["user_name"]);
  $members->bindValue(':user_psw',$_GET["user_psw"]);
  $members->bindValue(':user_tel',$_GET["user_tel"]);
  $members->bindValue(':hint_answer',$_GET["hint_answer"]);
  $members->execute();
  echo "異動成功~" ;

} catch (PDOException $e) {
	$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
    $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
    echo $errMsg;
}
?>   