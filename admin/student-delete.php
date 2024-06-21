<?php
include('config/dbcon.php');
include('config/function.php');

// Check and retrieve sanitized student_id
$student_id = check_student_id();

$conn = connection();  // Establish the database connection

// Debugging: Log the student_id to ensure it's correct
error_log("Attempting to delete student with ID: $student_id");

// Delete student based on student_id
$query = "DELETE FROM students WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_affected_rows($conn) > 0) {
        redirect('show-student.php', 'Student deleted successfully');
    } else {
        // Debugging: Log the query to see if there's an issue
        error_log("No student found with ID: $student_id. Query: $query");
        redirect('show-student.php', 'No student found with the provided ID');
    }
} else {
    // Log the error message for debugging
    error_log("SQL Error: " . mysqli_error($conn));
    redirect('show-student.php', 'Failed to delete student');
}

mysqli_close($conn);  // Close the database connection
?>
