<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/DB.php';
include_once '../../models/Exam.php';

$database = new DB();
$db = $database->connect();

$post = new Exam($db);

$data = json_decode(file_get_contents("php://input"));


$post->cId = $data->cId;
$post->it1 = $data->it1;
$post->it2 = $data->it2;
$post->rollNo = $data->rollNo;

if ($post->insertItMarks()) {
    echo json_encode(
        array(
            'message' => 'marks inserted successfully'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'failed to insert marks'
        )
    );
}
