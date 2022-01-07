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


$post->date = $data->date;
$post->rollNo = $data->rollNo;
$post->cId1 = $data->cId1;
$post->cId2 = $data->cId2;
$post->cId3 = $data->cId3;
$post->cId4 = $data->cId4;

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
