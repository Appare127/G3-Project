
let parts_icon = document.getElementsByClassName("parts_icon");
let picon ;


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

let leg_eml_forest = 0;
let leg_eml_desert = 0;
let leg_eml_mountain = 0;

// 用ajax從php抓回來的jason物件
let partsobj = [];

// 設有幾種部件，後面的隨機會用到
// let part_types = picon.length / 4;
let part_types = 4;


let canvas = document.getElementById('pic_box');
let context = canvas.getContext('2d');
    canvas.width = "400";
    canvas.height = "400";


// 下一步動作
function dopic(){
    
    // 先判斷sessionStorage有沒有會員登入資料，有才往下做轉圖檔工作
    if (sessionStorage['user_name']){

        let animal_name = document.getElementById('animal_name');
        
        if (animal_name.value != ''){
            // 動物名稱裡不是空的，代表已經有輸入名字了，可繼續做下去
            
            canvas = document.getElementById('pic_box');
            let url = canvas.toDataURL("image/png");
            // document.getElementById('testimg').src = url;
            document.getElementById('url_data').value = url;
            // console.log(document.getElementById('url_data').value);
            
            picsend();

            // 如果沒有輸入動物名字，則彈出提示視窗
        }else {
            document.getElementsByClassName('need_name')[0].classList.add('show');
        }
    // 如果sessionStorage沒有登入，則彈出提示登入的視窗
    }else{
        document.getElementsByClassName('remind_login')[0].classList.add('show');
    };

}


function drawcanvas(){

    context.clearRect(0,0,canvas.width,canvas.height);

    let pic_width = canvas.width;
    let pic_height = canvas.height;

    let img1 = new Image();
    let img2 = new Image();
    let img3 = new Image();
    let img4 = new Image();

    img1.src = document.getElementsByClassName('head_pic')[0].src;
    img2.src = document.getElementsByClassName('body_pic')[0].src;
    img3.src = document.getElementsByClassName('leg_pic')[0].src;
    img4.src = document.getElementsByClassName('tail_pic')[0].src;

    img1.onload = function(){
        context.drawImage(img4,0,0,pic_width,pic_height);
        context.drawImage(img3,0,0,pic_width,pic_height);
        context.drawImage(img2,0,0,pic_width,pic_height);
        context.drawImage(img1,0,0,pic_width,pic_height);
    };
    img2.onload = function(){
        context.drawImage(img4,0,0,pic_width,pic_height);
        context.drawImage(img3,0,0,pic_width,pic_height);
        context.drawImage(img2,0,0,pic_width,pic_height);
        context.drawImage(img1,0,0,pic_width,pic_height);
    };
    img3.onload = function(){
        context.drawImage(img4,0,0,pic_width,pic_height);
        context.drawImage(img3,0,0,pic_width,pic_height);
        context.drawImage(img2,0,0,pic_width,pic_height);
        context.drawImage(img1,0,0,pic_width,pic_height);
    };
    img4.onload = function(){
        context.drawImage(img4,0,0,pic_width,pic_height);
        context.drawImage(img3,0,0,pic_width,pic_height);
        context.drawImage(img2,0,0,pic_width,pic_height);
        context.drawImage(img1,0,0,pic_width,pic_height);
    };
}


// 發送圖片資料到後台做圖片儲存動作
function picsend(){

    document.getElementById('myanimal_name').value = document.getElementById('animal_name').value;
    document.getElementById('user_no').value = sessionStorage['user_no'];
    
    document.getElementById('environ_adapt_1').value = total_eml_forest;
    document.getElementById('environ_adapt_2').value = total_eml_mountain;
    document.getElementById('environ_adapt_3').value = total_eml_desert;
    document.getElementById('animal_life').value = total_health;
    document.getElementById('animal_jump').value = total_jump;


    let formData = new FormData(document.getElementById("form1"));
    let xhr = new XMLHttpRequest();
    xhr.onload = function(){
        if( xhr.status == 200){
            if(xhr.responseText == "error"){
            alert("Error");
            }else{
            console.log(xhr.responseText);
            saveok(xhr.responseText);
            }
        }else{
            alert(xhr.status)
        }
    }
    xhr.open('POST', 'php/modify/saveimg.php', true);
    xhr.send(formData);
}


