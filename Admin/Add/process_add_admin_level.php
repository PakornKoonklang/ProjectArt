<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $adminlevelname = mysqli_real_escape_string($connect, $_POST['admin_level_name']);
 

    // Insert data into the database
    $sql = "INSERT INTO admin_level (admin_level_name) VALUES ('$adminlevelname')";
    
    if ($connect->query($sql) === TRUE) {
        // Redirect to the page after successful addition
        header("Location: ../Manage/manage_admin_level.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}

// Close the database connection
$connect->close();
?>