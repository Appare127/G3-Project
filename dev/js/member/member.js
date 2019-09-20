// window.addEventListener('load',function(){
// let user_no = sessionStorage.user_no;
// console.log(user_no)
// let xhr = new XMLHttpRequest();
// xhr.open("post", "../../G3/member.php", true);
// xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
// xhr.send(`user_no=${user_no}`);

// })


// <!------ ↓tab open page↓ ----->

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
    document.getElementById("default_open").classList.add("tablink_color");
  }
);

// <!------ ↑tab open page↑ ----->


// <!------ ↓上傳大頭貼↓ ----->

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

//<!------ ↓修改/儲存會員基本資料↓ ----->

//按了修改按鈕要開啟儲存 並且讓input可以修改
function updateBasic(){
  document.getElementById('btn_edit').style.display='none';
  document.getElementById('updated_it').style.margin='auto';
  document.getElementById('updated_it').style.display='block';
  
  document.getElementById('upFile').disabled=false; //讓選擇檔案可以按
  
  let redonlyOpen = document.querySelectorAll("input[readonly='readonly']");
  for (let i = 0; i < redonlyOpen.length; i++) {
    redonlyOpen[i].readOnly = false;//打開可以修改的功能
  }

}

//按了儲存按鈕要開啟修改 並且讓input關閉修改
function stockpileBasic(){
  document.getElementById('btn_edit').style.display='block';
  document.getElementById('btn_edit').style.margin='auto';
  document.getElementById('updated_it').style.display='none';

  let redonlyOpen = document.querySelectorAll("input[readonly='readonly']");

  for (let i = 0; i < redonlyOpen.length; i++) {
    redonlyOpen[i].readOnly = true;//關閉可以修改的功能
  }
}

window.addEventListener('load',
  function(){
    document.getElementById('btn_edit').onclick = updateBasic;
    document.getElementById('updated_it').onclick = stockpileBasic;
    document.getElementById('upFile').disabled=true; //讓選擇檔案不能按
  }
);

// <!------ ↑修改/儲存會員基本資料↑ ----->


// <!------ ↓訂單明細收合↓----->
var orderbtns=document.getElementsByClassName('js_order_show');
var orderDetails = document.getElementsByClassName('myorder_item_detail');
  
function showDetail(e){
  var itemDetails=e.target.parentNode.parentNode.parentNode.nextElementSibling;
  // console.log(itemDetails.classList);

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


// <!------ ↓預約qrcode收合↓ ----->

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



// <!------ ↓更新我的動物的狀態↓ ----->

    // 更新生命力
function updatehealth(){
  let total_health = sessionStorage.animal_life;

    let health_box = document.querySelector(".life_ability .pic");
    // console.log(health_box);
    health_box.innerHTML = '';
    for (let i=1; i<=total_health; i++){
        let hart = document.createElement('img');
        hart.src = 'img/modify/icon_life.png';
        health_box.appendChild(hart);
    }
}

window.addEventListener('load',updatehealth);

      // 更新跳躍力
function updatejump(){
  let total_jump = sessionStorage['animal_jump'];

  let jump = document.getElementsByClassName('bar_add')[0];
  let jump_value = document.getElementsByClassName('meter')[0];

  if (total_jump == 'null'){
    jump_value.innerText = 'm';
  }else{
    jump.style.width = `${total_jump*2}0%`;
    console.log(total_jump);
    jump_value.innerText = total_jump + 'm';
  }
}

window.addEventListener('load',updatejump);

      // 更新環境適應力
function updatechart(){
  let total_eml_forest = sessionStorage.environ_adapt_1;
  let total_eml_mountain = sessionStorage.environ_adapt_2;
  let total_eml_desert = sessionStorage.environ_adapt_3;

  myRadarChart.data.datasets[0].data = [total_eml_forest,total_eml_mountain,total_eml_desert];
  myRadarChart.update();
}

window.addEventListener('load',updatechart);

// <!------ ↑更新我的動物的狀態↑ ----->



// <!------ ↓取消收藏要消失div以及改資料庫資料↓ ----->


function setLove(){

  var xhr = new XMLHttpRequest();
  var close_love = document.getElementsByClassName('close_love');
  var my_love = document.getElementsByClassName('my_love')[0];



  for(let i=0;i<close_love.length;i++){

    close_love[i].addEventListener('click',function(e){
      e.preventDefault();

      xhr.onload = function(){ 
        if(xhr.status==200){

          //如果資料庫修改成功 在remove掉div
          my_love.removeChild(e.target.parentNode.parentNode);
          console.log(e.target.parentNode.parentNode);
          // alert('取消收藏');

        }else{
          alert(xhr.status);
        }

      }

    //設定好所要連結的程式
      var url = "php/member/update_Workno.php";
      xhr.open("Post", url, true); 
      xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");

    //送出資料
      var data_info = "work_no=" + parseInt(this.id.replace('work_close',''));
      console.log(parseInt(this.id.replace('work_close','')));//1.2......
      xhr.send(data_info);

    });
  }
}
window.addEventListener('load',setLove,false);
// <!------ ↑取消收藏要消失div以及改資料庫資料↑ ----->


//<!------ ↓alert訊息↓ ----->
function alert(e){
  $(" body").append('<div id="msg"><div id="msg_top">資訊<span class="msg_close">×</span></div><div id="msg_cont">'+e+'</div><div class="msg_close" id="msg_clear">確定</div></div>');
$(".msg_close").click(function (){
$("#msg").remove();

});
}


// $(".order_cancel").click(function () {
//   alert('測試');
//   e.preventDefault();
// });


function alertcancel(){

var order_cancel = document.getElementsByClassName('order_cancel');
var rev_cancel = document.getElementsByClassName('rev_cancel');

for(let y=0; y<order_cancel.length; y++){
  order_cancel[y].addEventListener('click',function(e){
  alert('您好:<br>已收到訂單取消請求，<br>待客服人員確認中...');
  // e.preventDefault();
  });
};

for(let z=0; z<rev_cancel.length; z++){
  rev_cancel[z].addEventListener('click',function(e){
  alert('您好:<br>已收到預約取消請求，<br>待客服人員確認中...');
  // e.preventDefault();
  });
};



}

window.addEventListener('load',alertcancel,false);

//<!------ ↑alert訊息↑ ----->


