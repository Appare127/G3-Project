let unicorn;
let trains = [];
let foods = [];
let moneys = [];
let uImg;
let tImg;
let rImg;
let mImg;
let bgImg;
let heartImg;

let scrollSpeed = 10; 
let x1 = 0;
let x2;
let rate = 0;
let life; 
let test = 999;
let test2 = 999;

// function scrollSpeed(period){
//     if(period<10){
//         return 2;
//     }else if(period >=10){
//         return 
//     }
// }
let timer=0;
let money=0;

let cusAnimal = {
    pic:'./img/game/0902.png',
}

let scene = {
    desert:{
        area:'img/game/遊戲背景-沙漠.png',
        monster:'img/game/蠍子.png',
        reward:'img/game/meat.png',
    },
    mountain:{
        area:'img/game/scene_mountain.png',
        monster:'img/game/lion.png',
        reward:'img/game/meat.png',
    },
    forest:{ 
        area:'img/game/scene_forest.png',
        monster:'img/game/lion.png',
        reward:'img/game/meat.png',
    }
}


function preload() {
    if(sessionStorage['sceneChoice'] == null){
        sessionStorage['sceneChoice'] = 'desert';
    }
    console.log(sessionStorage['sceneChoice']);
    uImg = loadImage(cusAnimal.pic);
    tImg = loadImage(scene[sessionStorage['sceneChoice']].monster);
    bgImg = loadImage(scene[sessionStorage['sceneChoice']].area);
    rImg = loadImage(scene[sessionStorage['sceneChoice']].reward);
    

    mImg = loadImage('./img/game/coin.png');
    heartImg = loadImage('./img/game/heart.png');
}

function setup() {

    if(windowWidth>=768){
        // gaming = document.getElementsByClassName('gaming')[0];
        var cnv = createCanvas(1200, 600);
        a=(windowWidth-width)/2;
        b=(windowHeight-height)/2;
        cnv.position(a,b);
        x2 = width;
        cnv.style('z-index', 1);
        // console.log(cnv.parent());
    }else {
        var cnv = createCanvas(windowWidth, windowHeight-50);
        x2 = width;
        cnv.style('z-index', 1);
    }
    unicorn = new Unicorn();
    life = 1;
    
}
// function mousePressed() {
//     if (mouseX > 0 && mouseX < 1200 && mouseY > 0 && mouseY < 600) {
//         let fs = fullscreen();
//         fullscreen(!fs);
//     }
// }

function touchStarted(){
    unicorn.jump();
}

function windowResized() {
    
    resizeCanvas(windowWidth, windowHeight*3/5);
    console.log(windowWidth);
}

// window.addEventListener('resize',function(){
//     cnv = createCanvas(3/5*windowWidth, 3/5*windowHeight);
//     a=(windowWidth-width)/2;
//     b=(windowHeight-height)/2;
//     cnv.position(a,b);
// });


function draw() {
    //阻擋空白鍵跟左右鍵的預設行為
    window.onkeydown = function (event) {
        if (event.keyCode === 32||event.keyCode===37||event.keyCode===39) {
            event.preventDefault();
        }
    };
    //背景移動
    rate++;
    image(bgImg, x1, 0, width, height);
    image(bgImg, x2, 0, width, height);

    x1 -= scrollSpeed;
    x2 -= scrollSpeed;

    if (x1 < -width) {
        x1 = width;
    }
    if (x2 < -width) {
        x2 = width;
    }
    //秀出生命值

    for(var i=0; i<life; i++){
        image(heartImg, 50 + 50*i, 50, 40, 40);
    }
    
    //秀出時間.金錢在右上角
    if(frameCount%60==0){
        timer++;
    }
    textSize(24);
    fill(33);
    text('$: '+money + '  生存時間： '+timer, 3/5*width, 80);
    

    // text(time, 3/4*width, 1/4*height);
    fill(0, 102, 153);

    //隨機生成障礙物
    if (random(1) < 0.02) {
        trains.push(new Train());
    }
    //隨機生成肉
    if (random(1) < 0.01) {
        foods.push(new Food());
    }
    //隨機生成金錢
    if(random(1)<0.05){
        moneys.push(new Money());
    }

    //動物的行為
    unicorn.show();
    unicorn.move();

    //操作動物的行為
    if(keyIsDown(LEFT_ARROW)){
        unicorn.x -= 10;
    }
    if(keyIsDown(RIGHT_ARROW)){
        unicorn.x += 10;
    }
    if(keyIsDown(32)){
        unicorn.jump();
    }

    // 碰到障礙物之後的行為
    for (let t of trains) {
        t.move();
        t.show();
        if (unicorn.hits(t)) {
            // console.log(life)

            if (trains.indexOf(t)  != test){
                life--;
                test = trains.indexOf(t);
            }


            if (life == 0) { //死掉後
                trains.splice(i-2,7);
                setTimeout(function(){
                    noLoop();
                },0.1);
                questionPage.style.display='block';
                reward_money.innerHTML = `得到獎金：${money}`;
                score_time.innerHTML = `生存時間：${timer}秒`;
            }
        }
    }
    //碰到肉之後的行為
    for(let f of foods){
        
        f.move();
        f.show();

        if ( unicorn.hits(f) ) {
            foods.splice(f,1);
            if(life<5){
                life++;
            }
        }
    }
    //碰到硬幣之後的行為
    for(let m of moneys){
        m.move();
        m.show();
        if ( unicorn.hits(m) ) {
            moneys.splice(m,1);
                money+=100;
        }
    }

}

