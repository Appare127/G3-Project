<?php
$errMsg = '';

try {
	require_once('../connectg3.php');

    //INSERT INTO `favorite` (`user_no`, `work_no`, `favorite_status`) VALUES ('1', '3', '1');
  $loveItems=$pdo->prepare("INSERT INTO `favorite` (`user_no`, `work_no`, `favorite_status`) VALUES (:user_no, :work_no, '1')");  
//   $loveItems=$pdo->prepare("UPDATE `favorite` SET `favorite_status` = '0' WHERE `favorite`.`user_no` = :user_no AND `favorite`.`work_no` = :work_no;");
  

  $loveItems->bindValue(':user_no',$_REQUEST['user_no']);
  $loveItems->bindValue(':work_no',$_REQUEST['work_no']);
  $loveItems->execute();
  echo"異動成功";

} catch (PDOException $e) {

    $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
    $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
    echo $errMsg;
}

?>