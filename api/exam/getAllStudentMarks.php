<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/DB.php';
include_once '../../models/Exam.php';

$database = new DB();
$db = $database->connect();

$post = new Exam($db);
$result = $post->getAllStudentMarks();
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
        );
        array_push($posts_arr['data'], $post_item);
    }
    echo json_encode($posts_arr);
} else {
    echo json_encode(array('message' => "no students found"));
}
