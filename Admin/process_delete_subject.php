<?php
include "../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['subject_Id'])) {
    // Validate and sanitize input data
    $subjectId = mysqli_real_escape_string($connect, $_GET['subject_Id']);

    // Delete data from the database
    $sql = "DELETE FROM subjects WHERE subject_Id = '$subjectId'";
    
    if ($connect->query($sql) === TRUE) {
        // Redirect to the page after successful delete
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $connect->error;
    }
} else {
    // Handle case when branch_Id is not provided
    echo "Branch ID not provided.";
}
// Close the database connection
$connect->close();
?>