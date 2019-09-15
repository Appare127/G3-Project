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

let timer=0;
let money=0;
let cusJump;


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
    uImg = loadImage(sessionStorage['animal_img']+'?'+ new Date().getTime());

    tImg = loadImage(scene[sessionStorage['sceneChoice']].monster);
    bgImg = loadImage(scene[sessionStorage['sceneChoice']].area);
    rImg = loadImage(scene[sessionStorage['sceneChoice']].reward);
    

    mImg = loadImage('./img/game/coin.png');
    heartImg = loadImage('./img/game/heart.png');
}

function setup() {
    button = createButton('full screen'); //全螢幕按鈕
    button.mousePressed(
        function(){
                let fs = fullscreen();
                fullscreen(!fs);
        }
    );


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
    
    console.log(cusJump);
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
        unicorn.jump(cusJump);
        console.log(sessionStorage['animal_jump']);
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

