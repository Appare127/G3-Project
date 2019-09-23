let unicorn;
let trains = [];
let fallens = [];
let foods = [];
let moneys = [];
let wings = [];
var drops = [];
var stones =[];
let angels=[];
let books= [];
let uImg;
let tImg;
let rImg;
let mImg;
let bgImg;
let heartImg;
let flyingTime;
let strongTime;
let stoneLife;
let angel;

let scrollSpeed = 10; 
let x1 = 0;
let x2;
let rate = 0;
let life; 
let test = 999;
let test2 = 999;

let timer=0;
let money=0;
let cusJump;
let environ_adapt;
let adapt_level;
let flyStatus = false;
let strongStatus = false;
let immuneStatus = false;
// let hitStatus = false;


let scene = { //場景資訊
    desert:{
        area:'img/game/遊戲背景-沙漠.png',
        monster:'img/game/蠍子.png',
        monsterSize:50,
        mWidth:50,
        mHeight:50,
        fallen:'img/game/meteor1.png',
        reward:'img/game/meat.png',
    },
    mountain:{
        area:'img/game/scene_mountain.png',
        monster:'img/game/lion.png',
        monsterSize:80,
        mWidth:100,
        mHeight:74,
        fallen:'img/game/meteor1.png',
        reward:'img/game/meat.png',
    },
    forest:{ 
        area:'img/game/scene_forest.png',
        monster:'img/game/lion.png',
        monsterSize:80,
        mWidth:100,
        mHeight:74,
        fallen:'img/game/meteor1.png',
        reward:'img/game/meat.png',
    }
}


function preload() {
    if(sessionStorage['sceneChoice'] == null){
        sessionStorage['sceneChoice'] = 'desert';//使用者若沒選 預定場景為沙漠
    }
    uImg = loadImage(sessionStorage['my_animal_img']+'?'+ new Date().getTime());//抓取最新的客製動物圖片
    tImg = loadImage(scene[sessionStorage['sceneChoice']].monster);
    fImg = loadImage(scene[sessionStorage['sceneChoice']].fallen)
    bgImg = loadImage(scene[sessionStorage['sceneChoice']].area);
    rImg = loadImage(scene[sessionStorage['sceneChoice']].reward);
    wImg = loadImage('img/game/wings.png');
    sImg = loadImage('img/game/gaming_stone.png');
    aImg = loadImage('img/game/gaming_maruko.png');
    
    if(sessionStorage['sceneChoice']=='forest'){ //依據選擇的場景決定適用的環境適應能力值
        environ_adapt = sessionStorage['environ_adapt_1']*0.5;
    }else if(sessionStorage['sceneChoice']=='mountain'){
        environ_adapt = sessionStorage['environ_adapt_2']*0.5;
    }else if(sessionStorage['sceneChoice']=='desert'){
        environ_adapt = sessionStorage['environ_adapt_3']*0.5;
    }else {
        environ_adapt = 1;
    }


    mImg = loadImage('./img/game/coin.png');
    heartImg = loadImage('./img/game/heart.png');
}

function setup() {
    // button = createButton('full screen'); //全螢幕按鈕
    // button.mousePressed(
    //     function(){
    //             let fs = fullscreen();
    //             fullscreen(!fs);
    //     }
    // );




    if(windowWidth>=768){ //canvas的RWD
        var cnv = createCanvas(1200, 600);
        a=(windowWidth-width)/2;
        b=(windowHeight-height)/2;
        cnv.position(a,b);
    }else {
        var cnv = createCanvas(windowWidth, windowHeight-50);
    }

    cnv.style('z-index', 1);
    x2 = width;

    unicorn = new Unicorn(sessionStorage['animal_life'],2); //客製動物 Unicorn(生命值,重力)
    life = unicorn.life;
    cusJump = sessionStorage['animal_jump'] *(-1)*4 + (-20);


    for (var k = 0; k < 500; k++) {
        drops[k] = new Drop();
    }
    
}



function windowResized() {
    if(window.innerWidth>=768){
        resizeCanvas(windowWidth, windowHeight*3/5);
    }else {
        resizeCanvas(windowWidth, windowHeight-50);
    }

}

