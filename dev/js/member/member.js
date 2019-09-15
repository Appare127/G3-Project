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

// <!------ ↑tab open page↑ ----->


// <!------ 上傳大頭貼 ----->

function fileChange(){

  let readFile = new FileReader();
  let file = document.getElementById('upFile').files[0];
  readFile.readAsDataURL(file);
  readFile.addEventListener('load',function(){
    let upfilePic = document.getElementById('upfile_pic');
    upfilePic.src= this.result;
  })

}

window.addEventListener('load',function(){
  document.getElementById('upFile').onchange = fileChange;
})

// <!------ ↑上傳大頭貼↑ ----->

// <!------ 修改會員基本資料 ----->
function  updateBasic(){
  document.getElementById('btn_edit').style.display='none';
  document.getElementById('updated_it').style.display='block';
  x=document.querySelectorAll("input[readonly='readonly']");

  for (i = 0; i < x.length; i++) {
    x[i].readOnly = false;
}

}
window.addEventListener('load',function(){
  document.getElementById('btn_edit').onclick = updateBasic});


// <!------ ↑修改會員基本資料↑ ----->

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
// <!------ ↑訂單明細收合↑ ----->


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

// <!------ ↑預約qrcode收合↑ ----->

// function getOrder(){
//   let user_no=sessionStorage.user_no;
//   // console.log(user_no);
//   let xhr = new XMLHttpRequest();

//   xhr.onload = function () {
//     if (xhr.status == 200) {
//         if (xhr.responseText.indexOf("noOrder") != -1) {
//             alert("沒有訂單");
//       } else { //有訂單
//           let userData=JSON.parse(xhr.responseText)[0];
//           console.log(userData);
//           document.getElementById('orderNo').innerText=userData.order_no;
          
//       }

//     } else {
//         alert(xhr.statusText);
//     }
// }


//   xhr.open("post", "php/getOrder.php", true);
//   xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
//   xhr.send(`user_no=${user_no}`);


// }
// window.addEventListener('load',getOrder);



// document.getElementById('').innerText=sessionStorage.user_no



// function getFile(){
//   x= document.getElementsByName("upFile")[0].value
// document.getElementsByName("upFile")[0].value = document.getElementById('upfile_pic').src;
// console.log(document.getElementsByName("upFile")[0].value);
// console.log(document.getElementById('upfile_pic').src);
// }
// window.addEventListener('load',getFile,false);