<?php
//required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and product object files
include_once '../config/Database.php';
include_once '../objects/Product.php';

// get database connection
$database = new Database();
$db       = $database->getConnection();

// prepare product object
$product = new Product($db);

// get id of product to be edited
$data = json_decode(file_get_contents('php://input'));

// set ID property of product to be edited
$product->id = $data->id;

// set product property values
$product->name        = $data->name;
$product->price       = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;

// update the product
if ($product->update()) {

    // set response code - 200 ok
    http_response_code(200);

    // tell teh user
    echo json_encode([
        'message' => 'product was updated.'
    ]);

} else {

    // set response code - 503 service unavailable
    http_response_code(503);

    // ter the user
    echo json_encode([
        'message' => 'Unable to update product.'
    ]);

}