function saveok(text)){
    alert('動物儲存成功');
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


    }else if (type_name == 'leg'){
        document.getElementsByClassName('leg_pic')[0].src = `img/modify/p_leg_${animal_name}.png`;
        // 抓到選擇的腳部三種環境適應力
        leg_eml_forest = e.target.nextElementSibling.dataset.pointa;
        leg_eml_mountain = e.target.nextElementSibling.dataset.pointb;
        leg_eml_desert = e.target.nextElementSibling.dataset.pointc;
        // console.log(leg_eml_forest + ',' + leg_eml_mountain + ',' + leg_eml_desert);

        // 以及跳躍力
        total_jump = e.target.nextElementSibling.dataset.jump;
        updatejump();       //呼叫更新跳躍力的function


    }else if (type_name == 'tail'){
        document.getElementsByClassName('tail_pic')[0].src = `img/modify/p_tail_${animal_name}.png`;
    }

    // 算適應力的總和
    total_eml_forest = parseInt(head_eml_forest) + parseInt(body_eml_forest) + parseInt(leg_eml_forest);
    total_eml_mountain = parseInt(head_eml_mountain) + parseInt(body_eml_mountain) + parseInt(leg_eml_mountain);
    total_eml_desert = parseInt(head_eml_desert) + parseInt(body_eml_desert) + parseInt(leg_eml_desert);
    updatechart();      //呼叫更新雷達圖的function

    drawcanvas();
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

// 隨機的函式
function rand(min,max){
    var x=0;
    x = Math.floor(Math.random()*(max-min+1)+min);
    return x;
}

// 隨機選擇圖片的函式
function random_part(){

    for (let i=1; i<=6; i++){
        setTimeout(function(){
            // 頭部為picon[0] ~ picon[3]的位址
            let rand_head = 0 + rand(0,3);
            // 身體為頭部加4再隨機0~3的位址
            let rand_body = part_types + rand(0,3);
            let rand_leg = part_types*2 + rand(0,3);
            let rand_tail = part_types*3 + rand(0,3);
            
            // console.log('rand_head'+ rand_head);
            // console.log('rand_body'+ rand_body);
            // console.log('rand_leg'+ rand_leg);
            // console.log('rand_tail'+ rand_tail);
        
            // 四個圖片物件拿到隨機的位址後，各別做click動作
            // 因為改用canvas作畫，同時點太多次click觸發時，canvas會來不及清掉上一次的
            // 會造成舊的圖殘留在上面，所以才把每次click後要延遲50ms再點下一個click
            setTimeout(function(){
                picon[rand_head].click();
                setTimeout(function(){
                    picon[rand_body].click();
                    setTimeout(function(){
                        picon[rand_leg].click();
                        setTimeout(function(){
                            picon[rand_tail].click();
                        },50);
                    },50)
                },50);
            },50);

        }, i*i*35);
    }


}


// 透過Ajax從PHP抓到資料庫的部件資料
function getpartlist(){
    
    //產生XMLHttpRequest物件
    var xhr = new XMLHttpRequest(); //readyState : 0

    //註冊callback function
    xhr.onload = function(){
        // console.log( xhr.readyState);
        if (xhr.status == 200){
            // console.log(xhr.responseText);
            partsobj = JSON.parse(xhr.responseText);
            // console.log(partsobj);
            // 抓到jason物件資料後，直接丟進建立html的函式裡
            buildlist(partsobj);
            
        }else{
            alert(xhr.status);
        };
    };

    //設定好所要連結的程式
    var url = "php/modify/getparts.php";
    xhr.open("Get", url, true);

    //送出資料
    xhr.send( null );
}

