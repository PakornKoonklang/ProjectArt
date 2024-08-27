<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $id = isset($_POST['subjectvcc_id']) ? $_POST['subjectvcc_id'] : '';
    $subjectVCCname = isset($_POST['subjectVCC_name']) ? $_POST['subjectVCC_name'] : '';

    // Update data in the database using Prepared Statements
    $stmt = $connect->prepare("UPDATE subjectvcc SET subjectVCC_name=? WHERE subjectvcc_id=?");

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("si", $subjectVCCname, $id); // Use "si" for string, integer

        if ($stmt->execute()) {
            // Redirect to the page after successful update
            header("Location: ../Manage/manage_subjectvcc.php");
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
