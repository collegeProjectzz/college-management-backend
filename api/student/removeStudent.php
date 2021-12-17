<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,application/json,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/DB.php';
include_once '../../models/Students.php';

$database = new DB();
$db = $database->connect();

$post = new Students($db);

$data = json_decode(file_get_contents("php://input"));

$post->rollNo = $data->rollNo;

if ($post->removeStudent()) {
    echo json_encode(
        array(
            'message' => 'Student removed'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'Error while removing student'
        )
    );
}
