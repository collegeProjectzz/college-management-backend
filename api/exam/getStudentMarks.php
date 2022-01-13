

<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/DB.php';
include_once '../../models/Exam.php';

include_once '../../models/Course.php';
include_once '../../models/Students.php';

$database = new DB();
$db = $database->connect();

$post = new Exam($db);

$post->rollNo = isset($_GET['rollNo']) ? $_GET['rollNo'] : die();
$post->sem = isset($_GET['sem']) ? $_GET['sem'] : die();

$result = $post->getStudentMarks();

$course = new Course($db);
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
            'total' => $total,
            'avg' => $avg,
            'sem' => $sem,
            'cName' => $cName,
            "credit" => $credit,
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "password" => $password,
            "dNo" => $dNo,
        );
        array_push($posts_arr['data'], $post_item);
    }
    echo json_encode($posts_arr);
} else {
    echo json_encode(array('message' => "no students found", 'status' => 404));
}
