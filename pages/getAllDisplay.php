<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once $_SERVER['DOCUMENT_ROOT'] . '/test/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/test/objects/display.php';

// instantiate database and object
$database = new Database();
$db = $database->getConnection();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// initialize object
$display = new Display($db);
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    return 0;
}

// read

$stmt = $display->read();

if($stmt)
{
    $num = $stmt->rowCount();

    if ($num > 0) 
    {
        // products array
        $display_arr = array();
        $display_arr["display"] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
         {
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
            $display_item = array("idDisplay" => $idDisplay, "nameContent" => $nameContent, "nameCategory" => $nameCategory, "image" => $image, "price" => $price, "available" => $available);
            array_push($display_arr["display"], $display_item);
        }

        // set response code - 200 OK
        http_response_code(200);
        // show products data in json format
        echo json_encode($display_arr);

    }
     else 
    {
        // set response code - 503 OK
        http_response_code(503);
        // tell the user access denied
        echo json_encode(array("Message" => "No protocols found."));
    }
}
else 
{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user product does not exist
    echo json_encode(array("Message" => "Protocol not found."));
}
?>