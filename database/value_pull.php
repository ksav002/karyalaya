<?php
    error_reporting();
    include_once 'connect.php';
    include_once 'check_result.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //get teacher or student details
    function getDetails($username){
        $connection = connectDatabase();
        
        if ($_SESSION['title'] == 'teacher'){
            $sql = "SELECT teacher_id, fname, lname FROM teachers WHERE username='$username';";
        }
        else if ($_SESSION['title'] == 'student'){
            $sql = "SELECT student_id, fname, lname, batch_year, semester_number FROM students INNER JOIN batch USING (batch_year) WHERE username='$username';";
        }

        $result = mysqli_query($connection,$sql);
        
        if (checkResult($result,$connection) !== true){
            exit();
        }
        $userDetails=[];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($userDetails, $row);
       }
       return $userDetails;

    }

    //get course details where value is teacher_id for teacher and semester_number for students
    function getCourse($stdId,$value){
        $connection = connectDatabase();
        if ($_SESSION['title'] == 'teacher'){
            $sql = "SELECT course_code, course_title,semester_number FROM courses INNER JOIN teacher_courses USING (course_code) WHERE teacher_id=$value AND active_status=1;";
        }
        else if ($_SESSION['title'] == 'student'){
            //7 ki 8 sem lai electives choose garna parni vayo so 
            //if ma 7 ra 8 banek arulai course select
            if ($value !== '7' && $value !== '8') {
                $sql = "SELECT course_code, course_title FROM courses INNER JOIN batch USING (semester_number) WHERE semester_number='$value';";
            } 
            //else ma 7 ra 8 lai course select
            else {
                $sql = "SELECT course_code,course_title
                FROM courses
                INNER JOIN batch USING (semester_number)
                LEFT JOIN (
                    SELECT DISTINCT chosen_electives.student_id, chosen_electives.semester_number, chosen_electives.elective_courses_code
                    FROM chosen_electives
                    WHERE chosen_electives.student_id = '$stdId' AND chosen_electives.semester_number = '$value'
                ) AS chosen ON courses.course_code = chosen.elective_courses_code
                WHERE courses.semester_number='$value' AND (courses.elective_subject = 0 OR (courses.elective_subject = 1 AND chosen.student_id IS NOT NULL));
                "; 
            }
        }
        $result = mysqli_query($connection,$sql);
        if (checkResult($result,$connection) !== true){
            exit();
        }
        $courseNames = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($courseNames, $row);
       }
       return $courseNames;
    }

    //for showing name of teacher in student dashboard
    //and showing the categories after a subject has been clicked based on getCategory()
    function getSubjectTeacher($course_code){
        $connection = connectDatabase();
        $sql = "SELECT teacher_id,fname, lname from teachers INNER JOIN teacher_courses USING (teacher_id) WHERE course_code='$course_code' AND teacher_courses.active_status=1";
        $result = mysqli_query($connection,$sql);
        if (checkResult($result,$connection) !== true){
            return false;
        }
        $teacherIdName = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($teacherIdName, $row);
        }
        return $teacherIdName;
    }

    //get the category of a subject
    function getCategory($teacherId,$courseCode){
        $connection = connectDatabase();
        $sql = "SELECT teacher_courses_id,assignment_category_id,category_name from assignment_category INNER JOIN teacher_courses USING (teacher_courses_id) WHERE teacher_id = '$teacherId' AND course_code = '$courseCode' AND active_status='1';";
        $result = mysqli_query($connection,$sql);
        if (checkResult($result,$connection) !== true){
            return false;
        }
        $categoryNames = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($categoryNames, $row);
        }
        return $categoryNames;
    }

    //get the assignments of respective categories
    function getAssignment($assignmentCategoryId){
        $connection = connectDatabase();
        $sql = "SELECT assignment_id,assignment_text,deadline,assignment_file FROM assignments where assignment_category_id='$assignmentCategoryId' ORDER BY deadline ASC;";
        $result = mysqli_query($connection,$sql);
        if (checkResult($result,$connection) !== true){
            return false;
        }
        $assignmentQuestion = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($assignmentQuestion, $row);
        }
        return $assignmentQuestion;
    }

    function getSubmission($assignmentId,$teacherCoursesId){
        $connection = connectDatabase();
        $sql = "SELECT fname,lname,submission_file FROM submission INNER JOIN students USING (student_id) where assignment_id='$assignmentId' AND teacher_courses_id='$teacherCoursesId';";

        $result = mysqli_query($connection,$sql);
        if (checkResult($result,$connection) !== true){
            return false;
        }
        $submissionResult = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($submissionResult, $row);
        }
        return $submissionResult;
    }
?>