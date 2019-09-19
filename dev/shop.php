<?php 
$errMsg = "";
try {
	require_once('php/connectg3.php');
    $prods  = $pdo->query("select * from product where product_status=1");
    $prodsRow=$prods->fetchAll(PDO::FETCH_ASSOC);
    // echo json_encode($prodsRow);

    $imgs  = $pdo->query("select cmp_img,amlbg_img from collections order by vote desc limit 3");
    
    // echo json_encode($imgRow);
    // print_r($prodsRow);
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
    <title>動物商城</title>
    @@include('template/csslink.html',{"csslink":"css/style.css"})
    <style>
        * {
            /* outline: 1px solid #f00; */
        }
    </style>
</head>

<body class="shop" id="shop">
    @@include('template/header.html')
    <section class="banner">
        <div class="container">
            <div class="banner_title">
                <img class="icon_l" src="img/header/banner_icon_l.png" alt="">
                <h1 class="title">動物商城</h1>
                <img class="icon_r" src="img/header/banner_icon_r.png" alt="">
            </div>
            <div class="banner_text">
                <div class="guide_animal">
                    <div class="guide_animal_animal">
                        <img src="img/shop/animal2.png" alt="">
                    </div>
                    <div class="guide_animal_cloud">
                        <img src="img/shop/titleCloud.png" alt="">
                    </div>
                </div>
                <p>在這裡你可以印製專屬商品哦~趕快來逛逛吧！</p>
            </div>

        </div>
        <div class="balloon">
            <img src="img/shop/balloon.png" alt="">
        </div>
        <img class="cloudl cloud" src="img/shop/cloud.png" alt="">
        <img class="cloudm cloud" src="img/shop/cloud.png" alt="">
        <img class="cloudr cloud" src="img/shop/cloud.png" alt="">

      
    </section>
    <section class="shop_area" id="shop_area">
        <img class="cloudbl cloud" src="img/shop/cloud.png" alt="">
        <img class="cloudbr cloud" src="img/shop/cloud.png" alt="">
        <div class="tent">
            <img src="img/shop/tent.png" alt="">
        </div>
        <div class="container">

            <div class="wrap">
                <div class="lights">
                    <img src="img/shop/lights.png">
                    <img src="img/shop/lights.png">
                    <img src="img/shop/lights.png">
                </div>
                <div class="choose_pic">
                    <h2>選擇商品</h2>
                    <p class='intro'>請選擇您想要印製的圖案:</p>
                    <div class="choose_pic_wrap">
                        <!-- 第一個我的動物，從session storage撈 -->
                    <div class="item">
                        <div class="pic">
                            <img class="shop_animal_bg" >
                        </div>
                        <p>我的動物</p>
                    </div>


                    <!-- 選美前三名從資料庫撈 -->
                        <?php
                        if( $imgs->rowCount() < 3 ){
                            $imgName=['選美No.1','選美No.2','選美No.3'];
                            foreach ($imgName as $i => $value) {
                        ?>
                         <div class="item">
                            <div class="pic">
                                <img class="shop_animal_bg" src="img/shop/amlbg.png" alt="">
                            </div>
                            <p><?=$value?></p>
                        </div>
                        <?php
                           }
                        }else{ 
                            $imgRow=$imgs->fetchAll(PDO::FETCH_ASSOC);
                             $imgName=['選美No.1','選美No.2','選美No.3'];
                            foreach ($imgName as $i => $value) {
                        ?>
                        <div class="item">
                            <div class="pic">
                                <img class="shop_animal_bg" src=<?=$imgRow[$i]['amlbg_img'] ?> alt="">
                            </div>
                            <p><?=$value?></p>
                        </div>
                        <?php
                            }
                        }
                        ?>

                </div>
                </div>
                <div class="choose_bgpic">
                    <p class="intro">
                        請選擇圖案是否要背景圖片：<br>
                        <input type="radio" name="bgpic" checked>我要背景圖片
                        <input type="radio" name="bgpic" >我不要背景圖片
                    </p>

                </div>
                <div class="choose_product">
                <?php 
                
                foreach ($prodsRow as $i => $data) {
                    $name=explode(".",explode("/",$prodsRow[$i]['product_img'])[2])[0];    //cup/pillow/hat/bag
                    $prodData=[$prodsRow[$i]['product_no'],$prodsRow[$i]['product_name'],$prodsRow[$i]['product_img'],$prodsRow[$i]['product_price']];
                ?>
                    <div class="item" id=<?=$name?> >
                        <div class="deco deco_top" ></div>
                        <h3><?=$prodsRow[$i]['product_name']?></h3>
                        <div class="prod_img">
                            <img class="prod_plain" src=<?=$prodsRow[$i]['product_img']?> alt="">
                            <div class=<?="pic_chosen"?>>
                                <img class="shop_animal_bg" src=<?=$imgRow[0]['amlbg_img']?>  alt="">
                                <!-- <img class="shop_animal" src="img/shop/animal1.png" alt=""> -->
                            </div>
                        </div>
                        <p class="price"><?=$prodsRow[$i]['product_price']?></p>
                        <div class="number">
                            <button  class="minus_num">-</button>
                            <input class="prod_num" type="number" value="1">
                            <button  class="add_num">+</button>
                        </div>
                        <div class="btn">
                            <a class="btn_cloudb view_detail">查看詳情@@include('template/btn_sp.html')</a>
                            <a class="btn_cloudp add_cart">加入購物車@@include('template/btn_sp.html')</a>
                            <input class='prod_data' name='prod_data' type="hidden" value=<?=json_encode($prodData)?>>
                            <input class='prod_desc' name='prod_desc' type="hidden" value=<?=$prodsRow[$i]['product_description']?>>
                        </div>
                        <div class="deco deco_bottom"></div>
                    </div>
                <?php  }?>
                </div>
            </div>
        </div>
    </section>
    <!-- 商品詳情 -->
    <div class="prod_detail" id="prod_detail">
        <div class="detail_container">
            <button class="back_button">X</button>
            <div class="wrap">
                <div class="title">
                    <img src="img/shop/sign_board.png" alt="">
                    <p>商品詳情</p>
                </div>
                <div class="prod_img">
                    <img class="prod_plain" src="img/shop/pillow.png" alt="">
                    <div id='detail_pic_chosen' class="pic_chosen">
                        <img class="shop_animal_bg" src="img/shop/amlbg.png" alt="">
                    </div>
                </div>
                <div class="prod_text">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    @@include('template/footer.html')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src='js/shop/shop.js'></script> -->
    <script>
    function choosePic(){
    if(sessionStorage.my_animalbg_img){  //如果登入了  撈session
        document.querySelectorAll(".choose_pic .shop_animal_bg")[0].src=sessionStorage.my_animalbg_img;
       
    }else{   //如果沒登入，給預設圖片
    document.querySelectorAll(".choose_pic .shop_animal_bg")[0].src='img/member/demo_amlbg_0.png';
    }
};

function changePic(e){    //點了會換圖
    let bg=this.children[0].children[0].src;
    // let animal=this.children[0].children[1].src;
    document.querySelectorAll('.choose_product .prod_img').forEach((element,i) => {
        element.children[1].children[0].src=bg;
        // element.children[1].children[1].src=animal;
    });
};


window.addEventListener("load",function(){
    let detailButtons=document.querySelectorAll('.view_detail');  //查看詳情
    let addCartButtons=document.querySelectorAll('.add_cart');//加入購物車
    let prodDetail=document.querySelector('.prod_detail');//視窗
    let backButton=document.querySelector('.back_button');//視窗裡的叉叉
    let bgButtons=document.getElementsByName("bgpic");//切換背景圖
    let minusNumButtons=document.querySelectorAll('.minus_num');  //減少數量
    let addNumButtons=document.querySelectorAll('.add_num');     //加數量
    let prodNumInputs=document.querySelectorAll('.prod_num'); //商品Input的數量
    let changePicBtn=document.querySelectorAll('.choose_pic_wrap .item')  //動物圖片
    if(sessionStorage['shopList'] == null){
        sessionStorage['shopList'] =""; 
    }
    

    for(i=0;i<minusNumButtons.length;i++){   //減num
        minusNumButtons[i].onclick=function(){
            this.nextElementSibling.value==1?this.nextElementSibling.value=1:this.nextElementSibling.value--;
            
        }
    }

    for(i=0;i<addNumButtons.length;i++){   //加num
        addNumButtons[i].onclick=function(){
            this.previousElementSibling.value++;
        }
    }

    bgButtons[0].onclick=function(){   //要背景圖
        for(i=0;i<document.querySelectorAll(".shop_animal_bg").length;i++){
            let src=document.querySelectorAll(".shop_animal_bg")[i].src;
            if(src.search("customize") != -1||src.search("member") != -1){//是客製的或預設的
                src=src.replace("aml","amlbg"),
                document.querySelectorAll(".shop_animal_bg")[i].src=src;
            
            }else{   
                src=src.replace("_","_amlbg_"),
                document.querySelectorAll(".shop_animal_bg")[i].src=src;
            } 
        }
    }

    bgButtons[1].onclick=function(){   //不要背景圖
        for(i=0;i<document.querySelectorAll(".shop_animal_bg").length;i++){
            let src=document.querySelectorAll(".shop_animal_bg")[i].src;
            if(src.search("customize") != -1 ||src.search("member") != -1){//是客製的或預設的
                src=src.replace("bg",""),
                document.querySelectorAll(".shop_animal_bg")[i].src=src;
            }else{  
                src=src.replace("amlbg_",""),
                document.querySelectorAll(".shop_animal_bg")[i].src=src;
            }

        };
    }
    backButton.onclick=function(){   //關閉視窗
        prodDetail.style.display='none';
    };

    for(i=0;i<detailButtons.length;i++){   //查看詳情
        detailButtons[i].onclick=function(){
            prodDetail.style.display='block';
            document.querySelector('.prod_detail .prod_plain').src=this.parentNode.parentNode.children[2].children[0].src;
            document.querySelector('.prod_detail .shop_animal_bg').src=this.parentNode.parentNode.children[2].children[1].children[0].src;
            // document.querySelector('.prod_detail .shop_animal').src=this.parentNode.parentNode.children[2].children[1].children[1].src;
            document.getElementById('detail_pic_chosen').className=this.parentNode.parentNode.children[2].children[1].className;
            document.querySelector('.prod_detail .prod_text p').innerText=this.nextElementSibling.nextElementSibling.nextElementSibling.value;
        } 
    }

    for(i=0;i<addCartButtons.length;i++){  //加入購物車
        addCartButtons[i].onclick=function(){
            let prodName=JSON.parse(this.nextElementSibling.value)[0]    //cup/hat/pillow...
            let data={};
            data.prodInfo=JSON.parse(this.nextElementSibling.value);  //name +商品本人圖片+單價
            data.num=this.parentNode.previousElementSibling.children[1].value   //數量
            data.img=this.parentNode.parentNode.children[2].children[1].children[0].src  
           
            // console.log(data.Img.lastIndexOf("/"));
            // console.log(data.Img.lastIndexOf("."));

            let imgName=data.img.substring(data.img.lastIndexOf("/")+1,data.img.lastIndexOf("."));   //圖片檔名
            let sessionName=prodName+"|"+imgName;  //cup|work_amlbg_5

            data.name=sessionName;
            // console.log(sessionName)
            data=JSON.stringify(data);
            console.log(data);
            // {"prodInfo":["1","馬克杯","img/shop/cup.png","500"],"num":"1","Img":"http://localhost/G3/img/collections/work_amlbg_5.png","name":"cup|work_amlbg_5"}
            
            $.get('php/cart/cart_session.php',{data:data});
            // $.get('php/resv/getTime.php', { data: 'time' }, function (data) {

            if(sessionStorage[sessionName]){   //買過了  num+1
                let dataNew;
                dataNew=JSON.parse(sessionStorage[sessionName]);
                dataNew.num=Number(dataNew.num)+1;
                dataNew=JSON.stringify(dataNew);
                sessionStorage.setItem(sessionName,dataNew);  
            }else{    //沒買過這個商品
                sessionStorage['shopList']+=sessionName+",";
                sessionStorage.setItem(sessionName,data);  
            }
            

            document.getElementById("cart_num").style.display='block';
            document.getElementById("cart_num").innerText=sessionStorage['shopList'].split(',').length-1;
            
         
        }
    }

    for(i=0;i<changePicBtn.length;i++){   //點按圖片會換 
        changePicBtn[i].onclick=changePic;          
        // console.log(changePicBtn[i]) 
    }

    choosePic();   //loading進那四張動物圖片
    
}); 
    </script>
</body>

</html>

