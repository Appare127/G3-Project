class Train {
    constructor(){
        this.r = 50;
        this.x = width;
        // this.y = height - this.r;
        this.y = height*0.8;
        // this.id = 'a'+ID;
    }   
    move() {
        this.x -= 1.2*scrollSpeed;
    }
    show() { 
        image(tImg, this.x, this.y, this.r, this.r);
        // rect( this.x, this.y, this.r, this.r);
    }  
}