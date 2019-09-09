
let parts_icon = document.getElementsByClassName("parts_icon");
let picon = document.getElementsByClassName("picon");


// 總能力值初始化0
let total_eml_forest = 0;       //森林
let total_eml_mountain = 0;     //高山
let total_eml_desert = 0;       //沙漠
let total_health = 0;           //血量
let total_jump = 0;             //跳躍力

// 各別部件的能力值初始化0
let head_eml_forest = 0;
let head_eml_desert = 0;
let head_eml_mountain = 0;

let body_eml_forest = 0;
let body_eml_desert = 0;
let body_eml_mountain = 0;

let foot_eml_forest = 0;
let foot_eml_desert = 0;
let foot_eml_mountain = 0;

// 設有幾種部件，後面的隨機會用到
let part_types = picon.length / 4;

function dopic(){
    
    html2canvas(document.getElementsByClassName('pic_box')[0] , {
        // backgroundColor: '',
        backgroundColor: 'transparent',
        allowTaint: true,
        useCORS: true,
        logging: true,
        width: 400,
        height: 400,
    }).then(function(canvas){

        let url = canvas.toDataURL("image/png");
        let btn = document.getElementsByClassName('sss')[0];
        btn.href = url;
        document.body.appendChild(canvas);
        // console.log(btn.href);
    });

}


function changeParts(e){

    // 從點到的圖片網址裡去抓出部件種類出來
    let urlstr = e.target.src;
    let type_x = urlstr.lastIndexOf('/');
    let type_y = urlstr.indexOf('_');
    let type_name = urlstr.substring(type_x +1 ,type_y);
    // console.log(type_name);

    // 從點到的圖片網址裡去抓出動物名稱出來
    let animal_y = urlstr.lastIndexOf('.');
    let animal_name = urlstr.substring(type_y +1 ,animal_y);
    // console.log(animal_name);

    // 用if去判斷不同部位選擇要更換相應的圖片
    if (type_name == 'head'){
        document.getElementsByClassName('head_pic')[0].src = `img/modify/p_head_${animal_name}.png`;
        // 抓到選擇的頭部三種環境適應力
        head_eml_forest = e.target.nextElementSibling.dataset.pointa;
        head_eml_mountain = e.target.nextElementSibling.dataset.pointb;
        head_eml_desert = e.target.nextElementSibling.dataset.pointc;
        // console.log(head_eml_forest + ',' + head_eml_mountain + ',' + head_eml_desert);
        


    }else if (type_name == 'body'){
        document.getElementsByClassName('body_pic')[0].src = `img/modify/p_body_${animal_name}.png`;
        // 抓到選擇的身體三種環境適應力
        body_eml_forest = e.target.nextElementSibling.dataset.pointa;
        body_eml_mountain = e.target.nextElementSibling.dataset.pointb;
        body_eml_desert = e.target.nextElementSibling.dataset.pointc;
        // console.log(body_eml_forest + ',' + body_eml_mountain + ',' + body_eml_desert);

        // 以及生命力
        total_health = e.target.nextElementSibling.dataset.health;
        updatehealth();     //呼叫更新生命力的function


    }else if (type_name == 'foot'){
        document.getElementsByClassName('foot_pic')[0].src = `img/modify/p_foot_${animal_name}.png`;
        // 抓到選擇的腳部三種環境適應力
        foot_eml_forest = e.target.nextElementSibling.dataset.pointa;
        foot_eml_mountain = e.target.nextElementSibling.dataset.pointb;
        foot_eml_desert = e.target.nextElementSibling.dataset.pointc;
        // console.log(foot_eml_forest + ',' + foot_eml_mountain + ',' + foot_eml_desert);

        // 以及跳躍力
        total_jump = e.target.nextElementSibling.dataset.jump;
        updatejump();       //呼叫更新跳躍力的function


    }else if (type_name == 'tail'){
        document.getElementsByClassName('tail_pic')[0].src = `img/modify/p_tail_${animal_name}.png`;
    }

    total_eml_forest = parseInt(head_eml_forest) + parseInt(body_eml_forest) + parseInt(foot_eml_forest);
    total_eml_mountain = parseInt(head_eml_mountain) + parseInt(body_eml_mountain) + parseInt(foot_eml_mountain);
    total_eml_desert = parseInt(head_eml_desert) + parseInt(body_eml_desert) + parseInt(foot_eml_desert);
    updatechart();      //呼叫更新雷達圖的function
}

// 更新雷達圖資料
function updatechart(){
    myRadarChart.data.datasets[0].data = [total_eml_forest,total_eml_mountain,total_eml_desert];
    myRadarChart.update();
    // console.log(total_eml_forest + ',' + total_eml_mountain + ',' + total_eml_desert);
}

// 更新生命力
function updatehealth(){
    let health_box = document.querySelector(".life_ability .pic");
    // console.log(health_box);
    health_box.innerHTML = '';
    for (let i=1; i<=total_health; i++){
        let hart = document.createElement('img');
        hart.src = 'img/modify/icon_life.png';
        health_box.appendChild(hart);
    }
}

// 更新跳躍力
function updatejump(){
    let jump = document.getElementsByClassName('bar_add')[0];
    let jump_value = document.getElementsByClassName('meter')[0];
    jump.style.width = `${total_jump}0%`;
    jump_value.innerText = total_jump + 'm';
}


function rand(min,max){
    var x=0;
    x = Math.floor(Math.random()*(max-min+1)+min);
    return x;
}

function random_part(){
    // console.log('點了隨機');
    
    picon[5].click();

    let rand_head = 0 + rand(0,3);
    let rand_body = part_types + rand(0,3);
    let rand_foot = part_types*2 + rand(0,3);
    let rand_tail = part_types*3 + rand(0,3);
    
    // console.log('rand_head'+ rand_head);
    // console.log('rand_body'+ rand_body);
    // console.log('rand_foot'+ rand_foot);
    // console.log('rand_tail'+ rand_tail);

    picon[rand_head].click();
    picon[rand_body].click();
    picon[rand_foot].click();
    picon[rand_tail].click();
    
    
}

let partsobj;

function getpartlist(){
    
    //產生XMLHttpRequest物件
    var xhr = new XMLHttpRequest(); //readyState : 0

    //註冊callback function
    xhr.onload = function(){
        // console.log( xhr.readyState);
        if (xhr.status == 200){
            // console.log(xhr.responseText);
            partsobj = JSON.parse(xhr.responseText);
            console.log(partsobj);
            
        }else{
            alert(xhr.status);
        };


    };


    //設定好所要連結的程式
    var url = "php/getparts.php";
    xhr.open("Get", url, true);

    //送出資料
    xhr.send( null );

}





function init(){
    // 抓到選單的圖片，全部建立click聆聽功能
    for(let i=0; i<picon.length; i++){
        picon[i].addEventListener('click',changeParts);
    };

    // 抓到下一步按鈕，點了之後做html轉canvas的功能
    // document.getElementById("topic").addEventListener("click",dopic);

    // 隨機按鈕增聽按下去
    document.getElementsByClassName('btn_random')[0].addEventListener('click',random_part);

    // 抓部件資料庫訊息進HTML架構裡
    getpartlist();

}


window.addEventListener("load",init,false);