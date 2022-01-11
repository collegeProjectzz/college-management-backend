<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/DB.php';
include_once '../../models/Exam.php';
include_once '../../models/Students.php';

$database = new DB();
$db = $database->connect();

$post = new Exam($db);
$post->cId = isset($_GET['cId']) ? $_GET['cId'] : die();
$result = $post->SudentsIncourse();

$student = new Students($db);

$num = $result->rowCount();

if ($num > 0) {
    $posts_arr = array();
    $posts_arr['data'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'rollNo' => $rollNo,
            'cId' => $cId,
            'it1' => $it1,
            'it2' => $it2,
            'it3' => $it3,
            'sem' => $sem,
            'total' => $total,
            'avg' => $avg,
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "dNo" => $dNo,
        );
        array_push($posts_arr['data'], $post_item);
    }
    echo json_encode($posts_arr);
} else {
    echo json_encode(array('message' => "no students found"));
}
