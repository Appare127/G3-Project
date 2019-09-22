window.addEventListener("load", init, false);
window.addEventListener("resize", resize, false);
function init(){
       owlCarousel_img();
       
      frank_vote_rank();
   //   vote_xml();
      activity_button();
     
}
function resize(){
   owlCarousel_img();
}
function $id(e){
 return document.getElementById(e);
}


//--------頁面載入控制----------------------

function favorite(){

    let xhr = new XMLHttpRequest();

    let hearts = document.getElementsByClassName('heart');

    for(let i=0;i<hearts.length;i++){
        
        hearts[i].addEventListener('click',function(e){
            // alert(111);
            xhr.onload = function(){ 
                if(xhr.status==200){
                   console.log(xhr.responseText);
        
                }else{
                  alert(xhr.status);
                }
        
              }
        
            if(sessionStorage['user_name']){
                if(e.target.title == "加入收藏"){
                    option='love';
                            this.src = "img/frank/plike.png";
                            this.title = "取消收藏";

                        //設定好所要連結的程式
                        var url = "php/frank/love.php?user_no="+sessionStorage['user_no']+'&work_no='+this.id.replace('NO_','')+'&option='+option;
                        //   console.log(url);
                        xhr.open("GET", url, true); 
                        //送出資料           
                        xhr.send(null);

                }else{
                    option='dislove';
                            this.src = "img/frank/wlike.png";
                            this.title = "加入收藏";

                        //設定好所要連結的程式
                        var url = "php/frank/dislove.php?user_no="+sessionStorage['user_no']+'&work_no='+this.id.replace('NO_','')+'&option='+option;
                        //   console.log(url);
                        xhr.open("GET", url, true); 
                        //送出資料           
                        xhr.send(null);


                    }

                // 如果sessionStorage沒有登入，則彈出提示登入的視窗
            }else{
                alert("請先登入會員");
                // $id('login_gary').style.display = 'block';

            }

        });
        }
    }

// function favorite(){
//  $(".heart").click(function(e){
       
//     if(e.target.title == "加入收藏"){

//         this.src = "img/frank/plike.png";
//         this.title = "取消收藏"
//     }else{
//         this.src = "img/frank/wlike.png";
//         this.title = "加入收藏";
//     }});}



function owlCarousel_img(){
      var _width = $(window).width(); 
        if(_width < 768){
            $('.frank_top_three').addClass('owl-carousel');
            $(document).ready(function(){  
                $(".owl-carousel").owlCarousel({
                    loop: false,//控制輪播
                    margin: 100,// 與右邊圖片的距離
                    nav: true,// 導航文字
                    dots: true,
                     dotsEach: true,
                    responsive: {
                        0: {
                            items: 1// 一次輪播幾個項目
                        },
                        768: {
                            items: 3// 一次輪播幾個項目
                        },
                        1000: {
                            items: 7// 一次輪播幾個項目 
                        }}})})} 
        else{ 
                $('.frank_top_three').addClass('owl-carousel');
                $('.frank_top_three').removeClass('owl-carousel');
        }}


function frank_vote(){
    if(rank1.readyState==4){
        var vote_rank= JSON.parse(rank1.responseText);
  //   console.log(vote_rank);
for (let i = 0; i < vote_rank.length -4; i++) {
     $("#frank_player_more").append($("#frank_player_items").clone(true).attr('id','frank_player_items'+i));
     $(`#frank_player_items${i} .frank_players_title span:eq(1)`).attr('id','aid'+(i+3));
     $(`#frank_player_items${i}  input:eq(0)`).attr('name','work_no');
     $(`#frank_player_items${i} h3 span:eq(0)`).attr('id','id'+(i+3));
     $(`#frank_player_items${i} span span:eq(0)`).attr('id','vote'+(i+3));
     $(`#frank_player_items${i} .frank_player_pic img:eq(0)`).attr('id','bg'+(i+3));
     $(`#frank_player_items${i} .frank_player_pic img:eq(1)`).attr('id','ag'+(i+3));
     $(`#frank_player_items${i} .frank_Collection_btn img:eq(0)`).attr('class','heart');
     let $input=(`<input type="hidden" name="work_no2"></input>`);
     let $input2=(`<input type="hidden" name="work_no3"></input>`)
     $(`#frank_player_items${i} .frank_message_btn .btn_cloudp `).append($input);
     $(`#frank_player_items${i} .frank_player_btn .btn_cloudb`).append($input2);     
}
   for (let i = 0; i < vote_rank.length -1; i++) {
    $id("vote"+`${i}`).innerText=vote_rank[i]["vote"];
    $id("bg"+`${i}`).src=vote_rank[i]["bg_img"];
    $id("ag"+`${i}`).src=vote_rank[i]["cmp_img"];
    $id("aid"+`${i}`).innerText=vote_rank[i]["work_name"];
    $id("id"+`${i}`).innerText=vote_rank[i]["user_name"];
    $("input[name='work_no']")[i].value=vote_rank[i]["work_no"];
    $("input[name='work_no2']")[i].value=vote_rank[i]["work_no"];
    $("input[name='work_no3']")[i].value=vote_rank[i]["work_no"];
    $(`.heart:eq(${i})`).attr('id','NO_'+(vote_rank[i]["work_no"]));
 }
 favorite();
}}



