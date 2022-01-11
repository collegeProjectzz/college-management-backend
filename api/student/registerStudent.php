<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/DB.php';
include_once '../../models/Students.php';
include_once '../../models/Exam.php';
include_once '../../models/Course.php';

$database = new DB();
$db = $database->connect();

$post = new Students($db);
$exam = new Exam($db);
$course = new Course($db);

$data = json_decode(file_get_contents("php://input"));

$post->name = $data->name;
$post->email = $data->email;
$post->phone = $data->phone;
$post->password = $data->password;
$post->dNo = $data->dNo;
$post->sem = $data->sem;

if ($post->registerStudent()) {
    echo json_encode(
        array(
            'message' => 'Student created successfully '
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'Error while signing up student'
        )
    );
}
