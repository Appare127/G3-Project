window.addEventListener("load", init, false);
window.addEventListener("resize", resize, false);
function init(){
       owlCarousel_img();
       favorite();
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
// $(document).ready(function(){
//     var COLORS, Confetti, NUM_CONFETTI, PI_2, canvas, confetti, context, drawCircle, i, range, resizeWindow, xpos;

//     NUM_CONFETTI = 30;

//     COLORS = [[244,164,96]];

//     PI_2 = 1 * Math.PI;

//     canvas = document.getElementById("world");

//     context = canvas.getContext("2d");

//     window.w = 0;

//     window.h = 0;

//     resizeWindow = function() {
//     window.w = canvas.width = window.innerWidth;
//     return window.h = canvas.height = window.innerHeight;
//     };

//     window.addEventListener('resize', resizeWindow, false);

//     window.onload = function() {
//     return setTimeout(resizeWindow, 0);
//     };

//     range = function(a, b) {
//     return (b - a) * Math.random() + a;
//     };

//     drawCircle = function(x, y, r, style) {
//     context.beginPath();
//     context.arc(x, y, r, 0, PI_2, false);
//     context.fillStyle = style;
//     return context.fill();
//     };

//     xpos = 1;

//     document.onmousemove = function(e) {
//     return xpos = e.pageX / w;
//     };

//     window.requestAnimationFrame = (function() {
//     return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
//         return window.setTimeout(callback, 1000 / 60);
//     };
//     })();

//     Confetti = class Confetti {
//     constructor() {
//     this.style = COLORS[~~range(0)];
//         this.rgb = `rgba(${this.style[0]},${this.style[1]},${this.style[2]}`;
//         this.r = ~~range(2, 4);
//         this.r2 = 2 * this.r;
//         this.replace();
//     }

//     replace() {
//         this.opacity = 1;
//         this.dop = 0.01 * range(1, 0.1);
//         this.x = range(-this.r2, w - this.r2);
//         this.y = range(-20, h - this.r2);
//         this.xmax = w - this.r;
//         this.ymax = h - this.r;
//         this.vx = range(0, 2) + 8 * xpos - 5;
//         return this.vy = 0.7 * this.r + range(-1, 1);
//     }

//     draw() {
//         var ref;
//         this.x += this.vx;
//         this.y += this.vy;
//         this.opacity += this.dop;
//         if (this.opacity > 1) {
//         this.opacity = 1;
//         this.dop *= -1;
//         }
//         if (this.opacity < 0 || this.y > this.ymax) {
//         this.replace();
//         }
//         if (!((0 < (ref = this.x) && ref < this.xmax))) {
//         this.x = (this.x + this.xmax) % this.xmax;
//         }
//         return drawCircle(~~this.x, ~~this.y, this.r, `${this.rgb},${this.opacity})`);
//     }

//     };

//     confetti = (function() {
//     var j, ref, results;
//     results = [];
//     for (i = j = 1, ref = NUM_CONFETTI; (1 <= ref ? j <= ref : j >= ref); i = 1 <= ref ? ++j : --j) {
//         results.push(new Confetti);
//     }
//     return results;
//     })();

//     window.step = function() {
//     var c, j, len, results;
//     requestAnimationFrame(step);
//     context.clearRect(1, 1, w, h);
//     results = [];
//     for (j = 0, len = confetti.length; j < len; j++) {
//         c = confetti[j];
//         results.push(c.draw());
//     }
//     return results;
//     };

//     step();

// })










