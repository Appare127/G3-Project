class Unicorn {  
    constructor(life,weight=2){
        this.r = 100;
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
            image(uImg,this.x, this.y, this.r, this.r);
        }

    } 
    jump(jumpForce=(-25)) {
        if(this.y==height - this.r){
            this.vy = jumpForce;
        } 
    }
    hits(train){ 
        
        return collideCircleCircle(this.x,this.y,this.r,train.x,train.y,train.r);
    }


    move() {
        this.y += this.vy; //彈跳力
        this.vy += this.gravity;
        this.y = constrain(this.y, 0, height - this.r);
        this.x = constrain(this.x,this.r, width+this.r);
    }
}