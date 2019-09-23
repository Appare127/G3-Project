

class Unicorn {  
    constructor(life,weight=2){
        this.r = 150;
        this.x = 50;
        this.y = height-this.r;
        this.vy = 10;
        this.life=life;
        this.gravity = weight;
       
    }
    show() {

        if(window.innerWidth<=768){
            image(uImg,this.x, this.y, this.r, this.r);
        }else {
            image(uImg,this.x, this.y-20, this.r, this.r);
        }

    } 
    jump(jumpForce=(-25)) {
        if(flyStatus == true){
            this.vy = jumpForce;
        }else if(flyStatus ==false){
            if(strongStatus ==false && this.y==height - this.r){
                this.vy = jumpForce;
            }
        } 
        if(strongStatus ==true && this.y==height - 350){
            this.vy = jumpForce;
        }
    }
    hits(train){ 
        if(strongStatus==true && immuneStatus ==false){
            return collideCircleCircle(this.x,this.y,600,train.x,train.y,train.r);
        }else if(strongStatus == false && immuneStatus == false){
            return collideCircleCircle(this.x,this.y,this.r-20,train.x,train.y,train.r);
        }else if(immuneStatus==true){
            return false;
        }
    }


    move() {
        this.y += this.vy; //彈跳力
        this.vy += this.gravity;
        if(strongStatus==true){
            this.y = constrain(this.y, 0, height-350);  
            this.x = constrain(this.x,this.r-350, width+350);

        }else {
            this.y = constrain(this.y, 0, height - this.r);
            this.x = constrain(this.x,this.r, width+this.r);

        }
    }
}