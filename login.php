<?php

include 'connect.php';

if (isset($_REQUEST["email"]) || isset($_REQUEST["password"])) {
    $email = htmlentities($_REQUEST["email"]);
    $password = htmlentities($_REQUEST["password"]);
}

$query = "SELECT * FROM tbl_users WHERE email = '$email'";

$result = $connect->prepare($query);
$result->execute();
$row = $result->fetch(PDO::FETCH_ASSOC);

if ($row == true) {
    $query1 = "SELECT * FROM tbl_users WHERE email='$email' AND password='$password'";
    $result1 = $connect->prepare($query1);
    $result1->execute();
    $row1 = $result1->fetch(PDO::FETCH_ASSOC);

    if($row1) {
        $rec = array();
        $rec['id'] = $row1['id'];
        $rec['display_name'] = $row1['display_name'];
        $rec['email'] = $row1['email'];

        echo json_encode($rec);
    }else {
        echo 'pass is wrong';
    }
}else {
    echo 'email sabt nashode';
}