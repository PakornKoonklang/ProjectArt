<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $attentionName = mysqli_real_escape_string($connect, $_POST['attention_name']);
 

    // Insert data into the database
    $sql = "INSERT INTO attention (attention_name) VALUES ('$attentionName')";
    
    if ($connect->query($sql) === TRUE) {
        // Redirect to the page after successful addition
        header("Location: ../Manage/manage_attention.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}

// Close the database connection
$connect->close();
?>