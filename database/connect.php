<?php
    function connectDatabase() {
        $connection = mysqli_connect('localhost', 'root', '', 'project');
        if (!$connection) {
            die('Database connection failed: ' . mysqli_connect_error());
        }
        return $connection;
    }
?>