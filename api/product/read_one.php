<?php
//required headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: access');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

// include database and object files
include_once '../config/Database.php';
include_once '../objects/Product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

// set ID property of record to read
$product->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$product->readOne();

if ($product->name !== null) {
    // create array
    $product_arr = [
        'id' =>  $product->id,
        'name' => $product->name,
        'description' => $product->description,
        'price' => $product->price,
        'category_id' => $product->category_id,
        'category_name' => $product->category_name
    ];
}