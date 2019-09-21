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
    constructor(){
        this.r = 40;
        this.x = width;
        this.y = height*0.6;
    }
    move() {
        this.x -=scrollSpeed;
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