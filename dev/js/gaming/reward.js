


class Food {
    constructor(){
        this.r = 30;
        this.x = width;
        // this.y = height - this.r;
        this.y = height*0.6;
    }  
    move() {
        this.x -= scrollSpeed;
    }
    show() {
        
        image(rImg, this.x, this.y, this.r, this.r);
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
        image(mImg, this.x, this.y, this.r, this.r);
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
        this.step1Over = false;
        this.step2Over = false;
        this.readyStatus = false;
    }   

    move(Vx=scrollSpeed,Vy=0) {
            
        if(this.x <= 0.5*width -10 &&this.step1Over == false ){ //step1
            this.x += 10; 
        }
        if(this.x == 0.5*width && this.y <60){ //step2
            this.step1Over = true;
            this.y +=5;
            console.log(this.x, this.y);
            this.posX = this.x;
            this.posY = this.y;
        }else if (this.y == 60){
            this.readyStatus =true;
        }
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
            this.x -= 10;
    }
    show(){
        image(fImg, this.x, this.y, this.r, this.r);
    }
}