function touchStarted(){
    unicorn.jump(cusJump);
    
 
}

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
        image(heartImg, 50 + 50*i, 48, 40, 36.8);
    }
    
    //秀出環境適應力在右上角
    
    if(environ_adapt<3){
        adapt_level = '低 - 有生命危險';
    }else if (environ_adapt==3){
        adapt_level = '中等 - 平淡的度過';
    }else if(environ_adapt >3){
        adapt_level = '高 - 躺著過關';
    }
    textSize(16);
    fill(33);
    text('環境適應力：'+ adapt_level, 3/5*width, 100);

    //秀出時間.金錢在右上角
    if(frameCount%60==0){
        timer++;
    }
    textSize(24);
    fill(33);
    text('$: '+money + '  生存時間： '+timer, 3/5*width, 80);

    // fill(0, 102, 153);

    //隨機生成障礙物
    setTimeout(function(){
        if (random(1) < (0.04/environ_adapt)) { 
            trains.push(new Train(scene[sessionStorage['sceneChoice']].monsterSize));
        }
    }, 10);



    if(timer<=25 && timer>=19){
        textSize(24);
        fill(33, 99, 100);
        text("系統提示:有流星~快許願(*￣▽￣)/‧☆*~~~~~~~", 1/3*width, 1/3*height);

    }
    if(timer>=20){ //20秒後開始掉隕石
        if (random(1) < (0.06/environ_adapt)) { // 掉隕石
            fallens.push(new Fallen(scene[sessionStorage['sceneChoice']].monsterSize));
        }

    }



    
    if(timer>=40){
        //40秒後開始下雨
        for (var r = 0; r < drops.length; r++) {
            drops[r].fall();
            drops[r].show();
            
            if(drops[r].y >= height + 20){
                drops.splice(r,1);
            }
          }
    }

    //隨機生成肉
    if (random(1) < 0.005*environ_adapt) {
        foods.push(new Food());
    }
    //隨機生成金錢
    if(random(1)<0.008*environ_adapt){
        moneys.push(new Money());
    }
    //隨機生成翅膀
    if(random(1)<0.0005*environ_adapt){
        wings.push(new Wing());
    }
    //隨機生成寶石
    if(random(1)<0.0005*environ_adapt){
        stones.push(new Stone());
    }



//     //隨機生成小丸子
    
//     if(random(1)<0.1 && angels.length == 0){
//         angels.push(new Angel());
//     }
//    console.log(angels[0]);

//     //小丸子的行為
//     for (let a of angels) {
//         a.show();
//         a.move();
//     }

//     //隨機生成書本
//     if(random(1)<0.1 && angels[0].readyStatus==true){
//         books.push(new Book(angels[0].posX,angels[0].posY));
//     }

//     for (let b of books) { //掉下書本
//         b.move();
//         b.show();

//     }


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
        unicorn.jump(cusJump);

    }


    // 碰到障礙物之後的行為
    for (let t of trains) {
        t.move();
        t.show(scene[sessionStorage['sceneChoice']].mWidth,scene[sessionStorage['sceneChoice']].mHeight);

        
        if (unicorn.hits(t)) {

            if(strongStatus == true){
                setTimeout(function(){
                    trains.splice(t,1);
                },1000);
            }

            if (trains.indexOf(t)!= test && strongStatus==false){//避免重複扣掉生命
                life--;
                test = trains.indexOf(t);
            }


            if (life == 0) { //死掉後
                trains.splice(i-5,15);
                setTimeout(function(){
                    noLoop();
                },0.1);

                updateScoreMoney();
                questionPage.style.display='block';
                reward_money.innerHTML = `得到獎金：${money}`;
                score_time.innerHTML = `生存時間：${timer}秒`;

            }
        }
    }

    for (let f of fallens) { //掉下隕石
        f.move();
        f.show();
        if (unicorn.hits(f)) {

            if(strongStatus == true){
                setTimeout(function(){
                    fallens.splice(f,1);
                },1000);
            }

            if (fallens.indexOf(f) != test2 && strongStatus==false){//避免重複扣掉生命
                life--;
                test2 = fallens.indexOf(f);
            }

            if (life == 0) { //死掉後
                fallens.splice(i-5,15);
                setTimeout(function(){
                    noLoop();
                },0.1);

                updateScoreMoney();
                questionPage.style.display='block';
                reward_money.innerHTML = `得到獎金：${money}`;
                score_time.innerHTML = `生存時間：${timer}秒`;

            }
        }
    }

    //碰到肉之後的行為
    for(let f of foods){
        // console.log('碰到肉');
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
                money+=1;
        }
    }
    //碰到翅膀之後的行為
    for(let w of wings){

        w.move();
        w.show();
        if ( unicorn.hits(w) ) { //吃到翅膀後的行為
            flyingTime = timer;
            wings.splice(w,1);
            flyStatus = true;
        }
        
    }
    if ( timer >= parseInt(flyingTime)+10 ){
        flyStatus = false;
        // myAudio.pause();
        // myAudio.currentTime = 53;

    }

    if(timer>=parseInt(flyingTime) && timer< (flyingTime+10) ){

        // myAudio=document.getElementById('audio2');
        // myAudio.play();
       

        textSize(20);
        fill(255,69,0);
        text(`飛行狀態: ${10+flyingTime - timer}秒`, 3/5*width, 1/5*height+10);
    }



    //石頭的行為
    for(let s of stones){

        s.move();
        s.show();

        if ( unicorn.hits(s) ) { //吃到石頭後的行為
            strongTime = timer;
            stones.splice(s,1);
            strongStatus = true;
            unicorn.r = 400;
            stoneLife = life;
            
            unicorn.y = height-350;
        }
    }
    // if(strongStatus == true){
    //     life = stoneLife;
    // }
    if ( timer >= parseInt(strongTime)+10 ){
        strongStatus = false;
        unicorn.r = 150;
    }

    if(timer>=parseInt(strongTime) && timer< (strongTime+10) ){
        textSize(20);
        fill(255,69,0);
        text(`過胖狀態: ${10+strongTime - timer}秒`, 3/5*width, 1/5*height+30);
    }
}

