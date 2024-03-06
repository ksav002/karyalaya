<?php
    function connectDatabase($dbName) {
        $connection = mysqli_connect('localhost', 'root', '', $dbName);
        if (!$connection) {
            die('Database connection failed: ' . mysqli_connect_error());
        }
        return $connection;
    }
    //validateUserLogin('student','johndoe','password123');
    function validateUserLogin($title,$username,$password){
        if ($title == 'teacher'){
            $connection = connectDatabase('project_teachers');
        }
        else if ($title == 'student') {
            $connection = connectDatabase('project_students');
        }
        else {
            return false; // Invalid title
        }

        $sql = "SELECT * FROM batch_2020 WHERE username = '$username' AND password = '" . md5($password) . "'";

        $result = mysqli_query($connection,$sql);

        if($result && mysqli_num_rows($result)>0){
            mysqli_close($connection);
            return true; // User exists and credentials are correct
        } else {
            mysqli_close($connection);
            return false; // User does not exist or credentials are incorrect
        }
    }

?>