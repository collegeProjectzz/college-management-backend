<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/DB.php';
include_once '../../models/Faculty.php';

$database = new DB();
$db = $database->connect();

$post = new Faculty($db);

$data = json_decode(file_get_contents("php://input"));

$post->fName = $data->fName;
$post->fEmail = $data->fEmail;
$post->dNo = $data->dNo;
$post->fPassword = $data->fPassword;

if ($post->registerFaculty()) {
    echo json_encode(
        array(
            'message' => 'Faculty created successfully c'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'Error while signing up faculty'
        )
    );
}
