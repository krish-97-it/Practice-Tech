<?php

$servername     =   "localhost";
$username       =   "root";
$password       =   "";
$db             =   "kn_web_dev";
$conn           =   mysqli_connect($servername, $username, $password, $db);

$operation_Search           =   $_POST['oType'];
$searchUserId               =   $_POST['searchuserId'];

if(isset($searchUserId)){
    if($operation_Search == "find")
    {
        $sql= "SELECT * FROM wp_crud WHERE `user_id` = '".$searchUserId."'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_array($result)) {
            $data["name"]    =  $row["name"];
            $data["phone"]   =  $row["phone"];
            $data["email"]   =  $row["email"];
            $data["address"] =  $row["address"];
            $data["userid"]  =  $row["user_id"];
        }
        echo json_encode ($data);
    }
}
?>