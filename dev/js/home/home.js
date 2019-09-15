function init() {
    getRankData();
    animal_item();
    anime();
    water();
}

function reinit() {
    animal_item();
}
var anime_state;
addEventListener("load", init);
addEventListener("resize", reinit);

function getRankData(){
 
    var xhr = new XMLHttpRequest();
    xhr.onload=function (){
        if( xhr.status == 200 ){ 
            userDataDesc = JSON.parse(xhr.responseText);
            // alert(userDataDesc[0].my_animal_img);
            console.log(userDataDesc);
            //塞入前三名照片跟資料
            for(let j=0; j<3; j++){
                document.querySelectorAll('.top_animal_img')[j].src = userDataDesc[j].my_animal_img;
                document.querySelectorAll('.top_score')[j].innerText = userDataDesc[j].game_record + '秒';
                document.querySelectorAll('.top_animal_name')[j].innerText = userDataDesc[j].my_animal_name;
            }
        }else{
            alert( xhr.status );
        }
    }
    var url = "php/game/getRankingData.php";
    xhr.open("Get", url, true);  //readyState : 1
    xhr.send( null );

}

function animal_item() {
    anime_state = (calss("home_header_pic")[0].attributes.class.ownerElement.clientWidth);
    if (window.innerWidth <= 767) {
        calss("home_animal_01")[0].style.height = anime_state / 100 * 15 + "px";
        calss("home_animal_01")[0].style.width = anime_state / 100 * 15 + "px";

        calss("home_animal_02")[0].style.height = anime_state / 100 * 15 + "px";
        calss("home_animal_02")[0].style.width = anime_state / 100 * 15 + "px";

        calss("home_animal_03")[0].style.height = anime_state / 100 * 15 + "px";
        calss("home_animal_03")[0].style.width = anime_state / 100 * 15 + "px";

        calss("home_animal_04")[0].style.height = anime_state / 100 * 15 + "px";
        calss("home_animal_04")[0].style.width = anime_state / 100 * 15 + "px";


        calss("home_animal_05")[0].style.height = anime_state / 100 * 15 + "px";
        calss("home_animal_05")[0].style.width = anime_state / 100 * 15 + "px";
    }
    if (window.innerWidth > 767) {
        calss("home_animal_01")[0].style.height = anime_state / 100 * 20 + "px";
        calss("home_animal_01")[0].style.width = anime_state / 100 * 20 + "px";

        calss("home_animal_02")[0].style.height = anime_state / 100 * 20 + "px";
        calss("home_animal_02")[0].style.width = anime_state / 100 * 20 + "px";

        calss("home_animal_03")[0].style.height = anime_state / 100 * 18 + "px";
        calss("home_animal_03")[0].style.width = anime_state / 100 * 18 + "px";

        calss("home_animal_04")[0].style.height = 0 + "px";
        calss("home_animal_04")[0].style.width = 0 + "px";


        calss("home_animal_05")[0].style.height = anime_state / 100 * 20 + "px";
        calss("home_animal_05")[0].style.width = anime_state / 100 * 20 + "px";
 

        let x = document.querySelectorAll(".home_animal");
        
        for (let i = 0; i < x.length; i++) {
         x[i].style.display = "block";
           }
       
       
    }







}

function calss(e) {
    return document.getElementsByClassName(e);
}
var test = 30;

