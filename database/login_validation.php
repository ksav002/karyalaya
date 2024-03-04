<?php
    function connectDatabase() {
        $connection = mysqli_connect('localhost', 'root', '', 'project');
        if (!$connection) {
            die('Database connection failed: ' . mysqli_connect_error());
        }
        return $connection;
    }

    function validateUser($username,$password){
        $connection = connectDatabase();

        $title = 'student';

        $sql = "SELECT * FROM $title WHERE username = '$username' AND password = '" . md5($password) . "'";
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