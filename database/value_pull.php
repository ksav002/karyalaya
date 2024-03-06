<?php
    include_once 'database/login_validation.php';

    function getName($title){
        if ($title == 'teacher'){
            $connection = connectDatabase('project_teachers');
        }
        else if ($title == 'student') {
            $connection = connectDatabase('project_students');
        }
        else {
            return false; // Invalid title
        }
        
    }


    function checkSemester(){
        connectDatabase('project_semesters');
    }

?>