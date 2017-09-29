<?php

require '../inc/config.php';
$token = hash('sha256', "preci0u$");
if ($_REQUEST['token'] == $token) {
    if (isset($_REQUEST['grade']) && $_REQUEST['recipient'] == "teacher") {
        $childClass = $_REQUEST['grade'];
        $getTeacherInfo = "SELECT teacherOne, teacherTwo FROM grade WHERE grade = '$childClass'";
        $teacherInfoQuery = mysqli_query($conString, $getTeacherInfo) or die(mysqli_error($conString));
        $teacherInfo = mysqli_fetch_array($teacherInfoQuery);
        $teacherOne = $teacherInfo['teacherOne'];
        $teacherTwo = $teacherInfo['teacherTwo'];

        $getTeacher = mysqli_query($conString, "SELECT fname, sname, phonenum from users WHERE phonenum ='$teacherOne' OR phonenum='$teacherTwo'");
        $teacherData = mysqli_fetch_assoc($getTeacher);
        header("Content-type:application/json");
        echo json_encode($teacherData);
    } elseif ($_REQUEST['recipient'] == "admin") {
    $x=$_REQUEST['start'];
    $y = $_REQUEST['end'];

        $getAdmin = mysqli_query($conString, "SELECT fname, sname, phonenum from users WHERE priv =3 LIMIT $x, $y");
        $adminData = mysqli_fetch_assoc($getAdmin);
        header("Content-type:application/json");
        echo json_encode($adminData);
    }
} else {
    header('Content-type: application/json');
    $result['code'] = -3080;
    $result['message'] = "Invalid token!";
    echo json_encode(array($result));
    die();
}
?>