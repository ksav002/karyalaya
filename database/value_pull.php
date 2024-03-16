<?php
    include_once 'connect.php';
    include_once 'check_result.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    function getId(){
        
    }

    function getCourse($value){
        $connection = connectDatabase();

        if ($_SESSION['title'] == 'teacher'){
            $sql = "SELECT course_code, course_title FROM courses INNER JOIN teacher_courses USING (course_code) WHERE teacher_id=101 AND active_status=1;";
        }
        else if ($_SESSION['title'] == 'student'){
            $sql = "SELECT course_code, course_title FROM courses INNER JOIN batch USING (semester_number) WHERE semester_number='$value';";
        }

        $result = mysqli_query($connection,$sql);

        if (checkResult($result,$connection) !== true){
            exit();
        }

        $courseNames = [];
        while ($var = mysqli_fetch_assoc($result)) {
            array_push($courseNames, $var);
       }
       return $courseNames;
    }


?>