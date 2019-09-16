window.addEventListener("load", init, false);
window.addEventListener("resize", resize, false);
function init(){
       owlCarousel_img();
       favorite();
       frank_rank()
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
        console.log($(this).index());
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
    frank_vote_refresh(xmlHttp);
}
function  frank_vote_refresh(xmlHttp){
    xmlHttp.open("GET","php/frank/frank.php",true);
    xmlHttp.onreadystatechange = frank_vote;

    xmlHttp.send(null);
}
function frank_vote(){
      
        
     console.log(xmlHttp.readyState);
    if(xmlHttp.readyState==4){

        var data= JSON.parse(xmlHttp.responseText);
    
     console.log(data);
    
    }
}