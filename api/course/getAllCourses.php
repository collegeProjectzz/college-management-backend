<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/DB.php';
include_once '../../models/Course.php';

$database = new DB();
$db = $database->connect();

$post = new Course($db);
$result = $post->getAllCourses();

$num = $result->rowCount();
if ($num > 0) {
    $posts_arr = array();
    $posts_arr['data'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'cId' => $cId,
            'cName' => $cName,
            'credit' => $credit,
            'fId' => $fId,
        );
        array_push($posts_arr['data'], $post_item);
    }
    echo json_encode($posts_arr);
} else {
    echo json_encode(array('message' => "no courses found"));
}
