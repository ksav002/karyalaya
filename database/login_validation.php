<?php
    function connectDatabase($dbname) {
        $connection = mysqli_connect('localhost', 'root', '', $dbname);
        if (!$connection) {
            die('Database connection failed: ' . mysqli_connect_error());
        }
        return $connection;
    }
    //validateUserLogin('student','johndoe','password123');
    function validateUserLogin($tableName,$username,$password){
        
        $connection = connectDatabase('project');
        
        $sql = "SELECT * FROM $tableName WHERE username = '$username' AND password = '" . md5($password) . "'";

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