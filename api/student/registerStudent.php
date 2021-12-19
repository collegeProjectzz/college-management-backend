<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/DB.php';
include_once '../../models/Students.php';

$database = new DB();
$db = $database->connect();

$post = new Students($db);

$data = json_decode(file_get_contents("php://input"));

$post->name = $data->name;
$post->email = $data->email;
$post->phone = $data->phone;
$post->password = $data->password;
$post->dNo = $data->dNo;

if ($post->registerStudent()) {
    echo json_encode(
        array(
            'message' => 'Student created successfully c'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'Error while signing up student'
        )
    );
}
