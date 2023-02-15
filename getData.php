<?php

include 'connect.php';

$query1 = 'SELECT * FROM tbl_cat';
$category = $connect->prepare($query1);
$category->execute();
$result = $category->fetchAll();

$out = [];

foreach ($result as $key=>$row){
    $id = $row['id'];
    $title = $row['title'];

    $out[$key]['title'] = $title;

    $query2 = "SELECT * FROM tbl_mahsol WHERE id_cat = '$id'";
    $product = $connect->prepare($query2);
    $product->execute();
    $result2 = $product->fetchAll(PDO::FETCH_ASSOC);

    $out[$key]['items'] = $result2;
}

echo json_encode($out);