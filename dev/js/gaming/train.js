class Train {
    constructor(monsterSize=50){
        this.r = monsterSize;
        this.x = width;
        // this.y = height - this.r;
        this.y = height*0.8;
        // this.id = 'a'+ID;
    }   
    move() {
        this.x -= 1.2*scrollSpeed;
    }
    show(mWidth=this.r,mHeight=this.r) { 
        image(tImg, this.x, this.y, mWidth, mHeight);
        // rect( this.x, this.y, this.r, this.r);
    }  
}

class Fallen {
    constructor(){
        this.r = 80;
        this.y = -50;
        this.x = random(0.3*width, width+20);

    }
    move(){
        this.y += 9;
        this.x -= 10;
    }
    show(){
        image(fImg, this.x, this.y, this.r, this.r);
    }
}