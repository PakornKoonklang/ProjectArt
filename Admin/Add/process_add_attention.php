<?php
include "../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $attentionName = mysqli_real_escape_string($connect, $_POST['attentionName']);
 

    // Insert data into the database
    $sql = "INSERT INTO attention (attention_Name) VALUES ('$attentionName')";
    
    if ($connect->query($sql) === TRUE) {
        // Redirect to the page after successful addition
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}

// Close the database connection
$connect->close();
?>