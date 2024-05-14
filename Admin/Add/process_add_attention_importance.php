<?php
include "../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $attentionAdder = mysqli_real_escape_string($connect, $_POST['attentionAdder']);
 

    // Insert data into the database
    $sql = "INSERT INTO  branches_attention (attention_Adder) VALUES ('$attentionAdder')";
    
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