var btn=[];

function Question(question, choices, answer,solution) {
    this.question = question;
    this.choices = choices;
    this.answer = answer; 
    this.solution = solution;
    this.displayQuestion = function(){
        choicesBar.innerHTML = '';
        questionBar.innerText = this.question;
        for(var i=0;i<this.choices.length; i++){
            btn.push(document.createElement('p'));
            btn[i].innerText = this.choices[i];
            choicesBar.appendChild(btn[i]);
            btn[i].addEventListener('click',getUserChoice);
        } 
    }

    this.checkAnswer = function(uChoice){
        if(this.answer == uChoice){
            choicesBar.innerHTML = '';
            questionBar.innerText = '你答對了! 可以繼續玩!';
            questionPage.style.display="none";
            setTimeout(function(){
                life=3;
                n = Math.floor( Math.random()* questions.length);
                questions[n].displayQuestion();    
                loop();
            },100);
        }else{
            choicesBar.innerHTML = '';
           
            timer=0;
            solutionHead.innerHTML = `<p style="font-size:18px; font-weight:700">正確答案是<span style="color:red;font-size:24px;width:30px;"> ${this.answer+1}</span></p>`;
            solutionText.innerHTML = `<p>${this.solution}</p>`;
            calculation.style.display="block";
            message.style.display="block";
            questionPage.style.display="none";
            console.log(this.solution);

        }
    }
}

var q1 = new Question('請問龍蝦是用哪裡尿尿?',['1.臉','2.觸角','3.殼'] ,0, "龍蝦用臉尿尿" );
var q2 = new Question('請問藍鯨的屁可以包下一隻?',['1.貓','2.馬','3.大象'],1, "一隻馬");
var q3 = new Question('請問獅子是什麼動物?',['1.肉食','2.草食'],0, "肉食");
var q4 = new Question('請問獵豹的速度比什麼還要快?',['1.卡車','2.法拉利','3.飛機'],1, "獵豹比法拉利還要快:獵豹能在三秒之間從0加速至60英里每小時，比一輛法拉利Enzo還要快。");



var questions = [q1, q2, q3, q4];

var n = Math.floor( Math.random()* questions.length);

questions[n].displayQuestion();

function getUserChoice(e){    
    questions[n].checkAnswer(btn.indexOf(e.target));
}


