<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/DB.php';
include_once '../../models/Exam.php';

$database = new DB();
$db = $database->connect();

$post = new Exam($db);

$post->rollNo = isset($_GET['rollNo']) ? $_GET['rollNo'] : die();

$post->getStudentMarks();

$post_arr = array(
    'rollNo' => $post->rollNo,
    'cId' => $post->cId,
    'it1' => $post->it1,
    'it2' => $post->it2,
);

print_r(json_encode($post_arr));
