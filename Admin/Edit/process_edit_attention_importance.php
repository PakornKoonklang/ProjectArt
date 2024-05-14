<?php
include "../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $attentionId = isset($_POST['attentionId']) ? mysqli_real_escape_string($connect, $_POST['attentionId']) : '';
    $attentionAdder = isset($_POST['attentionAdder']) ? mysqli_real_escape_string($connect, $_POST['attentionAdder']) : '';

    // Update data in the database using Prepared Statements
    $stmt = $connect->prepare("UPDATE branches_attention SET attention_Adder=? WHERE attention_Id=?");

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("si", $attentionAdder, $attentionId); // Use "si" for string, integer

        if ($stmt->execute()) {
            // Redirect to the page after successful update
            header("Location: admin_dashboard.php");
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
