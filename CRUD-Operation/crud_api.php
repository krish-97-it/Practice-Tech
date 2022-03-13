<?php  
    $servername     =   "localhost";
    $username       =   "root";
    $password       =   "";
    $db             =   "kn_web_dev";
    $conn           =   mysqli_connect($servername, $username, $password, $db);

    $searchUserId               =   $_POST['searchuserId'];
    $newUserId                  =   $_POST['UpdateUserId'];
    $name                       =   $_POST['Name'];
    $phone                      =   $_POST['Phone'];
    $email                      =   $_POST['Email'];
    $address                    =   $_POST['Address'];
    $crud_type                  =   $_POST['crud-dropdown-section'];
    $data["userid"]             = '';

    if($crud_type == 'insert'){
        if($newUserId !="" && $name != '' && $address !=''){
            $find_existing_data = "SELECT user_id FROM wp_crud WHERE user_id = '$newUserId'";
            $result = $conn->query($find_existing_data);
            if($row = mysqli_fetch_array($result)) {
                $data["userid"]  =  $row["user_id"];
            }
            if($data["userid"] != '')
            {
                $sql= "UPDATE wp_crud SET name = '$name',  phone = '$phone', email = '$email',  address = '$address', updated_at = now() WHERE user_id = '".$data["userid"]."'";
            }
            else{
                $sql= "INSERT INTO wp_crud(NAME,phone,email,address,user_id) VALUES('$name', '$phone', '$email', '$address', '$newUserId')";
            }
            //Sending response
            if (mysqli_query($conn, $sql)) {
                $response["statusCode"] = "200";
                $response["text"] = "Record Inserted Sucessfully";
            }
        }
        else{
            $response["statusCode"] = "201";
            $response["text"] = "Failed to Insert";
        }

    }
    if($crud_type == 'update'){
        if($newUserId !="" && $name != '' && $address !=''){
            $sql= "UPDATE wp_crud SET name = '$name',  phone = '$phone', email = '$email',  address = '$address', user_id = '$newUserId', updated_at = now() WHERE user_id = '$searchUserId'";
            
            //Sending response
            if (mysqli_query($conn, $sql)) {
                $response["statusCode"] = "200";
                $response["text"] = "Record Updated Sucessfully";
            }
        }
        else{
            $response["statusCode"] = "201";
            $response["text"] = "Failed to Update";
        }

    }
    echo json_encode($response);
?>