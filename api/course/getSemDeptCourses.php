

<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/DB.php';
include_once '../../models/Course.php';
include_once '../../models/Students.php';

$database = new DB();
$db = $database->connect();

$course = new Course($db);

$course->dNo = isset($_GET['dNo']) ? $_GET['dNo'] : die();
$course->sem = isset($_GET['sem']) ? $_GET['sem'] : die();

$result = $course->getCurrentSemDeptCourses();

$student = new Students($db);

$num = $result->rowCount();

if ($num > 0) {
    $posts_arr = array();
    $posts_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'rollNo' => $rollNo,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'dNo' => $dNo,
            'sem' => $sem,
            'cId' => $cId,
            'cName' => $cName,
            'credit' => $credit,
            'fId' => $fId,
        );
        array_push($posts_arr['data'], $post_item);
    }
    echo json_encode($posts_arr);
} else {
    echo json_encode(array('message' => "no students found"));
}
