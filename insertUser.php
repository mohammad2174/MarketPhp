<?php

include 'connect.php';

if (isset($_REQUEST["display_name"]) || isset($_REQUEST["email"]) || isset($_REQUEST["password"])) {
    $display_name = $_REQUEST["display_name"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
}
$query1 = "SELECT * FROM tbl_users WHERE email = '$email'";

$result1 = $connect->prepare($query1);
$result1->execute();
$row = $result1->fetch(PDO::FETCH_ASSOC);

if($row == false) {
    $query = "INSERT INTO tbl_users (display_name, email, password) VALUES ('$display_name', '$email', '$password')";

    $result = $connect->prepare($query);
    $result->execute();

    $last_id = $connect->lastInsertId();
    $query2 = "SELECT * FROM tbl_users WHERE id='$last_id'";
    $result2 = $connect->prepare($query2);
    $result2->execute();
    $row = $result2->fetch(PDO::FETCH_ASSOC);

    $rec = array();
    $rec['id'] = $row['id'];
    $rec['display_name'] = $row['display_name'];
    $rec['email'] = $row['email'];

    echo json_encode($rec);
}else {
    echo  'no';
}