function anime() {
    
     CustomEase.create("custom", "M0,0,C0.14,0,0.334,0.415,0.364,0.538,0.405,0.705,0.562,0.963,0.57,1,0.578,0.985,0.595,0.968,0.636,0.906,0.684,0.83,0.765,0.868,0.782,0.89,0.784,0.892,0.867,0.998,0.868,1,0.882,0.978,0.918,0.95,0.932,0.95,0.968,0.96,1,1,1,1")
    var home_animal_1 = new TimelineMax({
        repeat: -1,
    });
    var home_animal_2 = new TimelineMax({
        repeat: -1,
    });
    var home_animal_3 = new TimelineMax({
   repeat:-1,
      
    });
 
    var home_animal_5 = new TimelineMax({
        repeat:-1,
    });


    home_animal_1.to(".home_animal_01", 0, {
        x: 0,
        yPercent: -380,
        //scaleX:-1
        rotation:0,
    }, ).to('.home_animal_01', 2, {
        x: 0,
        yPercent: 0,
        // delay: 1,
        ease:"custom",
    }, )
    .to('.home_animal_01',.6 , { 
        rotation:360,
        transformOrigin: "50% 50%",
    },.6)

    .fromTo('.home_animal_01', .1, { 
      
        transformOrigin: "50% 80%",
    }
    ,{  ease: Power0.easeNone,
        yoyoease:Power0.easeNone,   
        rotation:370,
        yoyo: true,
        repeat: 18,
        delay:1,
    },1.)
    .to('.home_animal_01', 3, { 
        xPercent: 150,
        yPercent: -10,
        scale: .4, 
    },2)
    .to('.home_animal_01', .1, { 
        autoAlpha:0,
    },4 )
//-------------------------------------------------------------------

home_animal_2.to(".home_animal_02", 0, {
    x: 0,
    yPercent: -380,
    //scaleX:-1
    rotation:0,
}, ).to('.home_animal_02', 3, {
    x: 0,
    yPercent: 0,
     ease: Bounce.easeOut,
},1.2 )
.to('.home_animal_02',1, { 
    rotation:360,
    transformOrigin: "50% 50%",
},2.4)
.to('.home_animal_02',.2, { 
    rotation:354,
},4.2)
.fromTo('.home_animal_02', .1, { 
    transformOrigin: "50% 60%",
}
,{  ease: Power0.easeNone,
    yoyoease:Power0.easeNone,   
    yoyo: true,
    rotation:366    ,
    repeat: 12,
   
},4.2)
.to('.home_animal_02', 3, { 
    xPercent: 130,
    yPercent: 10,
    scale: .5, 
},4.2)
.to('.home_animal_02', .3, { 
    autoAlpha:0,
}, )

//*************************************************************** */
//anomal3的延遲變數

let aS=0.8;
home_animal_3.to(".home_animal_03", 0, {
    x: 0,
    yPercent: -380,
    //scaleX:-1
    rotation:0,
}, ).to('.home_animal_03', 2, {
    x: 0,
    yPercent: 0,
    // delay: 1,
    ease:"custom",
},aS )
.to('.home_animal_03',.6 , { 
    rotation:360,
    transformOrigin: "50% 50%",
},aS+.6)

.fromTo('.home_animal_03', .3, { 
    transformOrigin: "50% 80%",
}
,{  ease: Power0.easeNone,
    yoyoease:Power0.easeNone,   
    rotation:380,
    yoyo: true,
    repeat: 3,
    delay:1,
},aS+1.)
.to('.home_animal_03', 3, { 
    xPercent: 70,
    yPercent: 0,
    scale: .4, 
},aS+2)
.to('.home_animal_03', .1, { 
    autoAlpha:0,
},aS+4 )

//******************************************************** */


home_animal_5.to(".home_animal_05", 0, {
    x: 0,
    yPercent: -380,
    scaleX:-1,
    rotation:0,
    rotation:0,
}, ).to('.home_animal_05', 2, {
    x: 0,
    yPercent: 0,
    // delay: 1,
     ease: Bounce.easeOut,
},0.6 )
.to('.home_animal_05',.8, { 
    rotation:-740,
},1.3)
.to('.home_animal_05',2,{
    yPercent: -38,
    xPercent: -60,
    scaleX:- 0.5,
    scaleY:0.5,
})
.to('.home_animal_05',5,{
    scaleX:- 0.3,
    scaleY:0.3,
    xPercent: -180,
})
.fromTo('.home_animal_05', .3, { 
    
    rotation:5,
}
,{  ease: Power0.easeNone,
    yoyoease:Power0.easeNone,   
    rotation:-5,
    yoyo: true,
    repeat: 25,
    transformOrigin: "50% 80%",
},2)

}

