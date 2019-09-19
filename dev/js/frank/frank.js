window.addEventListener("load", init, false);
window.addEventListener("resize", resize, false);
function init(){
       owlCarousel_img();
       favorite();
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




function favorite(){

    let xhr = new XMLHttpRequest();

    let hearts = document.getElementsByClassName('heart');

    for(let i=0;i<hearts.length;i++){

        hearts[i].addEventListener('click',function(e){



            xhr.onload = function(){ 
                if(xhr.status==200){

        
                }else{
                  alert(xhr.status);
                }
        
              }
        
            //設定好所要連結的程式
              var url = "php/frank/love.php?user_no="+sessionStorage['user_no']+'&work_no='+;
              xhr.open("GET", url, true); 
              xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        
            //送出資料
              var data_info = "work_no=" + parseInt(this.id.replace('work_close',''));
              console.log(parseInt(this.id.replace('work_close','')));//1.2......
              xhr.send(data_info);




            if(sessionStorage['user_name']){
                if(e.target.title == "加入收藏"){

                            this.src = "img/frank/plike.png";
                            this.title = "取消收藏"
                }else{
                            this.src = "img/frank/wlike.png";
                            this.title = "加入收藏";
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
function frank_vote(){
    if(rank1.readyState==4){
        var vote_rank= JSON.parse(rank1.responseText);
  //   console.log(vote_rank);
for (let i = 0; i < vote_rank.length -4; i++) {
     $("#frank_player_more").append($("#frank_player_items").clone(true).attr('id','frank_player_items'+i));
     $(`#frank_player_items${i} .frank_players_title span:eq(1)`).attr('id','aid'+(i+3));
    //  $(`#frank_player_items${i}  input:eq(0)`).attr('name','work_no'));
    console.log($(`#frank_player_items${i}  input:eq(0)`).attr('name','work_no'));
    
     $(`#frank_player_items${i} h3:eq(0)`).attr('id','id'+(i+3))
     $(`#frank_player_items${i} .frank_player_text span:eq(1)`).attr('id','vote'+(i+3));
     $(`#frank_player_items${i} .frank_player_pic img:eq(0)`).attr('id','bg'+(i+3));
     $(`#frank_player_items${i} .frank_player_pic img:eq(1)`).attr('id','ag'+(i+3));
     
}
   for (let i = 0; i < vote_rank.length -1; i++) {
    $id("vote"+`${i}`).innerText=vote_rank[i]["vote"];
    $id("bg"+`${i}`).src=vote_rank[i]["bg_img"];
    $id("ag"+`${i}`).src=vote_rank[i]["cmp_img"];
    $id("aid"+`${i}`).innerText=vote_rank[i]["work_name"];
    $id("id"+`${i}`).innerText=vote_rank[i]["user_name"];
    $("input[name='work_no']")[i].value=vote_rank[i]["work_no"];
 }}}

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
         console.log( vote_arr );
  // document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }}


//--------------------按鈕類--------------------------
function activity_button(){
$("#activity_join").click(function() {
join();
});
$('.frank_message_btn .btn_cloudp').click(function() {
        message_btn();
       
        
 });
$('.frank_closs_btn').click(function(){
        $('.frank_message').hide();
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
})

}
 function join(){
    // 先判斷sessionStorage有沒有會員登入資料，有才往下做轉圖檔工作
    if (sessionStorage['user_name']){
        //要拿到my_animal_img '  my_animal_bg_img ' my_animal_name  '  user_no
         join_xml();
    }else{
   //尚未登入
               $id('login_gary').style.display = 'block';
    }}

    function message_btn(){
      $('.frank_message_btn').addClass(function(){
          $('.frank_message').slideDown(50);
      })
    for (let i = 0; i < 2; i++) {
      
              $("#frank_message_content").append($("#message_wrap").clone(true).attr('id',''+i));
    //  $(`#frank_player_items${i} .frank_players_title span:eq(1)`).attr('id','aid'+(i+3));
     }

    
    
    
    }


