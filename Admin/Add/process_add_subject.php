<?php
include "../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $subjectName = mysqli_real_escape_string($connect, $_POST['subjectName']);
 

    // Insert data into the database
    $sql = "INSERT INTO subjects (subject_Name) VALUES ('$subjectName')";
    
    if ($connect->query($sql) === TRUE) {
        // Redirect to the page after successful addition
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}

// Close the database connection
$connect->close();
?>