<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $subjectM6id = isset($_POST['subjectM6_id']) ? $_POST['subjectM6_id'] : '';
    $subjectM6name = isset($_POST['subjectM6_name']) ? $_POST['subjectM6_name'] : '';

    // Update data in the database using Prepared Statements
    $stmt = $connect->prepare("UPDATE subjectm6 SET subjectM6_name=? WHERE subjectM6_id=?");

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("si", $subjectM6name, $subjectM6id); // Use "si" for string, integer

        if ($stmt->execute()) {
            // Redirect to the page after successful update
            header("Location: ../Manage/manage_subjectm6.php");
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $connect->error;
    }
}

// Close the database connection
$connect->close();
?>
