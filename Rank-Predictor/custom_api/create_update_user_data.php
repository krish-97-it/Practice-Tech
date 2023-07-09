<?php  
   header("Content-Type:application/json");
   include('connection.php');

    $name                       =   $_POST['Name']?$_POST['Name']:'';
    $phone                      =   $_POST['Phone']?$_POST['Phone']:'';
    $email                      =   $_POST['Email']?$_POST['Email']:'';
    $address                    =   $_POST['Address']?$_POST['Address']:'';

    $find_flag                  =   userCheck($conn,$phone);
    $msg                        =   '';



    function userCheck($run,$mob_no){
        $sql= "SELECT `phone` FROM wp_create_update_user_data WHERE `phone` = '".$mob_no."'";
        $result = $run->query($sql);
        $data   = mysqli_fetch_assoc($result);
        return($data['phone']);
    }

    if($find_flag){
        $sql    =   "UPDATE wp_create_update_user_data SET `name` = '$name', `email` = '$email',  `address` = '$address' WHERE `phone` = '".$phone."'";
        
        if(mysqli_query($conn, $sql)){
            $response["statusCode"] = "200";
            $response["text"]       = "Record Updatated Sucessfully"; 
        }else{
            $response["statusCode"] = "201";
            $response["text"]       = "Updation Failed";
        }
    }else{
        $sql    =   "INSERT INTO wp_create_update_user_data(`name`,`phone`,`email`,`address`) VALUES('$name', '$phone', '$email', '$address')";
        if(mysqli_query($conn, $sql)){
            $response["statusCode"] = "200";
            $response["text"]       = "Record Inserted Sucessfully"; 
        }else{
            $response["statusCode"] = "201";
            $response["text"]       = "Insertion Failed";
        }
    }

    echo json_encode ($response);
?>