<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/DB.php';
include_once '../../models/Enroll.php';

$database = new DB();
$db = $database->connect();

$post = new Enroll($db);

$data = json_decode(file_get_contents("php://input"));


$post->rollNo = $data->rollNo;
$post->cId = $data->cId;


if ($post->enrollStudent()) {
    echo json_encode(
        array(
            'message' => 'enrolled student successfully'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'failed to enroll student'
        )
    );
}
