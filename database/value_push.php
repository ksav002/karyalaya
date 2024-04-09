<?php
    include_once 'connect.php';
    include_once 'check_result.php';
    include_once 'value_pull.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    function createCategory($teacher_id,$course_code,$input_value){
        try{
            $connection = connectDatabase();
            //to get teacher_courses_id so that category can be added to that teacher's course
            $sql = "SELECT teacher_courses_id FROM teacher_courses WHERE teacher_id='$teacher_id' and course_code='$course_code';";
            $result = mysqli_query($connection,$sql);
            $row = mysqli_fetch_assoc($result);
            $teacherCoursesId = $row['teacher_courses_id'];
            //to check if the given category already exists
            $sql = "SELECT category_name FROM assignment_category WHERE category_name = '$input_value' and teacher_courses_id='$teacherCoursesId';";
            $result = mysqli_query($connection,$sql);
            //check if it returns any rows or not, if it does there is already a category of that name in there
            if(mysqli_num_rows($result) == 1){
                return false;
            } else {
                //now insert the given input i.e., category-name
                $sql = " INSERT INTO assignment_category (teacher_courses_id, category_name) VALUES ('$teacherCoursesId','$input_value');";
                mysqli_query($connection,$sql);
                return true;
            }
        }
        catch(Exception $ex){
            die('Database Error: '. $ex->getMessage());
        }
    }

    function createQuestion(){

    }

?>