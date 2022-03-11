//Quiz Session functionality
var quizJSON;
var quizInnerHtml = jQuery('[data-quiz-carousal-inner]');
const  quiz_question_blk = document.querySelector(".quiz_question_blk");
const quiz_option_blck = document.querySelector(".quiz_option_blck");
const quiz_answer_blk = document.querySelector(".quiz_answer_blk");
const result_blk = document.querySelector(".result_blk");
const total_time_taken = document.querySelector(".total-time-taken");
const login_error_blck = document.querySelector(".login-error");
var questionstrip = document.querySelector(".active-questions-strip");
var sessiontimer = jQuery('[session-timer-block]');
var resultsection = jQuery('[result-section]');
var sharesection = jQuery('[social-share-section]');
var morequiz = jQuery('[more-quiz]');
var logoutbtn = jQuery('[log-out-button]')
var i,t,n;
var total;
const next_btn = document.querySelector(".next-btn");
let quiz_start;
let que_count = 0;
let que_numb = 1;
let userScore = 0;
var QUIZ_Session;
var quiz_form_data = jQuery('[quiz-form-data]');
const quiz_user = document.querySelector(".user_name");
var baseUrl = window.location.origin;
var quizname = jQuery('.quiz-title').text();

//Quiz session load function
QUIZ_Session = { quiz_session : function() {
    jQuery();
    jQuery.getJSON(
    'https://cdn1.byjus.com/byjusweb/json/quiz/India_Quiz_Questions_ Media_Infinity_the_Maths_Quiz.json',
    function(response,index) {
            quizJSON = response; 

            //SHOW QUESTIONS AND OPTIONS
                var QUIZ_MAINFunction ={ 
                    showQuiz:  function (index){

                    //creating a new span and div tag for question and option and passing the value using array index
                    let que_tag = '<span>'+ quizJSON[index].questionNumber + ". " + quizJSON[index].questionPartOne +'</span>';
                    let option_tag = '<div class="quiz-option" id="qans" data-quiz-option='+quizJSON[index].options0+'><span class="option-sequence">A</span><span class="option">'+ quizJSON[index].options0 +'</span><br><div class="ans-align"><div class="answer-blk hidden">'+ quizJSON[index].correctAnswerResponse +'</div></div></div>'
                                    +'<div class="quiz-option" id="qans" data-quiz-option='+quizJSON[index].options1+'><span class="option-sequence">B</span><span class="option">'+ quizJSON[index].options1 +'</span><br><div class="ans-align"><div class="answer-blk hidden">'+ quizJSON[index].correctAnswerResponse +'</div></div></div>'
                                    +'<div class="quiz-option" id="qans" data-quiz-option='+quizJSON[index].options2+'><span class="option-sequence">C </span><span class="option">'+ quizJSON[index].options2 +'</span><br><div class="ans-align"><div class="answer-blk hidden">'+ quizJSON[index].correctAnswerResponse +'</div></div></div>'
                                    +'<div class="quiz-option" id="qans" data-quiz-option='+quizJSON[index].options3+'><span class="option-sequence">D</span><span class="option">'+ quizJSON[index].options3 +'</span><br><div class="ans-align"><div class="answer-blk hidden">'+ quizJSON[index].correctAnswerResponse +'</div></div></div>';

                    quiz_question_blk.innerHTML = que_tag;                                  //adding new span tag inside que_tag
                    quiz_option_blck.innerHTML = option_tag;                                //adding new div tag inside option_tag
                    const option = quiz_option_blck.querySelectorAll(".quiz-option");
                    const optionlist = quiz_option_blck.querySelectorAll(".option");
                    const reason = quiz_option_blck.querySelectorAll(".answer-blk"); 

                    // show all question strips in every question
                    let question_strip = '<span class="strip-number first-strip active">1</span>'+
                                        '<span class="strip-number">2</span>'+
                                        '<span class="strip-number">3</span>'+
                                        '<span class="strip-number">4</span>'+
                                        '<span class="strip-number">5</span>'+
                                        '<span class="strip-number strip-responsive">6</span>'+
                                        '<span class="strip-number strip-responsive">7</span>'+
                                        '<span class="strip-number strip-responsive">8</span>'+
                                        '<span class="strip-number strip-responsive">9</span>'+
                                        '<span class="strip-number last-strip strip-responsive">10</span>';
                    questionstrip.innerHTML = question_strip;      

                    // WHEN USER SELECT A OPTION
                    jQuery( ".quiz-option" ).click(function(){
                        let ansOptions = jQuery(this).find('.option');  
                        let userAns = ansOptions.text();             
                        let correctAns = quizJSON[index].answer;
                        if(userAns == correctAns)
                        { 
                            userScore += 1;                                             //If user give the correct answer update score by 1
                            jQuery(this).addClass('correct');
                            for (i = option.length >>> 0; i--;) {                       //for(i=option.length; i>=0; i--)
                                if(optionlist[i].textContent == correctAns)
                                {   
                                    reason[i].removeAttribute("class","hidden");
                                    reason[i].setAttribute("class",".answer-blk")
                                }
                            }
                        }
                        else
                        {
                            jQuery(this).addClass('incorrect');                     //add background color red
                            for (i = option.length >>> 0; i--;) { 
                                if(optionlist[i].textContent == correctAns)
                                {   
                                    option[i].setAttribute("class", "correct quiz-option");             //make the correct option's background grren
                                    reason[i].removeAttribute("class","hidden");
                                    reason[i].setAttribute("class",".answer-blk");   
                                }
                            }
                        }      
                        jQuery("#qans*").attr("disabled","disabled").off('click');                  //disable other option when once clicked
                        jQuery("#qans*").addClass("pointer-change");
                    });
                }};

                // quiz selection block
                var quiz_name = jQuery('.quiz-title').text();
                var quiz_end_at = jQuery('.quiz-end-at').text();
                var quiz_start_at = jQuery('.quiz-start-at').text();           
                if(quiz_name){
                    que_count = quiz_start_at;
                    que_end = quiz_end_at;
                    que_numb = 1;
                    QUIZ_MAINFunction.showQuiz(que_count);        //BY DEFAULT SHOW THE 1ST QUESTION 
                    que_count++;
                }else{
                    console.log("wrong");
                }

                //Result Page
                function showresult()
                {
                    var full_name = jQuery('[name = name]');
                    var quizusername = full_name.val();
                    var username = quizusername.split(" ")[0];                      //trim the first name from full name
                    quizInnerHtml.addClass("hidden");
                    questionstrip.setAttribute("class","hidden");
                    sessiontimer.addClass("hidden");
                    resultsection.removeClass("hidden");
                    sharesection.removeClass("hidden");
                    morequiz.removeClass("hidden");
                    logoutbtn.removeClass("hidden");
                    let result_page_user_name = '<span class="user-name">'+ username +'</span>';        //append user name in the result page
                    quiz_user.innerHTML = result_page_user_name;
                    let result_page = '<span class="result-page">'+ userScore +'</span>';             //append user score in the result page
                    result_blk.innerHTML = result_page;
                    jQuery('html, body').animate({
                        scrollTop: jQuery('.result-carousel').offset().top
                    }, 'slow');
                    document.getElementById("morequizbtn").onclick = function () {                 //open the quiz corner category page
                        var quiz_Corner_url = baseUrl + "/quiz-corner";
                        location.href = quiz_Corner_url;
                    };
                    jQuery('#logoutbtn').click(function() {
                        location.reload();
                    });
                }

            //WHEN USER CLICK ON THE NEXT BUTTON
            next_btn.onclick = ()=>{
                var j=1;
                ++que_numb;                                              //increment the que_numb value
                if(que_count <= que_end)                                //if question count is less than total question length 
                {
                    QUIZ_MAINFunction.showQuiz(que_count);
                    que_count++;                                            //increment the que_count value

                    jQuery('html, body').animate({
                        scrollTop: jQuery('.quiz-session-item').offset().top
                    }, 'slow');
                    const striplist = questionstrip.querySelectorAll(".strip-number");
                    for(j=0; j<10; j++)
                    {
                        if(striplist[j].textContent == que_numb)
                        {
                            striplist[j].setAttribute("class","active strip-number");               //make current strip's background color blue
                        }
                        if(striplist[j].textContent != que_numb)
                        {
                            striplist[j].removeAttribute("class","active");
                        }
                    }
                }
                else if(que_numb > 10)                       //If question number reach at 11
                {
                    showresult();                           //Show result of 10 questions
                }
            }

            //TIMER START AUTOMATICALLY WHEN THE PAGE LOAD
            function getTimeRemaining(endtime) {
                total = Date.parse(endtime) - Date.parse(new Date());
                const seconds = Math.floor((total / 1000) % 60);
                const minutes = Math.floor((total / 1000 / 60) % 60);
                return {
                total,
                minutes,
                seconds
                };
            }
            function initializeClock(id, endtime) {
                const clock = document.getElementById(id);
                const minutesSpan = clock.querySelector('.minutes');
                const secondsSpan = clock.querySelector('.seconds');
                function updateClock() 
                {
                    t = getTimeRemaining(endtime);
                    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);            //append in html body
                    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                    if (t.total <= 0  || que_numb>10)                           //if time expire or user complete the quiz before the given time limit
                    {
                    const usetime = (60000*3)-(t.total);
                    const useseconds = ('0'+ Math.floor((usetime / 1000) % 60));
                    const useminutes = ('0'+ Math.floor((usetime / 1000 / 60) % 60));
                    clearInterval(timeinterval);
                    let time_page = 'in <span class="minutes_taken">'+ useminutes.slice(-2) +'</span>:<span class="seconds_taken">'+useseconds.slice(-2)+'</span> Minutes';
                    total_time_taken.innerHTML = time_page;
                    showresult();

                    //result_details saved in db
                    jQuery(document).ready(function(){
                        var quiz_useremail = jQuery('[name = email]').val();
                        var user_final_score = userScore;
                        var time_symbol =":";
                        var user_time_taken = useminutes.slice(-2)+ time_symbol+useseconds.slice(-2) ;
                        jQuery.ajax({
                            type: "POST",
                            url: baseUrl + "/wp-json/spidy/v1/add_quiz_result_data/?wp-json_allow",
                            data: {
                                email: quiz_useremail,
                                quizname: quizname,
                                quizscore: user_final_score,
                                timetaken: user_time_taken
                            },
                            success: function(response){
                                if(response.success){
                                    // console.log("result data saved");
                                }
                                else{
                                    // console.log("result data not saved"); 
                                }
                            }               
                        }); 
                    });

                    }
                }
                updateClock();
                const timeinterval = setInterval(updateClock, 1000);                        //update per second
            }
            const deadline = new Date(Date.parse(new Date()) + 3* 60 * 1000);               //settimg the time limit 3 minutes
            initializeClock('clockdiv', deadline);  

        });
    }
};

