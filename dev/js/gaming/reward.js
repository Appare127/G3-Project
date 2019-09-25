


class Food {
    constructor(){
        this.r = 40;
        this.x = width;
        // this.y = height - this.r;
        this.y = height*0.6;
    }  
    move() {
        this.x -= scrollSpeed;
    }
    show() {
        if(window.innerWidth<=767){
            image(rImg, this.x, this.y, this.r, this.r);
        }else{
            image(rImg, this.x, this.y, this.r, this.r);
        }
        // rect( this.x, this.y, this.r, this.r);
    } 
}

class Money {
    constructor(inX=width,inY=height*0.6){
        this.r = 40;
        this.x = inX;
        this.y = inY;
    }
    move(Vy=0) {
        this.x -=scrollSpeed;
        this.y += Vy;
    }
    show() {
        if(window.innerWidth<=767){
            image(rImg, this.x, this.y, this.r, this.r);
        }else{
            image(rImg, this.x, this.y, this.r, this.r);
        }
    }

}

class Wing {
    constructor(){
        this.r = 40;
        this.x = width;
        this.y = height*0.5;
    }
    move() {
        this.x -=scrollSpeed;
    }
    show() {
        image(wImg, this.x, this.y, this.r, this.r);
    }
}

class Stone {
    constructor(){
        this.r = 40;
        this.x = width;
        this.y = height*0.5;
    }
    move() {
        this.x -=scrollSpeed;
    }
    show() {
        image(sImg, this.x, this.y, this.r, this.r);
    }
}

class Angel {
    constructor(){
        this.r = 140;
        this.x = -200;
        this.y = 10;
        this.posX;
        this.posY;
        this.readyStatus = false;
        this.bornTime;
        this.displace;
        this.direction = 'right';
    }   

    move(Vx=scrollSpeed,Vy=0) {
            
        if(this.x <width && this.direction == 'right'){ 
            this.displace = 5;
        }
        if(this.x>=width ){
            this.displace = -5;
            this.direction = 'left';
        }
        if(this.x<=0){ 
            this.displace = 5;
            this.direction = 'right';
        }

        this.x += this.displace;


    }

    show() { 
        image(aImg, this.x, this.y, 120, 153.6);
        // rect( this.x, this.y, this.r, this.r);
    }  
}

class Book {
    constructor(posX, posY){
        this.r = 80;
        this.y = posY;
        this.x = posX;
        this.hitStatus = false;
    }
    move(){
        this.y += 9;
            // this.x -= 10;
        this.y = constrain(this.y, 0, height-168);
        this.x = constrain(this.x,this.r-100, width+this.r);
    }
    show(){
        image(bImg, this.x, this.y, 120, 168);
    }

    
}