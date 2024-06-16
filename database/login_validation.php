<?php
    error_reporting();
    include_once 'connect.php';
    include_once 'check_result.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // validateUserLogin('students','johndoe','password123');
    // validateUserLogin('teachers','daveg','password789');
    function validateUserLogin($tableName,$username,$password){
        
        $connection = connectDatabase();
        
        $sql = "SELECT * FROM $tableName WHERE username = '$username' AND password = '" . md5($password) . "'";

        $result = mysqli_query($connection,$sql);
        
        //if the given sql query returns any value, execute the code, set the cookie else return false
        if (checkResult($result,$connection)){
            //store fetched data in a array
            $details = [];
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($details, $row);
            }
            return true;
        } else {
            return false;
        }
    }
?>