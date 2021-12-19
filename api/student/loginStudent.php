<?php


header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/DB.php';
include_once '../../models/Students.php';

$database = new DB();
$db = $database->connect();

$post = new Students($db);

$data = json_decode(file_get_contents("php://input"));

$post->rollNo = $data->rollNo;
$post->password = $data->password;

$res = $post->loginStudent();
$num = $res->rowCount();

if ($num = 1) {
    $post->getSingleStudent($post->rollNo);
    $userInfoArray = array(
        'rollNo' => $post->rollNo,
        'name' => $post->name,
        'email' => $post->email,
        'phone' => $post->phone,
        'dNo' => $post->dNo,
    );
    echo json_encode($userInfoArray);
} else {
    echo json_encode(
        array(
            'message' => 'Error while signing up student'
        )
    );
}