//----------------------PHP導入控制-----------------------------
function frank_rank(){
    if(window.ActiveXObject){
        xmlHttp= new ActiveXObject('Microsoft.XMLHTTP');
    }else if(window.XMLHttpRequest) {
        xmlHttp= new XMLHttpRequest();
    }
    return xmlHttp;
}
function  frank_vote_rank(){
    rank1=frank_rank();
    rank1.open("GET","php/frank/vote_rank.php",true);
    rank1.onreadystatechange = frank_vote;
    rank1.send(null);
}
function  join_xml(){
    join_item=frank_rank();
    join_item.open("GET","php/frank/join.php?user_no="+sessionStorage.user_no,true);
    join_item.onreadystatechange = join_php;
    join_item.send(null);  
}
function join_php(){
    if(join_item.readyState==4  && join_item.status==200){
        var join_arr= JSON.parse(join_item.responseText);
        if (join_arr=="error") {
            alert("這隻動物參加過了喔");
        }else{
             alert("參加成功");
        }}}
function  vote_xml(){
    vote_item=frank_rank();
    vote_item.open("GET","php/frank/vote.php?user_no="+sessionStorage.user_no,true);
    vote_item.onreadystatechange = vote_php;
    vote_item.send(null);
}
function vote_php(){
    if(vote_item.readyState==4  && vote_item.status==200){
        let vote_arr= JSON.parse(vote_item.responseText);
  // document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }}

function  message_xml(e){
 
    
    message_item=frank_rank();
    message_item.open("GET","php/frank/message.php?work_no="+e,true);
    message_item.onreadystatechange = message_php;
    message_item.send(null);
}
function message_php(){
    if(message_item.readyState==4  && message_item.status==200){
        let message_arr= JSON.parse(message_item.responseText);
        console.log( message_arr);
        
        message_btn(message_arr); 
  // document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }}

//--------------------按鈕類--------------------------
function activity_button(){
$("#activity_join").click(function() {
join();
});
$('.frank_message_btn .btn_cloudp').click(function() {
       let e =$(this).find("input")[0].value;
 
    
      $('.message_wrap_input input:eq(0)').val(e).attr({name:'work_no',id:'msg_btn_no'})
        message_xml(e)
 });
$('.frank_closs_btn').click(function(){
        $('.frank_message').hide();
        $('.message_itme').remove();
        $(`#input_text`)[0].value="";
});
  $('.frank_vote_btn .btn_cloudb').click(function(){

});
  $('#msg_btn').click(function(){
});
$('.frank_expand_arrow').click(function(){
        $(this).parent().next().animate({bottom:'0px'},1);
$('.frank_expand_button').click(function(){
        $(this).parent().animate({bottom:'-800px'},1);
    })
});
$('#msg_btn').click(function(){
   msg_value(); 
})


}
//-------------------按鈕函式------------------
 function join(){
    // 先判斷sessionStorage有沒有會員登入資料，有才往下做轉圖檔工作
    if (sessionStorage['user_name']){
        //要拿到my_animal_img '  my_animal_bg_img ' my_animal_name  '  user_no
         join_xml();
    }else{
   //尚未登入
               $id('login_gary').style.display = 'block';
    }}

function message_btn(e){
      message_arr=e;
      $('.frank_message_btn').addClass(function(){
          $('.frank_message').slideDown(50);
      })
    for (let i = 0; i < message_arr.length; i++) {
    $("#frank_message_content").append($("#message_wrap").clone(true).attr({id:'message_itme'+i,class:'message_itme frank_message_wrap'}));
    $(`#message_itme${i}   figure:eq(0)`).css("background",`${message_arr[i]['my_animalbg_img']}`);  
    $(`#message_itme${i}  .frank_megsage_memname p:eq(0)`).text(message_arr[i]['user_name']);
    $(`#message_itme${i}  .frank_megsage_memname p:eq(1)`).text(message_arr[i]['msg_date']);
    $(`#message_itme${i}  .frank_message_box p:eq(0)`).text(message_arr[i]['msg_content']);
    let $input=(`<input type="hidden" name="msg_no"></input>`)
    $(`#message_itme${i}  .frank_message_btn span:eq(0)`).attr('id','message_btn'+(i)).append($input);
    $(`#message_itme${i}  .frank_message_btn span:eq(0)`).attr('id','message_btn'+(i)).append($input);
    $(`#message_itme${i}   input`)[0].value=message_arr[i]['msg_no']
 }
    }

function msg_value() {
    if ($(`#input_text`).val()==0)
    { 
        return ;
    }
   // console.log( sessionStorage['user_no']);
  msg_xml=frank_rank();
   msg_xml.onreadystatechange=
   function()
    {
        if (msg_xml.readyState==4 && msg_xml.status==200)
        {
         //  console.log(msg_xml.responseText);
        }
    }
  // console.log( sessionStorage['user_no']);
         let msg_arr= $(`.message_wrap_input`).serializeArray();
         msg_xml.open("GET","php/frank/msg.php?work_no="+msg_arr[0]["value"]+"&msg="+msg_arr[1]["value"]+"&user="+sessionStorage['user_no'],true);
          msg_xml.send();
     $('.message_itme').remove();
     setTimeout(() => {
         msg_revalue()
     }, 100);  
}
function msg_revalue(){
     let e =$(`#msg_btn_no`).val();
    message_xml(e);
}
