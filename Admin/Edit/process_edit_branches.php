<?php
include "../../Connent/connent.php"; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $branchId = isset($_POST['branchId']) ? mysqli_real_escape_string($connect, $_POST['branchId']) : '';
    $branchName = isset($_POST['branchName']) ? mysqli_real_escape_string($connect, $_POST['branchName']) : '';
    $description = isset($_POST['description']) ? mysqli_real_escape_string($connect, $_POST['description']) : '';

    // Update data in the database using Prepared Statements
    $stmt = $connect->prepare("UPDATE branches SET branches_Name=?, description=? WHERE branches_Id=?");
    $stmt->bind_param("ssi", $branchName, $description, $branchId);
    
    if ($stmt->execute()) {
        // Redirect to the page after successful update
        header("Location: ../Manage/manage_branches.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close the database connection
$connect->close();
?>
