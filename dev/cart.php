<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @@include('template/csslink.html',{"csslink":"css/style.css"})
    <title>購物車</title>
    <style>
        * {
            /* outline: 1px solid #f00; */
        }
    </style>
</head>

<body class="cart">
    @@include('template/header.html')
    <section class="banner">
        <div class="container">
            <div class="banner_title">
                <img class="icon_l" src="img/header/banner_icon_l.png" alt="">
                <h1 class="title">購物車</h1>
                <img class="icon_r" src="img/header/banner_icon_r.png" alt="">
            </div>
        </div>
        <div class="balloon">
            <img src="img/shop/balloon.png" alt="">
        </div>
        <img class="cloudl cloud" src="img/shop/cloud.png" alt="">
        <img class="cloudm cloud" src="img/shop/cloud.png" alt="">
        <img class="cloudr cloud" src="img/shop/cloud.png" alt="">
    </section>
    <section class="cart_list">
        <div class="container">
            <div class="wrap">
                <div class="list_header">
                    <h2 class="col-md-2">商品圖片</h2>
                    <h2 class="col-md-2">商品名稱</h2>
                    <h2 class="col-md-2">單價</h2>
                    <h2 class="col-md-2">數量</h2>
                    <h2 class="col-md-2">小計</h2>
                    <h2 class="col-md-2">刪除</h2>
                </div>

                <?php 
                if(isset($_SESSION['cart'])){
                foreach ($_SESSION['cart'] as $i => $n) {
                
                ?>
                <!-- 動態新增開始 -->
                <div class="list_row" id='<?=$i?>'>
                    <div class="prod_pic col-6 col-md-2">
                        <div class="pic_item">
                            <img src="<?=$n->prodInfo[1]?>" alt="">
                        </div>
                    </div>
                    <div class="prod_info col-6 col-md-8">
                        <div class="prod_name "><span class="title_inline">商品名稱：</span><?=$i?></div>
                        <div class="price"><span class="title_inline">商品單價：</span><?=$n->prodInfo[2]?></div>
                        <div class="number">
                            <span class="title_inline">商品數量：</span>
                            <div class="number_input">
                                <button class="minus_num">-</button>
                                <input class="prod_num" type="number" value="<?=$n->num?>">
                                <button class="add_num">+</button>
                            </div>
                        </div>
                        <div class="subTotal">
                            <span class="title_inline">商品小計：</span>
                            $<span class="subTotal_num"><?=$n->num*$n->prodInfo[2]?></span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="prod_delete col-md-2">
                        <a class="btn_cloudb delete">刪除@@include('template/btn_sp.html')</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="total" >
                <p>商品金額：$<span>100</span></p>
                <p>+運費：$0</p>
                <p>總金額為：$<span class="total_money"></span></p>
            </div>
            <div class="cart_btn">
                <a class="btn_cloudy" href="shop.html">繼續購物@@include('template/btn_sp.html')</a>
                <a class="btn_cloudp" href="checkOrder.html">進行結帳@@include('template/btn_sp.html')</a>
            </div>
            <?php
                }}
                else{
            ?>
                <div class="list_row" >
                    <p class='empty'>您尚未選擇商品</p>
                </div>
                <div class="cart_btn">
                <a class="btn_cloudy" href="shop.html">去購物@@include('template/btn_sp.html')</a>
                <!-- <a class="btn_cloudp" href="checkOrder.html">進行結帳@@include('template/btn_sp.html')</a> -->
            </div>
            <?php
                    }
            ?>
            <!-- 動態新增結束 -->
           
        </div>
    </section>

    @@include('template/footer.html')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>

        function  total(){    //總金額
            if( sessionStorage['shopList'] !=''){
                var cart_total=0;
                var subTotals=document.getElementsByClassName("subTotal_num");
                for (i = 0; i < subTotals.length; i++) {
                    cart_total += Number(subTotals[0].innerText.replace("$",""));
                }
                document.getElementsByClassName("total")[0].children[0].innerText=cart_total;
                document.getElementsByClassName("total_money")[0].innerText = cart_total+60;
            }
        }

        function changeNum(input){   //改變數量
            let num = input.value;
            let id=input.parentNode.parentNode.parentNode.parentNode.id;
                // console.log(id+","+num)
                input.parentNode.parentNode.nextElementSibling.innerHTML='';  //小計清空

                //改session
                $.get('php/cart/change_num.php',{num:id+","+num});
    
                //改sessionStorage
                let str=JSON.parse(sessionStorage[id]);
                str.num=num;
                sessionStorage[id]=JSON.stringify(str);

                //改subtotal
                let price=input.parentNode.parentNode.previousElementSibling.innerText;       
                let subTotal=price*num
                input.parentNode.parentNode.nextElementSibling.innerHTML=
                    `<span class="title_inline">商品小計：</span>
                    $<span class="subTotal_num">${subTotal}</span> `

                 //改total
                 total();
        }

        function deleteItem(){   //刪除
            alert("您確定要刪除？");
            
            //清空session
            let id=input.parentNode.parentNode.parentNode.parentNode.id;
            input.parentNode.parentNode.nextElementSibling.innerHTML='';
                $.get('php/cart/change_num.php',{delete:id+","+num});

        }






        window.addEventListener("load", function () {
            let minusNumButtons = document.querySelectorAll('.minus_num');  //減少數量
            let addNumButtons = document.querySelectorAll('.add_num');     //加數量
            let prodNumInputs = document.querySelectorAll('.prod_num'); //商品Input的數量
            let deleteButton = document.querySelectorAll('.delete');  //刪除
           


            for (i = 0; i < minusNumButtons.length; i++) {   //減num
                minusNumButtons[i].onclick = function () {
                    this.nextElementSibling.value == 1 ? this.nextElementSibling.value = 1 : this.nextElementSibling.value--;
                    changeNum(this.nextElementSibling);
                }
            }

            for (i = 0; i < addNumButtons.length; i++) {   //加num
                addNumButtons[i].onclick = function () {
                    this.previousElementSibling.value++;
                    changeNum(this.previousElementSibling);
                }
            }
            //數量變動
            for (i = 0; i < prodNumInputs.length; i++) { 
                prodNumInputs[i].onchange =function(){
                    changeNum(this);
                } 
            }

            //刪除
            for (i = 0; i < deleteButton.length; i++) {
                deleteButton[i].onclick = deleteItem;
            }

            //算total
            total();

            //購物車icon的小圓圓
            document.getElementById("cart_num").style.display='block';
            document.getElementById("cart_num").innerText=sessionStorage['shopList'].split(',').length-1;
        })

        

       
       
    </script>
</body>

</html>