<?php
function redirect($url, $message) {
    echo '<script>
        alert("' . $message . '");
        window.location.href = "' . $url . '";
    </script>';
    exit;
}

function check_student_id() {
    if (!isset($_GET['student_id']) || empty($_GET['student_id'])) {
        redirect('show-student.php', 'No student ID provided');
        exit;
    }

    // Sanitize the student_id if needed
    $conn = connection();  // Assuming this function connects to your database
    $student_id = mysqli_real_escape_string($conn, $_GET['student_id']);
    mysqli_close($conn);  // Close the database connection if not needed further

    return $student_id;
}
?>

