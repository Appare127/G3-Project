<?php 
$errMsg = "";
session_start();
try {
  // require_once('php/connectg3.php');
  
  $dsn = "mysql:host=localhost;port=3306;dbname=dd102g3;charset=utf8";
  $user = "root";
  $password = "123456";
  $options=array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);
  $pdo = new PDO($dsn, $user, $password, $options);
    
  // $orderItems=$pdo->prepare('SELECT * FROM `product_order` p  join order_item o on p.order_no = o.order_no join product pro on pro.product_no = o.product_no where user_no = :user_no');
  // $orderItems->bindValue(':user_no',1);//$_POST['user_no']
  // $orderItems->execute();

  //找會員
  $userItems=$pdo->prepare('SELECT * FROM `user` where user_no = :user_no');
  $userItems->bindValue(':user_no',$_SESSION['user_no']);//$_SESSION['user_no']
  $userItems->execute();

  //找訂單
  $orders=$pdo->prepare('SELECT * FROM `product_order` where user_no = :user_no');
  $orders->bindValue(':user_no',$_SESSION['user_no']);//$_SESSION['user_no']
  $orders->execute();

 //找訂單明細
  $orderItems=$pdo->prepare('SELECT * FROM  order_item o join product pro on pro.product_no = o.product_no where o.order_no = :order_no ');
  // $orderItems->execute();

//找預約
  $revs=$pdo->prepare('SELECT * FROM resv_order r join resv_session_capacity rc on r.session_no = rc.session_no where r.member_id = :member_id');
  $revs->bindValue(':member_id',$_SESSION['user_no']);//$_SESSION['user_no']
  $revs->execute();


//找收藏明細 且 狀態等於"1"就是收藏中的
  // $loves=$pdo->prepare('SELECT * FROM  favorite f join collections c on f.work_no = c.work_no where f.user_no = :user_no');

  $loves=$pdo->prepare('SELECT * FROM  favorite f join collections c on f.work_no = c.work_no where f.user_no = :user_no and f.favorite_status = 1');
  $loves->bindValue(':user_no',$_SESSION['user_no']);//$_SESSION['user_no']
  $loves->execute();

?>
<?php
} catch (PDOException $e) {
	$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
	$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
}

?>   
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>會員中心</title>
  <link rel="stylesheet" href="css/style.css">
 <script src="js/plugin/Chart.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

 <style>
        #msg {
            width: 266px;
            height: 266px;
            position: fixed;
            z-index: 999;
            /* top: 0%; */
            /* margin-top: -80px; */
            top: 0%;
            bottom: 0%;
            left: 0%;
            right: 0%;
            margin: auto;
            /* margin-left: -133px; */
            background: #fff;
            box-shadow: 5px 5px 8px #999;
            font-size: 17px;
            color: #666;
            border: 1px solid #f8f8f8;
            text-align: center;
            line-height: 2rem;
            display: inline-block;
            padding-bottom: 20px;
            border-radius: 2px;
        }

        #msg_top {
            background: #f8f8f8;
            padding: 5px 15px 5px 20px;
            text-align: left;
        }

        #msg_top span {
            font-size: 22px;
            float: right;
            cursor: pointer;
        }

        #msg_cont {
            padding: 15px 20px 20px;
            text-align: left;
        }

        #msg_clear {
            display: inline-block;
            color: #fff;
            padding: 1px 15px;
            background: #8fc31f;
            border-radius: 2px;
            float: right;
            margin-right: 15px;
            cursor: pointer;
        }
    </style>

</head>

<body class="bd_member">


  @@include('template/header.html')


  <div class="member_tab">
    <div class="banner_cloud">
      <img class="icon_l" src="img/header/banner_icon_l.png" alt="">
      <h1 class="title">會員中心</h1>
      <img class="icon_r" src="img/header/banner_icon_r.png" alt="">
    </div>

    <div class="tab_item">
        <a href="javascript:void(0)" id="default_open" class="btn_cloud tablink">基本資料
            @@include('template/btn_sp.html')</a>
          <a href="javascript:void(0)" class="btn_cloud tablink">我的訂單
            @@include('template/btn_sp.html')</a>
      
          <a href="javascript:void(0)" class="btn_cloud tablink">我的預約
            @@include('template/btn_sp.html')</a>
      
          <a href="javascript:void(0)" class="btn_cloud tablink">我的收藏
            @@include('template/btn_sp.html')</a>
    </div>

  </div>

  <?php

