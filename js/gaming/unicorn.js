class Unicorn {  
    constructor(){
        this.r = 100;
        this.x = 50;
        this.y = height-50;
        this.vy = 0;
        this.gravity = 2;
    }
    show() {
        image(uImg,this.x, this.y-50, this.r, this.r);
        // fill(255,50);
        // rect(this.x, this.y-50, this.r, this.r);
        // console.log(this.y);
    } 
    jump() {
        if(this.y==height - this.r){
            this.vy = -25;
        } 
        // this.vy = -25;
    }
    hits(train){ 
        // console.log(collideRectRect(this.x,this.y,this.r,this.r,train.x,train.y,train.r,train.r))
        
        return collideCircleCircle(this.x,this.y,this.r,train.x,train.y,train.r);
    }


    move() {
        this.y += this.vy;
        this.vy += this.gravity;
        this.y = constrain(this.y, 0, height - this.r);
        this.x = constrain(this.x,-this.r, width+this.r);
    }
}