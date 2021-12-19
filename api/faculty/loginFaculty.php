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

$post->fEmail = $data->fEmail;
$post->fPassword = $data->fPassword;

$res = $post->loginFaculty();

$num = $res->rowCount();
if ($num == 1) {
    $posts_arr = array();
    $posts_arr['data'] = array();
    while ($row = $res->fetch()) {
        extract($row);
        $post_item = array(
            'fId' => $fId,
            'fName' => $fName,
            'fEmail' => $fEmail,
            'dNo' => $dNo,
        );
        array_push($posts_arr['data'], $post_item);
    }
    echo json_encode($posts_arr);
} else {
    echo json_encode(array('message' => "no faculty found"));
}
