<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>預約入場QRcode</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body class="bd_rev_qrcode">
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
  if(isset($_POST['booking_no'])){

  //找資料庫的資料 
    $revs=$pdo->prepare("select * from `resv_order` WHERE `resv_order`.`booking_no` = :booking_no and `resv_order`.`member_id` = :member_id ");
    $revs->bindValue(':member_id',1);//$_SESSION['user_no']
    $revs->bindValue(':booking_no',$_GET['booking_no']);
    $revs->execute();

    $revsRow = $revs->fetchObject(); 

    if($revsRow->resv_status=="1"){
      ?>
<div class="rev_qrcode_msg">
 
 <div class="msg_box">


   <p>您好，此會員已入場過</p>
   <p>若有問題請聯繫客服人員</p>
   <a href="member.php">回會員中心</a>

</div>

</div>


      <!-- echo "您已入場過<br>";
      echo'<a href="member.php">回會員中心</a>'; -->

  <?php
    }else{

    //更新資料庫的資料 假如狀態以為1 就說您已入場過
    $revItems=$pdo->prepare("UPDATE `resv_order` SET `resv_status` = '1' WHERE `resv_order`.`booking_no` = :booking_no and `resv_order`.`member_id` = :member_id ");
    $revItems->bindValue(':member_id',1);//$_SESSION['user_no']
    $revItems->bindValue(':booking_no',$_GET['booking_no']);
    $revItems->execute();
    ?>

<div class="rev_qrcode_msg">
 
 <div class="msg_box">

   <img class="success_pic" src="img/member/success.png" alt="success_pic">
   <p><?="您的預約編號是  $booking_no";?></p>
   <p><?="已到場"?></p>

   <div class="baic_btn">
          <a href="member.php" class="btn_cloud">回會員中心</a>
    </div>

</div>

</div>


    <?php


    // echo "異動成功~<br>";
    }

  //沒有收到資料  要秀出form
  }else{
    $booking_no = $_GET['booking_no'];
?>


<div class="rev_qrcode_msg">
 
    <div class="msg_box">

      <img class="success_pic" src="img/member/success.png" alt="success_pic">
      <p><?="您的預約編號是  $booking_no";?></p>
      <p><?="掃描成功";?></p>


      <form action="" method="post">
      <input type="hidden" name="booking_no" value="<?=$booking_no?>">

      <div class="qr_btn">

      <button  class="btn_cloud" value="submit"><p>確定入場</p>
        @@include('template/btn_sp.html')</button>

      </div>
    
      </form>

      <div class="baic_btn">
          <a href="member.php" class="btn_cloud">回會員中心</a>
      </div>
          
    

  </div>

</div>


<?php
  }
}catch(PDOException $e){
  echo "錯誤訊息: ", $e->getMessage(), "<br>";
	echo "錯誤行號: ", $e->getLine(), "<br>";
}
?>  

</body>
</html>