<?php


header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,application/json,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/DB.php';
include_once '../../models/Faculty.php';

$database = new DB();
$db = $database->connect();

$post = new Faculty($db);

$data = json_decode(file_get_contents("php://input"));

$post->fId = $data->fId;
$post->fPassword = $data->fPassword;

$res = $post->loginFaculty();
$num = $res->rowCount();

if ($num = 1) {
    echo json_encode(
        array(
            'message' => 'faculty logged in sucessfully'
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'Error while signing up student'
        )
    );
}