

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="css/style.css">

<style>
*{
  outline:1px solid #faa;
}
.rev_qrcode_msg{
  max-width:1200px;
        margin: auto;
        padding:10px;

}
.msg_box{
  width:50%;
  height:50%;
  position: fixed;

  top: 0%;
            bottom: 0%;
            left: 0%;
            right: 0%;
            margin: auto;

       
        box-sizing: border-box;
            border: 1px solid #faa;
            background: #faa;
            box-shadow: 5px 5px 8px #999;
        }
</style>
</head>
<body class="bd_rev_qrcode">

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
      $revItems->bindValue(':booking_no',$_GET['booking_no']);
      $revItems->execute();
      echo"異動成功";

    } catch (PDOException $e) {
        $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
        $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
        echo $e;
    }


  }else{
    $aaa = $_GET['booking_no'];
  ?>

    
<div class="rev_qrcode_msg">
  <div class="contaniner">
    <div class="msg_box">


    <p><?="您的預約編號是  $aaa";?></p>
    <p><?="掃描成功";?></p>


    <form action="" method="post">
    <input type="hidden" name="aaa" value="<?=$aaa?>">
    <input type="submit" value="確定入場">
    </form>

    </div>
  </div>
</div>



    
    <?php
  }
?>


</body>
</html>