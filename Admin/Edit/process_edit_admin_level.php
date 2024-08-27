<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $adminlevelid = isset($_POST['admin_level_id']) ? $_POST['admin_level_id'] : '';
    $adminlevelname = isset($_POST['admin_level_name']) ? $_POST['admin_level_name'] : '';

    // Update data in the database using Prepared Statements
    $stmt = $connect->prepare("UPDATE admin_level SET admin_level_name=? WHERE admin_level_id=?");

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("si", $adminlevelname, $adminlevelid); // Use "si" for string, integer

        if ($stmt->execute()) {
            // Redirect to the page after successful update
            header("Location: ../Manage/manage_admin_level.php");
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
