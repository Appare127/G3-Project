<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
    $revs->bindValue(':member_id',$_SESSION['user_no']);//$_SESSION['user_no']
    $revs->bindValue(':booking_no',$_GET['booking_no']);
    $revs->execute();
    // if( $revs->rowCount() == 0){
    //   exit( "not found");
    // }
    $revsRow = $revs->fetchObject(); 

    //更新資料庫的資料 假如狀態以為1 就說您已入場過
    if($revsRow->resv_status=="1"){
      ?>
    <div class="rev_qrcode_msg">
      <div class="msg_box">
      <div class="color_box"></div>
      <img class="exclamation_pic" src="img/member/exclamation-mark.png" alt="exclamation_pic">

      <p>您好，此會員已入場過</p>
      <p>若有問題請洽客服人員</p>

      <div class="qr_btn_back">
          <a href="home.html" class="btn_cloud">
            <span>回首頁
            @@include('template/btn_sp.html')
            </span>
          </a>
      </div>

    </div>

    </div>

  <?php
    }else{

    //更新資料庫的資料 將狀態0改為為1(已入場) 秀出資料已確認
    $revItems=$pdo->prepare("UPDATE `resv_order` SET `resv_status` = '1' WHERE `resv_order`.`booking_no` = :booking_no and `resv_order`.`member_id` = :member_id");
    $revItems->bindValue(':member_id',$_SESSION['user_no']);//$_SESSION['user_no']
    $revItems->bindValue(':booking_no',$_GET['booking_no']);
    $revItems->execute();
  ?>

        <div class="rev_qrcode_msg">
        
          <div class="msg_box">
          <div class="color_box"></div>
          <img class="success_pic" src="img/member/success.png" alt="success_pic">

          <p>資料已確認</p>
          <p>預約已到場</p>

          <div class="qr_btn_back">
                  <a href="home.html" class="btn_cloud">
                  <span>回首頁
            @@include('template/btn_sp.html')
            </span>
                  </a>
              </div>

          </div>

        </div>
    <?php
    // echo "異動成功~<br>";
  }
  //其他-沒有收到資料  要秀出form
  }else{
    $booking_no = $_GET['booking_no'];
?>

  <div class="rev_qrcode_msg">

    <div class="msg_box">
    <div class="color_box"></div>
      <img class="success_pic" src="img/member/success.png" alt="success_pic">
      <p><?="您的預約編號是  $booking_no";?></p>
      <p class="big_p"><?="掃描成功";?></p>


      <div class="qr_btn_back">
          <a href="member.php" class="btn_cloud">
            <span>回會員中心
            @@include('template/btn_sp.html')
            </span>
          </a>
      </div>


      <form action="" method="post">
      <input type="hidden" name="booking_no" value="<?=$booking_no?>">

      <div class="qr_btn">

      <button class="btn_cloud" value="submit">
        <span>確定入場(店員操作用)</span>
        @@include('template/btn_sp.html')</button>

      </div>
    
      </form>


          

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