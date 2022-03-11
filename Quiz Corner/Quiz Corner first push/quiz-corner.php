
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    global $_POST;
    $quiz_name = $post->post_title;
    $quiz_slug = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $quiz_corner = "/quiz-corner";
    $quizcorner_base_url =  $_SERVER['SERVER_NAME'] . $quiz_corner;
    $banner_details = $wpdb->get_row("SELECT w.`image` FROM wp_quiz_details w WHERE w.`status`=1 AND `quiz_name`='$quiz_name'");
    $result_card_image = $wpdb->get_row("SELECT w.`result_image` FROM wp_quiz_details w WHERE w.`status`=1 AND `quiz_name`='$quiz_name'");
    $question_start = $wpdb->get_row("SELECT w.`start_at` FROM wp_quiz_details w WHERE w.`status`=1 AND `quiz_name`='$quiz_name'");
    $question_end = $wpdb->get_row("SELECT w.`end_at` FROM wp_quiz_details w WHERE w.`status`=1 AND `quiz_name`='$quiz_name'");
    $slug_text = "Play Byju's ".$quiz_name;
    $fb_share_slug = "https://www.facebook.com/sharer/sharer.php?u=".$quiz_slug;
    $whatsapp_share_slug = "https://api.whatsapp.com/send?text=". $quiz_slug;
    $telegram_share_slug = "https://t.me/share/url?url=".rawurlencode($quiz_slug)."&text=".rawurlencode($slug_text);
    ?>
    <title><?php the_title(); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link href="https://cdn1.byjus.com/byjusweb/css/custom-bootstrap.css" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" type="text/css" href="/wp-content/themes/html5blank-stable/css/blog.css"> -->
    <link rel="stylesheet" type="text/css" href="/wp-content/themes/html5blank-stable/css/quiz-header.css">
    <link rel="stylesheet" type="text/css" href="/wp-content/themes/html5blank-stable/css/quiz-footer.css">
    <link rel="stylesheet" type="text/css" href="/wp-content/themes/html5blank-stable/css/quiz-login.css">
    <link rel="stylesheet" type="text/css" href="/wp-content/themes/html5blank-stable/css/quiz-session.css">
    <link rel="icon" href="https://cdn1.byjus.com/blog/2018/03/15174826/favicon.png" sizes="192x192"/>
</head> 

<!------------------ Text content of below element use to fetch questions of quiz in js ---------------->
<p class= "quiz-title hidden"><?= $quiz_name->post_title ?></p>
<p class= "quiz-start-at hidden"><?=$question_start->start_at?></p>
<p class= "quiz-end-at hidden"><?=$question_end->end_at?></p>

