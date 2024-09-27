<?php

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $productName = $_POST['productName'] ?? '';
    $productPrice = $_POST['productPrice'] ?? '';
    $discount = $_POST['productDiscount'] ?? '';
    $inStock = $_POST['inStock'] ?? '';
    $category = $_POST['productCategory'] ?? '';
    $description = $_POST['productDesc'] ?? '';
    $product_information = array();
    $images_array = array();
    $sql_query = 'INSERT INTO products(';
    $sql_columns = '';
    $sql_values = '';

    $images = $_FILES['images'] ?? [];
    $targetDirectory = "C:/Users/achan/Desktop/Innova/UPLOADED_IMAGES/";

    $productDetails = [];
    foreach ($_POST as $key => $value) {
        if(isset($_POST[$key]) && $_POST[$key] == 'on' && isset($_POST[$key.'-value'])) {

            echo $_POST[$key].": ".$key." ".$_POST[$key.'-value']."<br>";
            $product_information[] = [$key, $_POST[$key.'-value']];
        }
    }

    $sql_columns = "name, price, discount, in_stock, category, description";

    print_r($product_information);

    foreach($product_information as $column) {
        $sql_columns = $sql_columns.", ".$column[0];
    }
    echo "<br>QUERY:".$sql_columns."<br>";

    if (!empty($images)) {
        foreach ($_FILES['images']['name'] as $key => $name) {
            $tmpName = $_FILES['images']['tmp_name'][$key];
            $fileName = basename($name);
    
            $targetFilePath = $targetDirectory . $fileName;
            if (move_uploaded_file($tmpName, $targetFilePath)) {
                echo "File $fileName uploaded successfully.<br>";
                $images_array[] = $targetFilePath;
            } else {
                echo "Failed to upload $fileName.<br>";
            }
        }
    }
    $count = 1;
    foreach($images_array as $image) {
        $sql_columns = $sql_columns.", image$count";
        $count += 1;
    }

    $sql_values = "'$productName', $productPrice, $discount,
        $inStock, '$category', '$description'";

    foreach($product_information as $column_value) {
        $sql_values = $sql_values.", "."'$column_value[1]'";
    }

    foreach($images_array as $image) {
        $sql_values = $sql_values.", '".$image."'";
    }

    echo "<br>QUERY!!!:".$sql_values."<br>";

    $sql_query = 'INSERT INTO products('.$sql_columns.')'.' VALUES ('.
        $sql_values.');';


    echo "<br>FINAL QUERY:".$sql_query."<br>";

    $res = $conn->query($sql_query);
}
