<?php

function connection(){
	$conn = new mysqli("localhost", "root", "", "project");

if(!$conn) {
	die("connection failed: ". mysqli_connect_error());
}
return $conn;
}

?>