if ($errMsg !=""){
  echo "<center>$errMsg</center>";
}else{
?>

<?php
   	while($userRow = $userItems -> fetch(PDO::FETCH_ASSOC)){
       $dir="";
?>
    
  <section id="member_basic" class="member_basic tabcontent">

    <div class="container">

      <div class="my_baic">

        <h2>基本資料</h2>
        <form action="php/member/update_MemberBaic.php" method="post" enctype="multipart/form-data">

        <div class="col-12 col-md-6">
          <div class="baic_pic">
            <?php
            if($userRow["user_img"]==NULL){
            ?>
              
                <img id="upfile_pic" src="https://api.fnkr.net/testimg/300x300/FFCED1/FFF/?text=wait">

            <?php
            }else{
            ?>
              <img id="upfile_pic" src="<?=$userRow["user_img"]?>" alt="user_sticker">
            <?php
            }
            ?>
          </div>

          <div class="upfile">
            <input type="file" name="upFile" id="upFile" accept="image/*" value=<?=$userRow["user_img"]?>>
          </div>
        </div>


        <div class="col-12 col-md-6">
              <table class="baic_txt">
                
              <tr>
                <td><p class="p_title">帳號</p></td>
                <input type="hidden" name="user_id" value="<?=$userRow["user_id"]?>">
                <td><p><?=$userRow["user_id"]?></p></td>
              </tr>
              <tr>
                <td><p class="p_title">姓名</p></td>
                <td><p><input type="text" name="user_name" readonly="readonly" value="<?=$userRow["user_name"]?>"></p></td>
              </tr>
              <tr>
                <td><p class="p_title">密碼</p></td>
                <td><p><input type="password" name="user_psw" readonly="readonly" value="<?=$userRow["user_psw"]?>"></p></td>
              </tr>
              <tr>
                <td><p class="p_title">信箱</p></td>
                <td><p><input type="email" name="user_email" value="<?=$userRow["user_email"]?>">
                 </p></td>
              </tr>
              <tr>
                <td><p class="p_title">電話</p></td>
                <td><p><input type="tel" name="user_tel" readonly="readonly" value="<?=$userRow["user_tel"]?>"></p></td>
              </tr>
              <tr>
                <td><p class="p_title">密碼提示答案</p></td>
 
                <td><p><input type="text" name="hint_answer" readonly="readonly" value="<?=$userRow["hint_answer"]?>"></p></td>
              </tr>
              <tr>
                <td><p class="p_title">目前金幣</p></td>
                <td><p>$<?=$userRow["game_money"]?></p></td>
              </tr>
              <!-- <tr>
                <td><p class="p_title">當日剩餘票數</p></td>
                <td><p><?=$userRow["vote_remain"]?></p></td>
              </tr>  -->
            </table>
          

            <div class="baic_btn">
              <button type="button" class="btn_cloud" id="btn_edit"><span>修改</span>@@include('template/btn_sp.html')</button>
              <!-- <a href="#" class="btn_cloud" id="btn_edit">修改
                @@include('template/btn_sp.html')</a> -->
                
              <button class="btn_cloud" id="updated_it" value="submit" style='display:none'><span>儲存</span>@@include('template/btn_sp.html')</button>

              <!-- <a href="" class="btn_cloud" id="updated_it"> -->
              <!-- <button value="submit">儲存</button> -->
              <!-- <input type="submit" value="儲存" >
                @@include('template/btn_sp.html')
              </a> -->
             
            </div>

            </div>

            <div class="clearfix"></div>
            </div>
      <form>

        <!-- <div class="col-12 col-md-6">

          <table class="baic_txt" >
            <tr>
              <td>帳號</td>
              <td>
              <?=$userRow["user_id"]?></td>
            </tr>
            <tr>
              <td>姓名</td>
              <td><?=$userRow["user_name"]?></td>
            </tr>
            <tr>
              <td>密碼</td>
              <td><?=$userRow["user_psw"]?></td>
            </tr>
            <tr>
              <td>信箱</td>
              <td><?=$userRow["user_email"]?></td>
            </tr>
            <tr>
              <td>電話</td>
              <td><?=$userRow["user_tel"]?></td>
            </tr>
            <tr>
              <td>密碼提示答案</td>
              <td><?=$userRow["hint_answer"]?></td>
            </tr>
            <tr>
              <td>目前金幣</td>
              <td><?=$userRow["game_money"]?></td>
            </tr>
            <tr>
              <td>當日剩餘票數</td>
              <td><?=$userRow["vote_remain"]?></td>
            </tr> 
          </table>

          <div class="baic_btn">
            <a href="" class="btn_cloud">修改
              @@include('template/btn_sp.html')</a>
            <a href="" class="btn_cloud">儲存
              @@include('template/btn_sp.html')
            </a>
          </div>

        </div>

        <div class="clearfix"></div>
      </div> -->

      <div class="my_gamerecord">
        <h2>遊戲紀錄</h2>


        <div class="col-12 col-md-6">

          <div class="gamerecord_pic">
            <img src="<?=$userRow["game_img"]?>" alt="user_game">
          </div>

        </div>

        <div class="col-12 col-md-6">

          <table class="gamerecord_txt">

            <tr>
              <td><p class="p_title">最高存活時間</p></td>
              <td><p><?=$userRow["game_record"]?>秒</p></td>
            </tr>

            <tr>
              <td><p class="p_title">最高分數遊戲日期</p></td>
              <td><p><?=$userRow["game_date"]?></p></td>
            </tr>

          </table>

          <div class="baic_btn">
            <a href="game.html" class="btn_cloud">挑戰高分去
              @@include('template/btn_sp.html')</a>
          </div>

        </div>
        <div class="clearfix"></div>

      </div>


      <div class="my_animal">

        <h2>我的動物</h2>

        <div class="col-12 col-md-6">

          <div class="myanimal_pic">

            <img class="animalbg_re" src="<?=$userRow["my_animal_bg_img"]?>" alt="user_animal_bg">
            <img class="animalpic_ab" src="<?=$userRow["my_animal_img"]?>" alt="user_animal">

          </div>

        </div>
        <!-- <p>提醒：你所選擇的動物會跟牠的適應力有關。<p> -->
       
        <div class="col-12 col-md-6 animal_basic">

            <div class="info_wrap">
              <p>體質能力</p>
              <div class="life_ability">
                  <p>生命力:</p>
                  <div class="pic">
                      <!-- <img src="img/modify/icon_life.png" alt="">-->
                  </div>
              </div>

              <div class="jump_ability">
                  <p>跳躍力:</p>
                  <div class="pic">
                      <div class="jump_bar">
                          <div class="bar_add"></div>
                          <span class="meter">m</span>
                      </div>
                  </div>
              </div>

              <p>環境適應力</p>
              <div class="evemt_ability">
                  <canvas class="chart_canvas">
                  </canvas>
              </div>
            </div>


          <div class="baic_btn">
            <a href="frank.html" class="btn_cloud">參加選怪
              @@include('template/btn_sp.html')
            </a>
            <a href="game.html" class="btn_cloud">參加遊戲
              @@include('template/btn_sp.html')
            </a>
            <a href="modify.html" class="btn_cloud">修改動物
              @@include('template/btn_sp.html')
            </a>
          </div>

        </div>

        <div class="clearfix"></div>

      </div><!-- mybasic -->

    </div><!-- container -->

  </section>

  <?php
    }//while
  }//else
   ?>

  <section id="member_order" class="member_order tabcontent">
    <div class="container">

      <div class="my_order">
        <h2>我的訂單</h2>


        <?php 
      if( $errMsg != ""){ //例外
        echo "<div><center>$errMsg</center></div>";
      }elseif($orders->rowCount()==0){
        echo "<div><center><p>目前無訂單資料</p></center></div>";
      }else{
        $ordersRow = $orders->fetchAll(PDO::FETCH_ASSOC);

      foreach( $ordersRow as $i => $pdoOrders){
       ?>
          
        <!-- 未來動態新增 -->
        <div class="myorder_item">

        <div class="item_title">
            <p class="col-md-1 p_title">訂單編號</p>
            <p class="col-md-3 p_title">訂購日期</p>
            <p class="col-md-2 p_title">訂單狀態</p>
            <p class="col-md-2 p_title">總金額</p>
            <p class="col-md-2 p_title">取消訂單</p>
            <p class="col-md-2 p_title">備註</p>
            <div class="clearfix"></div>
        </div>


        <div class="item_list">
          <p class="col-6 s_show p_title">訂單編號:</p>
          <p class="col-6 col-md-1"><?=$pdoOrders["order_no"]?></p>
          <p class="col-6 s_show p_title">訂購日期:</p>
          <p class="col-6 col-md-3"><?=$pdoOrders["order_date"]?></p>
          <p class="col-6 s_show p_title">訂單狀態:</p>
          <p class="col-6 col-md-2"><?= $pdoOrders["shipping_status"]==1? "已出貨":"處理中" ?></p>
          <p class="col-6 s_show p_title">總金額:</p>
          <p class="col-6 col-md-2"><?=$pdoOrders["order_sum"]?></p>

          <p class="col-6 s_show p_title">取消訂單:</p>
          <div class="col-6 col-md-2 baic_btn">
            <a href="javascript:;" class="btn_cloud order_cancel">取消訂單
              @@include('template/btn_sp.html')
            </a>
          </div>

          <p class="col-6 s_show p_title">備註:</p>
          <div class="col-6 col-md-2 baic_btn">
            <a href="javascript:void(0)" class="btn_cloud js_order_show">訂單明細
              @@include('template/btn_sp.html')
            </a>
          </div>

          <div class="clearfix"></div>

        </div>
        </div>
        <div class="myorder_item_detail">

        <div class="item_title">
          <p class="col-md-3 p_title">商品名稱</p>
          <p class="col-md-3 p_title">單價</p>
          <p class="col-md-3 p_title">數量</p>
          <p class="col-md-3 p_title">小計</p>
          <div class="clearfix"></div>
        </div>

               
        <?php 
        $orderItems->bindValue(':order_no',$pdoOrders["order_no"]);
          $orderItems->execute();

          $ordersItemsRow = $orderItems->fetchAll(PDO::FETCH_ASSOC);
          foreach( $ordersItemsRow as $i => $pdoItems){
            //跑order_item
        ?>

        
        <div class="item_list">
          <p class="col-6 s_show p_title">商品名稱:</p>
          <p class="col-6 col-md-3"><?=$pdoItems["product_name"]?></p>
          <p class="col-6 s_show p_title">單價:</p>
          <p class="col-6 col-md-3"><?=$pdoItems["product_price"]?></p>
          <p class="col-6 s_show p_title">數量:</p>
          <p class="col-6 col-md-3"><?=$pdoItems["product_number"]?></p>
          <p class="col-6 s_show p_title">小計</p>
          <p class="col-6 col-md-3"><?=$pdoItems["price"]?></p>
          <div class="clearfix"></div>
        </div>
        <?php
         }//for items
         ?>

        </div>
        <!-- 未來動態新增 -->

      <?php
        } //for
      }
      ?>



        <!-- 未來動態新增 -->
        <!-- <div class="myorder_item">

          <div class="item_title">
              <p class="col-md-1">訂單編號</p>
              <p class="col-md-3">訂購日期</p>
              <p class="col-md-2">訂單狀態</p>
              <p class="col-md-2">總金額</p>
              <p class="col-md-2">取消訂單</p>
              <p class="col-md-2">備註</p>
              <div class="clearfix"></div>
          </div>


          <div class="item_list">
            <p class="col-6 s_show">訂單編號:</p>
            <p class="col-6 col-md-1">266</p>
            <p class="col-6 s_show">訂購日期:</p>
            <p class="col-6 col-md-3">2019-08-26 22:06:39</p>
            <p class="col-6 s_show">訂單狀態:</p>
            <p class="col-6 col-md-2">處理中</p>
            <p class="col-6 s_show">總金額:</p>
            <p class="col-6 col-md-2">3100元</p>

            <p class="col-6 s_show">取消訂單:</p>
            <div class="col-6 col-md-2 baic_btn">
              <a href="" class="btn_cloud">取消訂單
                @@include('template/btn_sp.html')
              </a>
            </div>

            <p class="col-6 s_show">備註:</p>
            <div class="col-6 col-md-2 baic_btn">
              <a href="javascript:void(0)" class="btn_cloud js_order_show">訂單明細
                @@include('template/btn_sp.html')
              </a>
            </div>

            <div class="clearfix"></div>

          </div>
        </div>
      


        <div class="myorder_item_detail">

          <div class="item_title">
            <p class="col-md-3">商品名稱</p>
            <p class="col-md-3">單價</p>
            <p class="col-md-3">數量</p>
            <p class="col-md-3">小計</p>
            <div class="clearfix"></div>
          </div>

          <div class="item_list">
            <p class="col-6 s_show">商品名稱:</p>
            <p class="col-6 col-md-3">怪奇馬克杯</p>
            <p class="col-6 s_show">單價:</p>
            <p class="col-6 col-md-3">$300</p>
            <p class="col-6 s_show">數量:</p>
            <p class="col-6 col-md-3">1</p>
            <p class="col-6 s_show">小計</p>
            <p class="col-6 col-md-3">$300</p>
            <div class="clearfix"></div>
          </div>

          <div class="item_list">
            <p class="col-6 s_show">商品名稱:</p>
            <p class="col-6 col-md-3">怪奇馬克杯</p>
            <p class="col-6 s_show">單價:</p>
            <p class="col-6 col-md-3">$300</p>
            <p class="col-6 s_show">數量:</p>
            <p class="col-6 col-md-3">1</p>
            <p class="col-6 s_show">小計</p>
            <p class="col-6 col-md-3">$300</p>
            <div class="clearfix"></div>
          </div>


        </div> -->
        <!-- 未來動態新增 -->
      </div>

    </div>
  </section>


  <section id="member_receive" class="member_receive tabcontent">
    <div class="container">


      <div class="my_receive">

        <h2>我的預約</h2>


        <?php 
      if( $errMsg != ""){ //例外
        echo "<div><center>$errMsg</center></div>";
      }elseif($revs->rowCount()==0){
        echo "<div><center>目前無預約資料</center></div>";
      }else{
        $revsRow = $revs->fetchAll(PDO::FETCH_ASSOC);

      foreach( $revsRow as $i => $pdoRevs){
       ?>
        
        <!-- 未來動態新增 -->
        <div class="myreceive_item">
            <div class="item_title">
                <p class="col-md-2 p_title">預約編號</p>
                <p class="col-md-2 p_title">預約日期</p>
                <p class="col-md-2 p_title">預約時段</p>
                <p class="col-md-2 p_title">預約狀態</p>
                <p class="col-md-2 p_title">取消預約</p>
                <p class="col-md-2 p_title">顯示</p>
                <div class="clearfix"></div>
            </div>

            <div class="item_list">
                <p class="col-6 s_show p_title">預約編號:</p>
                <p class="col-6 col-md-2"><?=$pdoRevs["booking_no"]?></p>
                <p class="col-6 s_show p_title">預約日期:</p>
                <p class="col-6 col-md-2"><?=$pdoRevs["tour_date"]?></p>
                <p class="col-6 s_show p_title">預約時段:</p>
                <p class="col-6 col-md-2"><?=$pdoRevs["start_time"]?></p>
                <p class="col-6 s_show p_title">預約狀態:</p>
                <p class="col-6 col-md-2"><?=$pdoRevs["resv_status"]==1? "已到場":"未到場"?></p>
    
                <p class="col-6 s_show p_title">取消預約:</p>
                <div class="col-6 col-md-2 baic_btn">
                  <a href="javascript:;" class="btn_cloud rev_cancel">取消預約
                    @@include('template/btn_sp.html')
                  </a>
                </div>
    
                <p class="col-6 s_show p_title">備註:</p>
                <div class="col-6 col-md-2 baic_btn">
                  <a href="javascript:void(0)" class="btn_cloud js_qr_show">QR-code
                    @@include('template/btn_sp.html')
                  </a>
                </div>
    
                <div class="clearfix"></div>
    
              </div>
        </div>

        <div class="qrcode_wrap">
          <div class="qrcode_pic">
              <button type="button" class="btn_close">X</button>

              <img class="qrcode_pic_js" src=''>
              <a href="qrcode_success.php?booking_no=<?=$pdoRevs["booking_no"]?>">網址</a>
              
              <!--  -->
              <script>
              document.getElementsByClassName('qrcode_pic_js')[<?=$i?>].src='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=qrcode_success.php?booking_no=<?=$pdoRevs["booking_no"]?>&choe=UTF-8';
              </script>

                <!-- <script>
              document.getElementsByClassName('qrcode_pic_js')[<?=$i?>].src='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://140.115.236.71/demo-projects/DD102/DD102G3/QRcode_getStoreInfo-test-1.php?booking_no=<?=$pdoRevs["booking_no"]?>&choe=UTF-8';
              </script>
             -->
            <!-- https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=http://140.115.236.71/demo-projects/DD102/DD102G3/QRcode_getStoreInfo-test.php? -->
              
            </div>
        </div>

        <!-- 未來動態新增 -->

      <?php
          }//foreach
        }//else
      ?>

      

          <!-- 未來動態新增 -->
        <!-- 
          <div class="myreceive_item">

              <div class="item_title">
                  <p class="col-md-2">預約編號</p>
                  <p class="col-md-2">預約日期</p>
                  <p class="col-md-2">預約時段</p>
                  <p class="col-md-2">預約狀態</p>
                  <p class="col-md-2">取消訂單</p>
                  <p class="col-md-2">顯示</p>
                  <div class="clearfix"></div>
              </div>
  
  
              <div class="item_list">
                  <p class="col-6 s_show">預約編號:</p>
                  <p class="col-6 col-md-2">266</p>
                  <p class="col-6 s_show">預約日期:</p>
                  <p class="col-6 col-md-2">2019-08-26</p>
                  <p class="col-6 s_show">預約時段:</p>
                  <p class="col-6 col-md-2">10:30</p>
                  <p class="col-6 s_show">預約狀態:</p>
                  <p class="col-6 col-md-2">已到場</p>
      
                  <p class="col-6 s_show">取消訂單:</p>
                  <div class="col-6 col-md-2 baic_btn">
                    <a href="" class="btn_cloud">取消訂單
                      @@include('template/btn_sp.html')
                    </a>
                  </div>
      
                  <p class="col-6 s_show">備註:</p>
                  <div class="col-6 col-md-2 baic_btn">
                    <a href="javascript:void(0)" class="btn_cloud js_qr_show">QR-code
                      @@include('template/btn_sp.html')
                    </a>
                  </div>
      
                  <div class="clearfix"></div>
      
                </div>
  
          </div>

          <div class="qrcode_wrap">
              <div class="qrcode_pic">
                  <button class="btn_close">X</button>
                  <img src="img/member/member_pic.png" alt="">
              </div>
          </div> -->
  
          <!-- 未來動態新增 -->

      </div>

    </div>
  </section>



  <section id="member_love" class="member_love tabcontent">
    <div class="container">



      <div class="my_love">
        <h2>我的收藏</h2>
      
        <?php 
      if( $errMsg != ""){ //例外
        echo "<div><center>$errMsg</center></div>";
      }elseif($loves->rowCount()==0){
        echo "<div><center><p>目前無收藏清單</p></center></div>";
      }else{
        $lovesRow = $loves->fetchAll(PDO::FETCH_ASSOC);

      foreach( $lovesRow as $i => $pdoloves){
       ?>


        <!-- 動態生成 -->
        <div class="col-6 col-md-3 mylove_item">

          <div class="loveanimal_pic">
            <img class="lovebg_re" src="<?=$pdoloves["bg_img"]?>" alt="user_animal_bg">
            <img class="lovepic_ab" src="<?=$pdoloves["cmp_img"]?>" alt="user_animal">
          </div>

          <p>作品名稱:<?=$pdoloves["work_name"]?></p>
          <div class="baic_btn">
            
            <p class="btn_cloud close_love" id='work_close<?=$pdoloves["work_no"]?>'>取消收藏
              @@include('template/btn_sp.html')
              </p>
            
          </div>

        </div>
      
        <!-- 動態生成 -->
        
      <?php
          }//foreach
        }//else
      ?>

         <!-- 動態生成 -->
        <!-- <div class="col-6 col-md-3 baic_btn">
          <div><img src="img/member/member_pic.png">
            <p>動物背包</p>
          </div>
          <a href="" class="btn_cloud">取消收藏
            @@include('template/btn_sp.html')
          </a>
        </div> -->
        <!-- 動態生成 -->

        <div class="clearfix"></div>

      </div>

    </div>

  </section>


  @@include('template/footer.html')

  <script src="js/member/member.js"></script>
  <script src="js/modify/radar.js"></script>

</body>

</html>