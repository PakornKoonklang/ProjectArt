<?php
include "../../Connent/connent.php";

// Start output buffering
ob_start();

if (isset($_GET['subjectvcc_id'])) {
    // ตรวจสอบและกำหนดค่าตัวแปร
    $id = $_GET['subjectvcc_id'];

    // Prepare the SQL statement to delete the record
    $stmt = $connect->prepare("DELETE FROM subjectvcc WHERE subjectvcc_id = ?");

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("i", $id); // Use "i" for integer

        if ($stmt->execute()) {
            // Prepare and execute the re-sequencing SQL
            $resequenceSql = "
                SET @i = 0;
                UPDATE subjectvcc
                SET subjectvcc_id = (@i := @i + 1)
                ORDER BY subjectvcc_id;
            ";

            if ($connect->multi_query($resequenceSql)) {
                // Check if the multi_query executed successfully
                do {
                    // Store result if available
                    if ($result = $connect->store_result()) {
                        $result->free();
                    }
                } while ($connect->more_results() && $connect->next_result());

                // Redirect to the page after successful deletion and re-sequencing
                header("Location: ../Manage/manage_subjectvcc.php");
                exit();
            } else {
                echo "Error executing re-sequencing statement: " . $connect->error;
            }
        } else {
            echo "Error executing deletion statement: " . $stmt->error;
        }
    } else {
        echo "Error preparing deletion statement: " . $connect->error;
    }
} else {
    echo "No subjectvcc_id provided.";
}

// Close the database connection
$connect->close();

// End output buffering and flush the output
ob_end_flush();
?>
