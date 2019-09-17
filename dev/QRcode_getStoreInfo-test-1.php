<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>預約入場QRcode</title>
</head>
<body>
<?php
session_start();
try{
  //------------------------------------連線資料庫
  $dsn = "mysql:host=localhost;port=3306;dbname=dd102g3;charset=utf8";
  $user = "root";
  $password = "123456";
  $options=array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);
  $pdo = new PDO($dsn, $user, $password, $options);

  //假如有收到資料  就是改變資料庫(送來的訂單編號&狀態改成1(已入場)))
  if(isset($_POST['aaa'])){

  //找資料庫的資料 
    $revs=$pdo->prepare("select * from `resv_order` WHERE `resv_order`.`booking_no` = :booking_no and `resv_order`.`member_id` = :member_id ");
    $revs->bindValue(':member_id',1);//$_SESSION['user_no']
    $revs->bindValue(':booking_no',$_GET['booking_no']);
    $revs->execute();

    $revsRow = $revs->fetchObject(); 

    if($revsRow->resv_status=="1"){
      echo "您已入場過<br>";
      echo'<a href="member.php">回會員中心</a>';

    }else{

    //更新資料庫的資料 假如狀態以為1 就說您已入場過
    $revItems=$pdo->prepare("UPDATE `resv_order` SET `resv_status` = '1' WHERE `resv_order`.`booking_no` = :booking_no and `resv_order`.`member_id` = :member_id ");
    $revItems->bindValue(':member_id',1);//$_SESSION['user_no']
    $revItems->bindValue(':booking_no',$_GET['booking_no']);
    $revItems->execute();
    echo "異動成功~<br>";
    }

  //沒有收到資料  沒有要幹嘛
  }else{

    $aaa = $_GET['booking_no'];
?>
    <p><?="您的預約編號是  $aaa";?></p>
    <p><?="掃描成功";?></p>


    <form action="" method="post">
    <input type="hidden" name="aaa" value="<?=$aaa?>">
    <input type="submit" value="確定入場">
    </form>
<a href="member.php">回會員中心</a>
<?php
  }

}catch(PDOException $e){
  echo "錯誤訊息: ", $e->getMessage(), "<br>";
	echo "錯誤行號: ", $e->getLine(), "<br>";
}
?>  

</body>
</html>