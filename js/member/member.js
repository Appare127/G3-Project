// <!------ tab open page ----->

function open_page(e, className) {
  var i, tabcontents, tablinks;
  tabcontents = document.getElementsByClassName("tabcontent");

  for (i = 0; i < tabcontents.length; i++) {
    tabcontents[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].classList.remove("tablink_color");
  }

  document.getElementById(className).style.display = "block";
  e.currentTarget.classList.add("tablink_color");
  //  console.log(e.target);
}


let tablinks = document.getElementsByClassName("tablink");

tablinks[0].addEventListener('click', function () { open_page(event, 'member_basic') });
tablinks[1].addEventListener('click', function () { open_page(event, 'member_order') });
tablinks[2].addEventListener('click', function () { open_page(event, 'member_receive') });
tablinks[3].addEventListener('click', function () { open_page(event, 'member_love') });


window.addEventListener('load',
  function () {
    document.getElementById("default_open").click();
    document.getElementById("default_open").classList.add("red")
  }
);

// <!------ tab open page ----->


// <!------ 訂單明細收合----->
var orderbtns=document.getElementsByClassName('js_order_show');
var orderDetails = document.getElementsByClassName('myorder_item_detail');
  
function showDetail(e){
  var itemDetails=e.target.parentNode.parentNode.parentNode.nextElementSibling;
  console.log(itemDetails.classList);

    if(itemDetails.style.display=='block'){
      itemDetails.style.display = 'none';
    e.target.innerText="訂單詳細";
    itemDetails.classList.remove('show_detail');
    }else{
      itemDetails.style.display = 'block';
    e.target.innerText="收合";
    itemDetails.classList.add('show_detail');
  }

}

function initOrder(){
    for (var i=0 ;i<orderbtns.length ; i++){
        orderDetails[i].style.display = 'none';
      orderbtns[i].addEventListener('click',showDetail);
    }
}

window.addEventListener('load',initOrder,false);
// <!------ 訂單明細收合 ----->


// <!------ 預約qrcode收合 ----->

var qrshowbtns= document.getElementsByClassName('js_qr_show');

var qrcodeWraps=document.getElementsByClassName('qrcode_wrap');
var qrclosebtns= document.getElementsByClassName('btn_close');

function closeQrcode(e){
  e.target.parentNode.parentNode.style.display="none";
}

function showQrcode(e){

e.target.parentNode.parentNode.parentNode.nextElementSibling.style.display="block";
  // console.log(e.target);
}

function initQrcode(){
//點了按鈕 要秀出qrcode / 並且先將wrap都先隱藏

  for(var i=0;i<qrshowbtns.length;i++){
    //按鈕按了要有動作
    qrshowbtns[i].addEventListener('click',showQrcode);
    //先將wrap都隱藏
    qrcodeWraps[i].style.display = 'none';
    //點了X要關閉
    qrclosebtns[i].addEventListener('click',closeQrcode);
  }

}

window.addEventListener('load',initQrcode,false);

// <!------ 預約qrcode收合 ----->