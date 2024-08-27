<?php
include "../../Connent/connent.php";

// Start output buffering
ob_start();

if (isset($_GET['branches_Id'])) {
    // ตรวจสอบและกำหนดค่าตัวแปร
    $branchesId = $_GET['branches_Id'];

    // เริ่มต้นการเชื่อมต่อฐานข้อมูลและตรวจสอบความสำเร็จ
    $connect->autocommit(FALSE);

    try {
        // Prepare the SQL statement to delete from branches_attention
        $stmt1 = $connect->prepare("DELETE FROM branches_attention WHERE branch_Id = ?");
        if (!$stmt1) {
            throw new Exception("Error preparing statement 1: " . $connect->error);
        }

        // Bind parameters and execute the statement
        $stmt1->bind_param("i", $branchesId);
        if (!$stmt1->execute()) {
            throw new Exception("Error executing statement 1: " . $stmt1->error);
        }

        // Prepare the SQL statement to delete from branches
        $stmt2 = $connect->prepare("DELETE FROM branches WHERE branches_Id = ?");
        if (!$stmt2) {
            throw new Exception("Error preparing statement 2: " . $connect->error);
        }

        // Bind parameters and execute the statement
        $stmt2->bind_param("i", $branchesId);
        if (!$stmt2->execute()) {
            throw new Exception("Error executing statement 2: " . $stmt2->error);
        }

        // Commit the transaction
        $connect->commit();

        // Redirect to the page after successful deletion
        header("Location: ../Manage/manage_branches.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $connect->rollback();
        echo $e->getMessage();
    }

    // Close the statements
    $stmt1->close();
    $stmt2->close();
} else {
    echo "No branches_Id provided.";
}

// Close the database connection
$connect->close();

// End output buffering and flush the output
ob_end_flush();
?>
