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

$post->email = $data->email;
$post->password = $data->password;

$res = $post->loginStudent();
$num = $res->rowCount();

if ($num = 1) {
    $posts_arr = array();
    $posts_arr['data'] = array();
    while ($row = $res->fetch()) {
        extract($row);
        $post_item = array(
            'rollNo' => $rollNo,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'dNo' => $dNo,
        );
        array_push($posts_arr['data'], $post_item);
    }
    echo json_encode($posts_arr);
} else {
    echo json_encode(
        array(
            'message' => 'Error while logging in as a student'
        )
    );
}
