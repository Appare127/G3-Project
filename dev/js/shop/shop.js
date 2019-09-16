function choosePic(){
    if(sessionStorage.user_id){  //如果登入了  撈session
        document.querySelectorAll(".choose_pic .shop_animal_bg")[0].src=sessionStorage.my_animal_bg_img;
        document.querySelectorAll(".choose_pic .shop_animal")[0].src=sessionStorage.my_animal_img;
    }else{   //如果沒登入，給預設圖片
    document.querySelectorAll(".choose_pic .shop_animal_bg")[0].src='img/shop/animal_bg1.png';
    document.querySelectorAll(".choose_pic .shop_animal")[0].src='img/shop/animal1.png';
    }
};

function changePic(e){    //點了會換圖
    let bg=this.children[0].children[0].src;
    let animal=this.children[0].children[1].src;
    document.querySelectorAll('.choose_product .prod_img').forEach((element,i) => {
        element.children[1].children[0].src=bg;
        element.children[1].children[1].src=animal;
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

    for(i=0;i<minusNumButtons.length;i++){   //減num
        minusNumButtons[i].onclick=function(){
            this.nextElementSibling.value==0?this.nextElementSibling.value=0:this.nextElementSibling.value--;
        }
    }

    for(i=0;i<addNumButtons.length;i++){   //加num
        addNumButtons[i].onclick=function(){
            this.previousElementSibling.value++;
        }
    }

    bgButtons[0].onclick=function(){   //要背景圖
        for(i=0;i<document.querySelectorAll(".shop_animal_bg").length;i++){
            document.querySelectorAll(".shop_animal_bg")[i].style.visibility="visible";
        }
        for(i=0;i<document.querySelectorAll(".prod_img .shop_animal").length;i++){
            document.querySelectorAll(".prod_img .shop_animal")[i].style.width='50%';
            document.querySelectorAll(".prod_img .shop_animal")[i].style.transform='translate(-50%,0)';
        }
    }

    bgButtons[1].onclick=function(){   //不要背景圖
        for(i=0;i<document.querySelectorAll(".shop_animal_bg").length;i++){
            document.querySelectorAll(".shop_animal_bg")[i].style.visibility="hidden";
        };
        for(i=0;i<document.querySelectorAll(".prod_img .shop_animal").length;i++){
            document.querySelectorAll(".prod_img .shop_animal")[i].style.width='100%';
            document.querySelectorAll(".prod_img .shop_animal")[i].style.transform='translate(-50%,-50%)';
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
            document.querySelector('.prod_detail .shop_animal').src=this.parentNode.parentNode.children[2].children[1].children[1].src;
            document.getElementById('detail_pic_chosen').className=this.parentNode.parentNode.children[2].children[1].className;
            document.querySelector('.prod_detail .prod_text p').innerText=JSON.parse(this.nextElementSibling.nextElementSibling.value).product_description;
        } 
    }

    for(i=0;i<addCartButtons.length;i++){  //加入購物車
        addCartButtons[i].onclick=function(){
            // alert("已成功加入");
            // document.getElementById("cart_num").style.display='block';
            console.log(this.nextElementSibling().value)
        }
    }

    for(i=0;i<changePicBtn.length;i++){   //點按圖片會換 
        changePicBtn[i].onclick=changePic;          
        // console.log(changePicBtn[i]) 
    }

    choosePic();   //loading進那四張動物圖片
    
}); 