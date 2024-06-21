<html>
<head>
    <title>Add Batch</title>
    <style>
        /* Reset default browser styles */
* {
    margin-top: 20px;
    box-sizing: border-box;
}

/* Basic styles for the container */
.container {
    max-width: 60px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 8px;
}

/* Styles for the form */
.batch-form {
    display: block;
    
}

/* Styles for form elements */
label {
    font-weight: bold;
    margin-bottom: 8px;
}

input[type="text"] {
    padding: 8px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <form action="" method="POST">
        <label for="batchYear">Batch Year:</label>
        <input type="text" id="batchYear" name="batchYear" required>
        <br><br>
        <button type="submit" name="addBatch">Add Batch</button>
    </form>
</body>
</html>


<?php
include_once 'config/dbcon.php';

// Check if batchYear is provided via POST method
if (isset($_POST['batchYear'])) {
    $batchYear = $_POST['batchYear'];

    // Sanitize input (optional but recommended)
    $conn = connection();
    $batchYearParam = mysqli_real_escape_string($conn, $batchYear);

    // Prepare the procedure call
    $procedureCall = "CALL UpdateSemesterForBatch('$batchYearParam')";

    // Attempt to execute the procedure
    if (mysqli_query($conn, $procedureCall)) {
        echo '<script>alert("Semester updated successfully."); window.location.href = "index.php";</script>';
    } else {
        echo '<script>alert("Failed to update semester."); window.location.href = "index.php";</script>';
        error_log("Procedure call failed: " . mysqli_error($conn));
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

