<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php 

  if(isset($_POST['aaa'])){
    try {
        session_start();
        $dsn = "mysql:host=localhost;port=3306;dbname=dd102g3;charset=utf8";
        $user = "root";
        $password = "123456";
        $options=array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);
        $pdo = new PDO($dsn, $user, $password, $options);
        
      $revItems=$pdo->prepare("UPDATE `resv_order` SET `resv_status` = '1' WHERE `resv_order`.`booking_no` = :booking_no and `resv_order`.`member_id` = :member_id ");
      $revItems->bindValue(':member_id',$_SESSION['user_no']);
      $revItems->bindValue(':booking_no',$_GET['candy']);
      $revItems->execute();
      echo"異動成功";

    } catch (PDOException $e) {
        $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
        $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
        echo $e;
    }


  }else{
      echo "掃描成功";
      echo "掃描成功";
      $aaa = $_GET['candy'];
      ?>
      
    <form action="" method="post">
    <input type="hidden" name="aaa" value="<?=$aaa?>">
    <input type="submit" value="確定入場">
    </form>
    <?php

    
  }

?>




</body>
</html>