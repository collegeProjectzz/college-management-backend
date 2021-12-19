<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/DB.php';
include_once '../../models/Faculty.php';

$database = new DB();
$db = $database->connect();

$post = new Faculty($db);

$data = json_decode(file_get_contents("php://input"));



$post->fName = $data->fName;
$post->fEmail = $data->fEmail;
$post->fPassword = $data->fPassword;
$post->dNo = $data->dNo;
$post->fId = $data->fId;

if ($post->editFaculty()) {
    echo json_encode(
        array(
            'message' => 'Faculty updated sucessfully'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'Error while updating faculty'
        )
    );
}
