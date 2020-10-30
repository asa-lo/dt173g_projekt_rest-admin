<?php

include("config/config.php");

//Headers to make service available from domains

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Acess-Control-Allow-Methods, Authorization, x-Requested-With");

//Variables

$method = $_SERVER["REQUEST_METHOD"];
$CV = new CV();
$data = json_decode(file_get_contents("php://input"), true);

//ID and GET

if (isset($_GET['id'])) {
    $index = $_GET['id'];
}

//Switch

switch ($method) {
    case "GET":
        //GET

        if (isset($index)) {
            $response = $CV->getIdCV($index);
        } else {
            $response = $CV->getCV();
        }
        if (sizeof($response) > 0) {
            http_response_code(200); //Ok = fetched
        } else {
            http_response_code(404); // Not found
            $response = array("message" => "No CV was found.");
        }
        break;
    case "PUT":
        //UPDATE

        $name = $data['name'];
        $title = $data['title'];
        $date = $data['date'];

        if ($CV->updateCV($name, $title, $date, $index)) {
            http_response_code(200); //OK
            $response = array("message" => "CV updated.");
        } else {
            http_response_code(500); // Server error
            $response = array("message" => "Error updating CV");
        }
        break;
    case "POST":
        // Create new CV and ADD/POST

        $name = $data['name'];
        $title = $data['title'];
        $date = $data['date'];
        if ($CV->createCV($name, $title, $date)) {
            http_response_code(201); //OK
            $response = array("message" => "CV created.");
        } else {
            http_response_code(503); //Server error
            $response = array("message" => "CV was not created.");
        }
        break;
    case "DELETE":
        // DELETE

        if (!isset($index)) {
            http_response_code(501);
            $response = array("message" => "No id found.");
        } else {
            if ($CV->deleteCV($index)) {
                http_response_code(200); //OK
                $response = array("message" => "CV deleted");
            } else {
                http_response_code(500); //Server error
                $response = array("message" => "CV was not deleted");
            }
        }
        break;
}

echo json_encode($response, JSON_PRETTY_PRINT);
