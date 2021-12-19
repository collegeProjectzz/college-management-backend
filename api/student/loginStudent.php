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

$post->email = $data->email;
$post->password = $data->password;

$res = $post->loginStudent();
$num = $res->rowCount();

if ($num = 1) {
    echo json_encode(
        array(
            'message' => 'Student logged in sucessfully'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'Error while signing up student'
        )
    );
}
