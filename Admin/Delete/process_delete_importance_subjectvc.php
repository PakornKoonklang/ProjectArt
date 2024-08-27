<?php
include "../../Connent/connent.php";

// Start output buffering
ob_start();

if (isset($_GET['id'])) {
    // ตรวจสอบและกำหนดค่าตัวแปร
    $id = $_GET['id'];

    // Prepare the SQL statement
    $stmt = $connect->prepare("DELETE FROM branches_subjectvc WHERE id = ?");

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("i", $id); // Use "i" for integer

        if ($stmt->execute()) {
            // Redirect to the page after successful deletion
            header("Location: ../Manage/manage_importance_subjectvc.php");
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $connect->error;
    }
} else {
    echo "No admin_Id provided.";
}

// Close the database connection
$connect->close();

// End output buffering and flush the output
ob_end_flush();
?>