// Quiz Form Login functionality Part
const invalid_name = document.querySelector(".invalid_name");
const invalid_email = document.querySelector(".invalid_email");

var customValidation = {
    nameValidation: function (ele, form_id, error_msg_key, isOptional, errorMessage) {
        var sel = jQuery(ele);
        var sel_value = sel.val().trim();
        var keyName = error_msg_key ? error_msg_key : 'Name';
        var msg = '';
        var reg_exp = /^[a-zA-Z][a-zA-Z\-\ \.]{2,}$/i;
        sel.siblings('.input-error-msg').remove();
        if (!sel_value || sel_value === null) {
            msg = '*'+keyName + ' is required.';
        } else if (sel_value.length <= 2) {
            msg = '*Name should be minimum 3 characters.';
        } else if (!sel_value.match(reg_exp)) {
            msg = errorMessage ? errorMessage : '*Accepts alphabets only.';
        } else {
            msg = '';
        }
        jQuery('.invalid_name').addClass("hidden");
        if (msg) {
            jQuery('.invalid_name').removeClass("hidden");
            sel.addClass('input-error').removeClass('input-valid');
            let name_error = '<span class="input-error-msg">' + msg + '</span>';
            invalid_name.innerHTML = name_error;
            return false;
        } else {
            sel.removeClass('input-error');
            sel.addClass('input-valid');
            return true;
        }
    },
    emailValidation: function (ele, form_id, error_msg, isOptional, errorMessage) {
        var sel = jQuery(ele);
        var sel_value = sel.val();
        var msg = '';
        var reg_exp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,13}))$/;
        sel.siblings('.input-error-msg').remove();
        if (!isOptional && (!sel_value || sel_value === null)) {
            msg = '*Email-id is required.';
        } else if (sel_value && sel_value !== null && !sel_value.match(reg_exp)) {
            msg = errorMessage ? errorMessage : '*Email-id is not valid.';
        }
        jQuery('.invalid_email').addClass("hidden");
        if (msg) {
            jQuery('.invalid_email').removeClass("hidden");
            sel.addClass('input-error').removeClass('input-valid');
            let email_error = '<span class="input-error-msg">' + msg + '</span>';
            invalid_email.innerHTML = email_error;
            return false;
        } else {
            sel.removeClass('input-error');
            !isOptional && sel.addClass('input-valid');
            return true;
        }
    }
} 

