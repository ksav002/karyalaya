<?php
include('config/dbcon.php');
include('config/function.php');

// Check if teacher_id is provided in the URL
if (!isset($_GET['teacher_id']) || empty($_GET['teacher_id'])) {
    redirect('show-teacher.php', 'No teacher ID provided');
    exit;
}

$conn = connection();  // Establish the database connection

$teacher_id = mysqli_real_escape_string($conn, $_GET['teacher_id']);  // Sanitize the teacher_id

// Debugging: Log the teacher_id to ensure it's correct
error_log("Attempting to delete teacher with ID: $teacher_id");

// Delete teacher based on teacher_id
$query = "DELETE FROM teachers WHERE teacher_id = '$teacher_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_affected_rows($conn) > 0) {
        redirect('show-teacher.php', 'Teacher deleted successfully');
    } else {
        // Debugging: Log the query to see if there's an issue
        error_log("No teacher found with ID: $teacher_id. Query: $query");
        redirect('show-teacher.php', 'No teacher found with the provided ID');
    }
} else {
    // Log the error message for debugging
    error_log("SQL Error: " . mysqli_error($conn));
    redirect('show-teacher.php', 'Failed to delete teacher');
}

mysqli_close($conn);  // Close the database connection
?>
