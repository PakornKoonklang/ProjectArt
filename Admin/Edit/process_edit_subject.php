<?php
include "../../Connent/connent.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $subjectMultiplier = $_POST['subjectMultiplier'];

    // อัพเดตค่าความสำคัญในตาราง branches_subjects
    $sql_update = "UPDATE branches_subjects SET subject_Multiplier = ? WHERE id = ?";
    $stmt_update = $connect->prepare($sql_update);
    $stmt_update->bind_param("ii", $subjectMultiplier, $id);

    if ($stmt_update->execute()) {
        header("Location: ../Admin/admin_dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . $connect->error;
    }
} else {
    echo "Invalid request method.";
}
?>