//Submit button
jQuery(document).ready(function(){
    jQuery('[data-submit-btn]').click(function(e) {
        e.preventDefault();
        var validationFlag = validatorInputFields();
        var quiz_username = jQuery('[name = name]').val();
        var quiz_useremail = jQuery('[name = email]').val();

        if(validationFlag == true) {
            jQuery.ajax({
                type: "POST",
                url: baseUrl + "/wp-json/spidy/v1/add_quiz_login_data/?wp-json_allow",
                data: {
                    name: quiz_username,
                    email: quiz_useremail,
                    quizname: quizname
                },
                success: function(response){
                    if(response.success){
                        QUIZ_Session.quiz_session();                    //call quiz_session function to enable timer, load json and other sub-function
                        jQuery('.quiz-login').addClass("hidden");
                        jQuery('.quiz-item').removeClass("hidden");
                    }
                    else{
                        let loginerror ='<p class="login-error-mssg">You already attempted this quiz. Please try other quizes.</p>';
                        login_error_blck.innerHTML = loginerror;
                    }
                }
            });
        }
    })
});
function validatorInputFields() {
    var valiatorInput = false;
    valiatorInput     = customValidation.nameValidation(jQuery('[name="name"]')) &&
                        customValidation.emailValidation(jQuery('[name="email"]'));                
    if(!valiatorInput) {
        customValidation.nameValidation(jQuery('[name="name"]'));
        customValidation.emailValidation(jQuery('[name="email"]'));
    } 
    return valiatorInput;
}; 