// 拿到jason資料後建立HTML架構
function buildlist (jsonobj){

    let head_arr = jsonobj.head;
    let body_arr = jsonobj.body;
    let leg_arr = jsonobj.leg;
    let tail_arr = jsonobj.tail;
    // console.log(body_arr);

    let head_ul = document.querySelector('.part_button.head_button .part_wrap');
    let body_ul = document.querySelector('.part_button.body_button .part_wrap');
    let leg_ul = document.querySelector('.part_button.leg_button .part_wrap');
    let tail_ul = document.querySelector('.part_button.tail_button .part_wrap');
    // console.log(body_ul);


    // 建立尾巴HTML架構
    for (let i=0; i<tail_arr.length; i++){
        let li = document.createElement('li');
        let img = document.createElement('img');
        let p = document.createElement('p');
        img.src = tail_arr[i].tail_img;
        img.classList = 'picon';
        img.alt = '資料庫圖片遺失';
        p.innerHTML = tail_arr[i].tail_chname;

        li.appendChild(img);
        li.appendChild(p);
        tail_ul.appendChild(li);
    }

    //建立頭部HTML架構 
    for (let i=0; i<head_arr.length; i++){
        let li = document.createElement('li');
        let img = document.createElement('img');
        let input = document.createElement('input');
        let p = document.createElement('p');
        img.src = head_arr[i].head_img;
        img.classList = 'picon';
        img.alt = '資料庫圖片遺失';
        input.dataset.pointa = head_arr[i].head_environment1;
        input.dataset.pointb = head_arr[i].head_environment2;
        input.dataset.pointc = head_arr[i].head_environment3;
        input.style.display = 'none';
        p.innerHTML = head_arr[i].head_chname;

        li.appendChild(img);
        li.appendChild(input);
        li.appendChild(p);
        head_ul.appendChild(li);
    }

    //建立身體HTML架構 
    for (let i=0; i<body_arr.length; i++){
        let li = document.createElement('li');
        let img = document.createElement('img');
        let input = document.createElement('input');
        let p = document.createElement('p');
        img.src = body_arr[i].body_img;
        img.classList = 'picon';
        img.alt = '資料庫圖片遺失';
        input.dataset.pointa = body_arr[i].body_environment1;
        input.dataset.pointb = body_arr[i].body_environment2;
        input.dataset.pointc = body_arr[i].body_environment3;
        input.dataset.health = body_arr[i].body_health;
        input.style.display = 'none';
        p.innerHTML = body_arr[i].body_chname;

        li.appendChild(img);
        li.appendChild(input);
        li.appendChild(p);
        body_ul.appendChild(li);
    }

    //建立腳部HTML架構 
    for (let i=0; i<leg_arr.length; i++){
        let li = document.createElement('li');
        let img = document.createElement('img');
        let input = document.createElement('input');
        let p = document.createElement('p');
        img.src = leg_arr[i].leg_img;
        img.classList = 'picon';
        img.alt = '資料庫圖片遺失';
        input.dataset.pointa = leg_arr[i].leg_environment1;
        input.dataset.pointb = leg_arr[i].leg_environment2;
        input.dataset.pointc = leg_arr[i].leg_environment3;
        input.dataset.jump = leg_arr[i].leg_jump;
        input.style.display = 'none';
        p.innerHTML = leg_arr[i].leg_chname;

        li.appendChild(img);
        li.appendChild(input);
        li.appendChild(p);
        leg_ul.appendChild(li);
    }

    // 抓到選單的圖片，全部建立click聆聽功能
    picon = document.getElementsByClassName('picon');
    for(let i=0; i<picon.length; i++){
        picon[i].addEventListener('click',changeParts);
    };

};

// 點X後，關閉彈跳提示視窗的函式
function remove_show (e){
    // console.log(e.target);
    let obj = e.target.parentNode;
    console.log(obj);
    obj.classList.remove('show');
}

// 開啟登入視窗
function openlogin(){
    document.getElementById('login_gary').classList.add('login_show');
    document.getElementsByClassName('remind_login')[0].classList.remove('show');
}



function init(){

    // 呼叫透過Ajax從PHP抓到資料庫的部件資料
    // getpartlist();


    // 抓到下一步按鈕，點了之後做html轉canvas的功能
    // document.getElementById("topic").addEventListener("click",dopic);


    // 隨機按鈕增聽按下去
    // document.getElementsByClassName('btn_random')[0].addEventListener('click',random_part);

    // 抓部件資料庫訊息進HTML架構裡
    
    document.getElementsByClassName('close_remind')[0].addEventListener('click',remove_show);
    document.getElementsByClassName('close_remind')[1].addEventListener('click',remove_show);

    picon = document.getElementsByClassName('picon');

    for(let i=0; i<picon.length; i++){
        picon[i].addEventListener('click',changeParts);
    }

    drawcanvas();

}


window.addEventListener("load",init,false);