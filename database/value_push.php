<?php
    include_once 'connect.php';
    include_once 'check_result.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    function createCategory(){
        $connection = connectDatabase();
        
        $sql = "";

        $result = mysqli_query($connection,$sql);
        
        if (checkResult($result,$connection) !== true){
            exit();
        }

    }

    function createQuestion(){

    }

?>