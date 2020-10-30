<?php

include("config/config.php");

//Headers to make service available domains

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Acess-Control-Allow-Methods, Authorization, x-Requested-With");


//Variables

$method = $_SERVER["REQUEST_METHOD"];
$courses = new Courses();
$data = json_decode(file_get_contents("php://input"), true);

//Checks if there's an ID

if (isset($_GET['id'])) {
    $index = $_GET['id'];
}

//Switch

switch ($method) {
    case "GET":
        //GET
        
        if (isset($index)) {
            $response = $courses->getIdCourses($index);
        } else {
            $response = $courses->getCourses();
        }
        if (sizeof($response) > 0) {
            http_response_code(200); //OK
        } else {
            http_response_code(404); //Not found
            $response = array("message" => "No courses was found.");
        }
        break;
    case "PUT":
        //UPDATE/PUT

        $school = $data['school'];
        $courseName = $data['coursename'];
        $date = $data['date'];

        if ($courses->updateCourses($school, $courseName, $date, $index)) {
            http_response_code(200); //OK
            $response = array("message" => "Course updated.");

        } else {
            http_response_code(500); //Server error
            $response = array("message" => "Error updating course.");
        }
        break;
    case "POST":
        //Create new course and ADD/POST

        $school = $data['school'];
        $courseName = $data['coursename'];
        $date = $data['date'];
        if ($courses->createCourses($school, $courseName, $date)) {
            http_response_code(201); //OK
            $response = array("message" => "Course created.");
        } else {
            http_response_code(503); //Server error
            $response = array("message" => "Course not created.");
        }
        break;
    case "DELETE":
        //DELETE

        if (!isset($index)) {
            http_response_code(501);
            $response = array("message" => "No id found.");
        } else {
            if ($courses->deleteCourses($index)) {
                http_response_code(200); //OK
                $response = array("message" => "Course deleted");
            } else {
                http_response_code(500); //Server error
                $response = array("message" => "Course not deleted");
            }
        }
        break;
}

echo json_encode($response, JSON_PRETTY_PRINT);
