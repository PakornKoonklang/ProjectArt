<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $attentionId = isset($_POST['attentionId']) ? $_POST['attentionId'] : '';
    $attentionName = isset($_POST['attention_name']) ? $_POST['attention_name'] : '';

    // Update data in the database using Prepared Statements
    $stmt = $connect->prepare("UPDATE attention SET attention_name=? WHERE attention_Id=?");

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("si", $attentionName, $attentionId); // Use "si" for string, integer

        if ($stmt->execute()) {
            // Redirect to the page after successful update
            header("Location: ../Manage/manage_attention.php");
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
