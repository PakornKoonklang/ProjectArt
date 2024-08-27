<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['attention_Id'])) {
    // Validate and sanitize input data
    $attentionId = mysqli_real_escape_string($connect, $_GET['attention_Id']);

    // Start a transaction
    $connect->begin_transaction();

    try {
        // Delete data from child table if necessary (adjust table name and column name as per your database structure)
        $sql_child = "DELETE FROM branches_attention WHERE attention_Id = '$attentionId'";
        $connect->query($sql_child);

        // Check for any error
        if ($connect->error) {
            throw new Exception($connect->error);
        }

        // Delete data from the main table
        $sql_main = "DELETE FROM attention WHERE attention_Id = '$attentionId'";
        $connect->query($sql_main);

        // Check for any error
        if ($connect->error) {
            throw new Exception($connect->error);
        }

        // Commit the transaction
        $connect->commit();

        // Redirect to the page after successful delete
        header("Location: ../Manage/manage_attention.php");
        exit();
    } catch (Exception $exception) {
        // Rollback the transaction if any error occurs
        $connect->rollback();
        echo "Error: " . $exception->getMessage();
    }
} else {
    // Handle case when attention_Id is not provided
    echo "Attention ID not provided.";
}

// Close the database connection
$connect->close();
?>