function water() {
    var hd_water_water = new TimelineMax({
        repeat: -1,
        yoyo: true,
      //  paused: true,
    });

    var hd_water_item_11 = new TimelineMax({
        repeat: -1,
        //paused: true,
    });
    var hd_water_item_12 = new TimelineMax({
        repeat: -1,
        //paused: true,
    });
    var hd_water_item_13 = new TimelineMax({
        repeat: -1,
        //paused: true,
    });
    var hd_water_item_21 = new TimelineMax({
        repeat: -1,
       
    });
    var hd_water_item_22 = new TimelineMax({
        repeat: -1,
       
    });
    var hd_water_item_31 = new TimelineMax({
        repeat: -1,
       
    });
    var hd_water_item_32 = new TimelineMax({
        repeat: -1,
       
    });
    var hd_water_round= new TimelineMax({
        repeat: -1,
        yoyo:true,
      //  paused: true,
    })
    var hd_water_round_01= new TimelineMax({
        repeat: -1,
        yoyo:true,
      //  paused: true,
    })

    var hd_water_round_02= new TimelineMax({
        repeat: -1,
        yoyo:true,
      //  paused: true,
    })
    var hd_water_round_03= new TimelineMax({
        repeat: -1,
        yoyo:true,
      //  paused: true,
    })

    hd_water_water.to("#hd_water_water", .6, {
      
        scaleX: 1.02,

        //scaleX:-1
    }, )
//水流

 let wx=0.9;
    hd_water_item_11
    .to(".hd_water_item011", 0, {
        autoAlpha:.3,
        scaleX: .8,
         xPercent: function(index, target) {
            return (index) * 650 // 100, 200, 300
          },
   }, 0)
    .staggerTo(".hd_water_item011",wx, {
         yPercent: 1000,
         autoAlpha:1,
        ease: Power0.easeNone,
         stagger:.5,
      //  yoyo:true,
    }, 0)

    hd_water_item_12
    .to(".hd_water_item012", 0, {
        autoAlpha:.3,
        scaleX: .8,
         xPercent: function(index, target) {
            return (index ) * 650  +975// 100, 200, 300
          },
   }, 0)
    .staggerTo(".hd_water_item012",wx+0.2, {
         yPercent: 1000,
         autoAlpha:1,
        ease: Power0.easeNone,
         stagger:.8,
      //  yoyo:true,
    },)
    hd_water_item_13
    .to(".hd_water_item013", 0, {
        autoAlpha:.3,
        scaleX: .6,
         xPercent: function(index, target) {
            return (index ) * 650  +325// 100, 200, 300
          },
   }, 0)
    .staggerTo(".hd_water_item013",wx, {
         yPercent: 1000,
         autoAlpha:1,
        ease: Power0.easeNone,
         stagger:.1,
      //  yoyo:true,
    }, 1.5)

    hd_water_item_21
    .to(".hd_water_item021", 0, {
        autoAlpha:1,
       // scaleX: .8,
         xPercent: function(index, target) {
            return (index ) * 400 // 100, 200, 300
          },
   }, )
    .staggerTo(".hd_water_item021",wx-0.1, {
         yPercent: 1400,
         autoAlpha:1,
        ease: Power0.easeNone,
         stagger:.2,
      //  yoyo:true,
    }, 1)
    hd_water_item_22
    .to(".hd_water_item022", 0, {
        autoAlpha:1,
       // scaleX: .8,
         xPercent: function(index, target) {
            return (index) * 100 // 100, 200, 300
          },
   }, )
    .staggerTo(".hd_water_item022",wx+.1, {
         yPercent: 1400,
         autoAlpha:1,
        ease: Power0.easeNone,
         stagger:.2,
      //  yoyo:true,
    }, )
    hd_water_item_31
    .to(".hd_water_item031", 0, {
        autoAlpha:1,
       // scaleX: .8,
         xPercent: function(index, target) {
            return (index) * 500 -300// 100, 200, 300
          },
   }, )
    .staggerTo(".hd_water_item031",.6, {
         yPercent: 450,
         autoAlpha:1,
        ease: Power0.easeNone,
         stagger:.7,
      //  yoyo:true,
    }, )

    hd_water_item_32
    .to(".hd_water_item032", 0, {
        autoAlpha:1,
       // scaleX: .8,
         xPercent: function(index, target) {
            return (index) * 500 -300// 100, 200, 300
          },
   }, )
    .staggerTo(".hd_water_item032",.6, {
         yPercent: 450,
         autoAlpha:1,
        ease: Power0.easeNone,
         stagger:-.4,
      //  yoyo:true,
    },.3 )





    hd_water_round
    .to(".hd_water_round",0,{
        xPercent: function(index, target) {
            return (index ) * 60 // 100, 200, 300
          },
      },0)
      hd_water_round_01
      .to(".hd_water_round11",.8,{
        scale:1.05,
      },)
      hd_water_round_02
      .to(".hd_water_round12",.6,{
        scale:1.08,
      },.3)
      hd_water_round_03
      .to(".hd_water_round13",.7,{
        scale:1.06,
        
      },.3)
}