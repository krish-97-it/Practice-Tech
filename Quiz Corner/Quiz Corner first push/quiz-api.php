//Add quiz login data
function add_quiz_login_data()
{
    global $wpdb;
    $response_message="";
    $userName           = $_POST['name'];
    $emailId            = $_POST['email'];
    $quiz_name          = $_POST['quizname'];
    $existing_email     = $wpdb->get_results("SELECT * FROM wp_quiz_result_details w WHERE `quiz_name`='$quiz_name' and `email_id`= '$emailId'");
    $existing_user      = $wpdb->get_results("SELECT * FROM wp_quiz_login_details w WHERE `email_id`= '$emailId'");

    if(!$existing_user){
        $data_insert            =   $wpdb->query($wpdb->prepare(
                                    'INSERT INTO wp_quiz_login_details (`user_name`,`email_id`) VALUES ("%s","%s")',
                                    $userName,$emailId));
        if($data_insert){
            $response_message   =   'success';
        }
        else{
            $response_message   =   'User registration is not happened.';
        }
    }
    else{
        if(!$existing_email){
            $response_message   =   'newquiz';
        }
        else{
            $response_message   =   'User already registered.Try other quizes.';
        }
    }
    return  [
        "success"   =>  ($response_message == 'success' || $response_message == 'newquiz') ? true : false,
        "message"   =>  ($response_message == 'newquiz' || $response_message == 'success' ) ? 'Thank you for registration.' : $response_message
    ];
}

//Add Quiz user result data
function add_quiz_result_data()
{
    global $wpdb;
    $response_message="";
    $emailId            = $_POST['email'];
    $quiz_name          = $_POST['quizname'];
    $quiz_score         = $_POST['quizscore'];
    $time_taken         = $_POST['timetaken'];

    $data_insert        = $wpdb->query($wpdb->prepare(
                          'INSERT INTO wp_quiz_result_details (`email_id`,`quiz_name`,`quiz_score`,`time_taken`) VALUES ("%s","%s","%s","%s")',
                           $emailId, $quiz_name, $quiz_score, $time_taken));

    if($data_insert){
        $response_message   =   'success';
    }
    else{
        $response_message   =   'Insertion is not happened.';
    }

    return  [
        "success"   =>  ($response_message == 'success') ? true : false,
        "message"   =>  ($response_message == 'success') ? 'Thank you for playing the quiz.' : $response_message
    ];
}

add_action('rest_api_init', function () {
    register_rest_route(
        'spidy/v1',
        '/add_quiz_login_data/',
        array(
            'methods'   => 'POST',
            'callback'  => 'add_quiz_login_data'
        )
    );
});

add_action('rest_api_init', function () {
    register_rest_route(
        'spidy/v1',
        '/add_quiz_result_data/',
        array(
            'methods'   => 'POST',
            'callback'  => 'add_quiz_result_data'
        )
    );
});