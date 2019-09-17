window.addEventListener("load", init, false);
window.addEventListener("resize", resize, false);
function init(){
       owlCarousel_img();
       favorite();
      // frank_rank();
      frank_vote_rank2();
      frank_vote_rank();
}
function resize(){
   owlCarousel_img();
}
function favorite(){
 $(".heart").click(function(e){
       
    if(e.target.title == "加入收藏"){

        this.src = "img/frank/plike.png";
        this.title = "取消收藏"
    }else{
        this.src = "img/frank/wlike.png";
        this.title = "加入收藏";
    }
});
}
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
                        }
                    }
                })
            })
        } 
        else{ 
                $('.frank_top_three').addClass('owl-carousel');
                $('.frank_top_three').removeClass('owl-carousel');
        }        
}
$(document).ready(function(){
    $('.frank_message_btn').addClass(function(){
        $('.frank_message_btn').click(function(){
        $('.frank_message').slideDown(50);
    })
})
})
$(document).ready(function(){
    $('.frank_closs_btn').click(function(){
        $('.frank_message').hide();
    })
})
$(document).ready(function(){
        $('.frank_expand_arrow').click(function(){
        console.log($(this).index());   
        $(this).parent().next().animate({bottom:'0px'},1);
        console.log($(this).parent().next());  
})
})
$(document).ready(function(){
    $('.frank_expand_button').click(function(){
   
        $(this).parent().animate({bottom:'-800px'},1);
        console.log($(this).parent().next());  
    })
})
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
   
      console.log(vote_rank);
     }
}

function  frank_vote_rank2(){
    rank2=frank_rank();
    rank2.open("GET","php/frank/vote_rank2.php",true);
    rank2.onreadystatechange = frank_vote2;
    rank2.send(null);
}
function frank_vote2(){
    if(rank2.readyState==4){
        var vote_rank2= JSON.parse(rank2.responseText);
          console.log("rank2");
     console.log(vote_rank2);
    }
}