<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/DB.php';
include_once '../../models/Students.php';
include_once '../../models/Exam.php';
include_once '../../models/Enroll.php';

$database = new DB();
$db = $database->connect();

$post = new Students($db);
// $exam = new Exam($db);
// $enroll = new Enroll($db);

$data = json_decode(file_get_contents("php://input"));

$post->name = $data->name;
$post->email = $data->email;
$post->phone = $data->phone;
$post->password = $data->password;
$post->dNo = $data->dNo;
$post->sem = $data->sem;

if ($post->registerStudent()) {
    // $post->email = $data->email;
    // $post->password = $data->password;
    // $res = $post->loginStudent();
    // $num = $res->rowCount();
    // if ($num == 1) {
    //     $post_item = array();
    //     while ($row = $res->fetch()) {
    //         extract($row);
    //         $thatRollNo = $rollNo;
    //         $enn = $enroll->getEnrolledCourse($thatRollNo);
    //         $n = $enn->rowCount();
    //         if ($n == 1) {
    //             while ($row = $enn->fetch()) {
    //                 extract($row);
    //                 $exam->insertRollNo($thatRollNo, $cId);
    //             }
    //         }
    //     }
    // }
    echo json_encode(
        array(
            'message' => 'Student created successfully '
        )
    );
} else {
    echo json_encode(
        array(
            'message' => 'Error while signing up student'
        )
    );
}