<body>
    <?php if(have_posts()) : while(have_posts()) : the_post(); { ?>

        <!-- ------------------Quiz Header Section----------------- -->
        <nav class="navbar navbar-expand-md">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">
                        <img src="https://cdn1.byjus.com/blog/quiz_corner/Bj_Purple_Logo.svg" alt="byjus.com" width="198" height="55">
                    </a>
                </div>
                <ul class="nav navbar-nav navbar-right bj-nav-menu hidden">
                    <button type="button" class="menu-close" title="close"><span></span>
                    </button>
                    <li class="nav-item">
                        <a class="nav-link" data-redirection="true" href="home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-redirection="true" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-redirection="true" href="learn.html">Learn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-redirection="true" href="participate.html">Participate</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- --------------------Quiz Banner Section--------------------- -->
        <section class="quiz-section quiz-login-banner">
            <div class="quiz-banner-block-wo-container">
                <div class="container">
                    <div class="login-banner-blk">
                        <?php if(null !== $banner_details->image && $banner_details->image != ""){ ?>
                        <img src="<?=$banner_details->image?>" alt="" class="india-banner">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- --------------------Quiz Form Section--------------------- -->
        <div class="quiz-login">
            <section class="quiz-login-section quiz-login-form quiz-form-section">
                <div class="quiz-login-form-blk">
                    <form class="quiz-login-form quiz-form-area" quiz-form-data>
                        <div class="row mb-3 name-field-blk">
                            <div class="col-sm-2 name-field-label">
                                <label id="name" class="input-label user-name">Name</label>
                            </div>
                            <div class="col-sm-10 name-field">
                                <div class="input-text">
                                    <input name="name" type="text" class="form-control name-input" id="name-input" placeholder="" data-error="Enter Your Name Correctly"
                                    onchange="customValidation.nameValidation(this)"
                                    onblur="customValidation.nameValidation(this)">
                                </div>
                                <div class="invalid_name"></div>
                            </div>
                        </div>
                        <div class="row mb-3 email-field-blk">
                            <div class="col-sm-2 email-field-label">
                                <label id="email" class="input-label user-email">Email Id</label>
                            </div>
                            <div class="col-sm-10 email-field">
                                <div class="input-text">
                                    <input name="email" type="email" class="form-control email-input" id="email-input" placeholder="" data-error="Enter A Valid Email Address"
                                        onchange="customValidation.emailValidation(this)"
                                        onblur="customValidation.emailValidation(this)">
                                </div>
                                <div class="invalid_email"></div>
                            </div>
                        </div>
                        <div class="row submit-btn-fg">
                            <div class="col-sm-10 submit-button-area">
                                <button type="submit" id="submit" class="btn submit-button" data-submit-btn>Submit</button>
                            </div>
                            <div class="col-sm-12 login-error"></div>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <!-- -------------------Quiz Play section------------------------ -->
        <div class="quiz-item hidden">

            <!-- Quiz Timer Section -->
            <section class="quiz-login-section quiz-session-item session-section">
                <div class="container">
                    <div class="session-timer-block" session-timer-block>
                        <div class="timer-counter-blk">
                            <div class="clock-circle">
                                <img src="https://cdn1.byjus.com/blog/quiz_corner/Timer_Logo.png" alt="timer-logo" class="timer-logo">
                            </div>
                            <div id="clockdiv">
                                <span class="timer-txt">Timer : &nbsp;</span>
                                <span class="minutes conter-counter-txt"></span>
                                <span>:</span>
                                <span class="seconds conter-counter-txt"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Quiz Question strip  Section -->
            <section class="quiz-login-section session-section active-questions-strip-section">
                <div class="container quizstrip-container">
                    <div class="active-questions-strip" active-questions-strip>
                        <!-- Question strip from javascript-->
                    </div>
                </div>
            </section>

            <!--Quiz Session Section-->
            <section class="quiz-login-section quiz-login-form quiz-session-section">
                <div class="container">
                    <div class="quiz-session-form-blk">
                        <div class="quiz-session-form">
                            <div id="india-quiz-carousel" class="carousel slide" data-interval="false">
                                <div class="carousel-inner question-carousel" data-quiz-carousal-inner>
                                    <div class="quiz-boxx">
                                        <div class="quiz_question_blk">
                                            <!--question from JavaScript -->
                                        </div>
                                        <div class="quiz_option_blck" quiz-option-disable>
                                            <!--options from JavaScript -->
                                        </div>
                                        <a class="next-btn btn">Next</a>
                                    </div>
                                </div>
                                <div class="carousel-inner result-carousel">
                                    <!-- <div class="col-sm-12 log-out hidden" log-out-button>
                                        <button id="logoutbtn" class="log-out-btn btn" >Log out</button>
                                    </div> -->
                                    <div class="result-section hidden" result-section>
                                        <div class="score-card">
                                            <div class="result-banner-section">
                                                <a class="result-banner">
                                                <?php if(null !== $result_card_image->result_image && $result_card_image->result_image != ""){ ?>
                                                    <img src="<?=$result_card_image->result_image?>" alt="" class="banner-img">
                                                <?php } ?>
                                                    <!-- <img class="banner-img" src="assets/result-banner.jpg" alt="byjus.com" width="250" height="250"> -->
                                                </a> 
                                            </div>
                                            <div class="result-details">
                                                <div class="well-done-text quiz-name-text">
                                                    <p class="quiz-title"><?php the_title(); ?></p>
                                                </div>
                                                <div class="well-done-text">
                                                    Hey! <span class="user_name"><!--user name from JavaScript --></span>
                                                </div>
                                                <div class="result-score-blk">
                                                    <p class="done">Well Done! You Scored</p>
                                                    <span class="result_blk"><!--result from JavaScript --></span><span>/10</span>
                                                </div>
                                                <div class="time_blk">
                                                    <span class="total-time-taken">
                                                        <!-- time taken by user -->
                                                    </span>
                                                </div> 
                                                <div class="quiz-social-share">
                                                    <span class="Share-quiz">
                                                        Share this quiz with your friends and challenge your friends.
                                                        Can you defend your score?
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="quiz-share-button hidden" social-share-section>
                                        <span class="Shape"><a class="share-icon" href="<?= $fb_share_slug ?>"><img class="sahre-icon-img" src="https://cdn1.byjus.com/blog/quiz_corner/facebook_share_icon.png" alt="" height="35px" width="35px"></a></span> &nbsp;&nbsp;
                                        <span class="Shape"><a class="share-icon" href="<?= $whatsapp_share_slug ?>"><img class="sahre-icon-img" src="https://cdn1.byjus.com/blog/quiz_corner/whatsapp_share_icon.png" alt="" height="35px" width="35px"></a></span> &nbsp;&nbsp;
                                        <span class="Shape"><a class="share-icon" href="<?= $telegram_share_slug ?>"><img class="sahre-icon-img" src="https://cdn1.byjus.com/blog/quiz_corner/telegram_share_icon.png" alt="" height="36px" width="35px"></a></span> &nbsp;&nbsp;
                                        <!-- <span class="Shape"><a class="share-icon" href="<?= $telegram_share_slug ?>"><img class="sahre-icon-img" src="https://cdn1.byjus.com/blog/quiz_corner/share_chat_icon.png" alt="" height="35px" width="35px"></a></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ----------------Other Quiz link Section----------------- -->
            <section class="quiz-login-section more-quiz-session">
                <div class="container morequiz-container">
                    <div class="more-quiz hidden" more-quiz>
                        <div class="Check-out-other">
                            Check out the other quizes
                        </div>
                        <div class="more-quiz-card">
                            <div class="infinity-card other-quiz">
                                <a href=""><img src="https://cdn1.byjus.com/blog/quiz_corner/Infinity_Quiz_Logo.png" alt="card-logo" class="card-logo"></a>
                            </div>
                            <div class="nature-card other-quiz">
                                <a href=""><img src="https://cdn1.byjus.com/blog/quiz_corner/Nature_Wildlife_Quiz_Logo.png" alt="card-logo" class="card-logo"></a>
                            </div>
                            <div class="science-card other-quiz">
                                <a href=""><img src="https://cdn1.byjus.com/blog/quiz_corner/Space_Quiz_Logo.png" alt="card-logo" class="card-logo"></a>
                            </div>
                            <div class="senses-card other-quiz">
                                <a href=""><img src="https://cdn1.byjus.com/blog/quiz_corner/Sense_Quiz_Logo.png" alt="card-logo" class="card-logo"></a>
                            </div>
                        </div>
                        <div class="view-more-card">
                            <button id="morequizbtn" class="view-more-btn btn" >View More</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- footer -->
        <div class="footer-copyrite">
            <div class="container">
                <ul class="list-inline footer-dpts">
                    <li>
                        <a href="https://byjus.com/disclaimer/" target="_blank">Disclaimer</a><br>
                    </li>
                    <li>
                        <a href="https://byjus.com/tnc_app/#privacydesc" target="_blank">Privacy Policy</a><br>
                    </li>
                    <li>
                        <a href="https://byjus.com/tnc_app/#tncdesc" target="_blank">Terms of Services</a><br>
                    </li>
                    <li>
                        <a href="https://byjus.com/sitemap.xml" target="_blank">Sitemap</a>
                    </li>
                </ul>
                <div class="footer-copy">©&nbsp;2021, BYJU'S. All rights reserved.</div>
                <div class="clearfix"></div>
            </div>
        </div>

    <?Php } endwhile; endif; ?>

</body>
</html>
<script type="text/javascript" src="https://cdn1.byjus.com/byjusweb/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdn1.byjus.com/byjusweb/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/wp-content/themes/html5blank-stable/js/quiz-session.js"></script>