<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $id = isset($_POST['subjectvc_id']) ? $_POST['subjectvc_id'] : '';
    $subjectVCname = isset($_POST['subjectVC_name']) ? $_POST['subjectVC_name'] : '';

    // Update data in the database using Prepared Statements
    $stmt = $connect->prepare("UPDATE subjectvc SET subjectVC_name=? WHERE subjectvc_id=?");

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("si", $subjectVCname, $id); // Use "si" for string, integer

        if ($stmt->execute()) {
            // Redirect to the page after successful update
            header("Location: ../Manage/manage_subjectvc.php");
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
