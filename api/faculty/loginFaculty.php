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
    $post_item = array();
    while ($row = $res->fetch()) {
        extract($row);
        $post_item = array(
            'fId' => $fId,
            'fName' => $fName,
            'fEmail' => $fEmail,
            'dNo' => $dNo,
            'fPassword' => $fPassword,
        );
    }
    echo json_encode($post_item);
} else if ($num == 0) {
    echo json_encode(
        array(
            'message' => 'No user exists with this user credentials'
        )
    );
} else {
    echo json_encode(array(
        'message' => "no faculty found"
    ));
}
