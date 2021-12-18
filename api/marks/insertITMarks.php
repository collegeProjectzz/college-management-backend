<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,application/json,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/DB.php';
include_once '../../models/Exam.php';

$database = new DB();
$db = $database->connect();

$post = new Exam($db);

$data = json_decode(file_get_contents("php://input"));

$post->rollNo = $data->rollNo;
$post->cId = $data->cId;
$post->it1 = $data->it1;
$post->it2 = $data->it2;


if ($post->insertITMarks()) {
    echo json_encode(
        array(
            'message' => 'Marks inserted successfully '
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'Error while inserting marks'
        )
    );
}
