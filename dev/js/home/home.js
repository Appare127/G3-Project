function init() {

    animal_item()
   // anime();
    water();
}

function reinit() {
    animal_item();
}
var anime_state;
addEventListener("load", init);
addEventListener("resize", reinit);
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

        calss("home_animal_04")[0].style.height = anime_state / 100 * 20 + "px";
        calss("home_animal_04")[0].style.width = anime_state / 100 * 20 + "px";


        calss("home_animal_05")[0].style.height = anime_state / 100 * 20 + "px";
        calss("home_animal_05")[0].style.width = anime_state / 100 * 20 + "px";
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
    var home_animal_4 = new TimelineMax({
     
    });
    var home_animal_5 = new TimelineMax({
        
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

    .fromTo('.home_animal_01', .3, { 
      
        transformOrigin: "50% 80%",
    }
    ,{  ease: Power0.easeNone,
        yoyoease:Power0.easeNone,   
        rotation:380,
        yoyo: true,
        repeat: 10,
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
.fromTo('.home_animal_02', .2, { 
    transformOrigin: "50% 60%",
}
,{  ease: Power0.easeNone,
    yoyoease:Power0.easeNone,   
    yoyo: true,
    rotation:366    ,
    repeat: 8,
   
},4.4)
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


home_animal_4.to(".home_animal_04", 0, {
    x: 0,
    yPercent: -380,
    scaleX:-1,
    rotation:0,
    rotation:0,
  
}, ).to('.home_animal_04', 2, {
    x: 0,
    yPercent: 0,
  
    // delay: 1,
    
     ease: Bounce.easeOut,
},0.3 )
.to('.home_animal_04',.8, { 
    rotation:-740,
  
},1)
.fromTo('.home_animal_04', .6, { 
    transformOrigin: "50% 60%",
    rotation:20,
}
,{  ease: Power0.easeNone,
    yoyoease:Power0.easeNone,   
    rotation:-20,
    yoyo: true,
    repeat: -1,
},1.7)

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
    rotation:740,
  
},1.3)
.fromTo('.home_animal_05', .6, { 
    transformOrigin: "50% 60%",
    rotation:20,
}
,{  ease: Power0.easeNone,
    yoyoease:Power0.easeNone,   
    rotation:-20,
    yoyo: true,
    repeat: -1,
},2)
}

function water() {
    var hd_water_water = new TimelineMax({
        repeat: -1,
        yoyo: true,
    });

    var hd_water_item_1 = new TimelineMax({
        repeat: -1,

    });
    var hd_water_round_01= new TimelineMax({
        repeat: -1,
        yoyo:true,
    })

    hd_water_water.to("#hd_water_water", .8, {
      
        scaleX: 1.05,

        //scaleX:-1
    }, )
    
    hd_water_item_1
    .to(".hd_water_item01", 0, {
        autoAlpha:.3,
        scaleX: .8,
         xPercent: function(index, target) {
            return (index + 1) * 250 // 100, 200, 300
          },
          yPercent: function(index, target) {
            return (index + 1) * -8 // 100, 200, 300
          },
   }, 0)
    .staggerTo(".hd_water_item01", 2, {
         yPercent: 380,
         autoAlpha:1,
        ease: Power0.easeNone,
        stagger:.2 ,
      //  yoyo:true,
    }, 0)


    // var hd_water_item_2 = new TimelineMax ("#hd_water_item02",{
    //          repeat: -1,
    // })
//     hd_water_item_2
//     .to(".hd_water_item02",0,{
//         autoAlpha:0,
//         scaleX: .8,
//     },0)
//     .to(".hd_water_item02", 1, {
//     autoAlpha:.4,
//     }, 1)
//     .to( ".hd_water_item02",5, {
//          yPercent: 380,
//         ease: Power0.easeNone,
       
//     }, 1)
//     .to(".hd_water_item02",.1, {
//         autoAlpha:0,
//    },5.2 )


    hd_water_round_01.to(".hd_water_round",.8,{
        scale:1.1,
      })
}