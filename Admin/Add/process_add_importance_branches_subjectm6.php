<?php
// Include connection file
include "../../Connent/connent.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $branches_name = $_POST['branches_name'];
    $subjectM6_name = $_POST['subjectM6_name'];
    $subject_Multiplier = $_POST['subject_Multiplier'];

    // Validate form data (optional but recommended)
    if (!empty($branches_name) && !empty($subjectM6_name) && !empty($subject_Multiplier)) {
        // Retrieve the current highest ID (or another suitable column for ordering)
        $result = $connect->query("SELECT MAX(id) AS max_id FROM branches_subjectm6");
        if ($result) {
            $row = $result->fetch_assoc();
            $max_id = $row['max_id'];
            $new_id = $max_id + 1;

            // Prepare and bind
            $stmt = $connect->prepare("
            INSERT INTO branches_subjectm6 (branches_Id, subjectM6_id, subject_Multiplier, id)
            SELECT b.branches_Id, s.subjectM6_id, ?, ?
            FROM branches AS b
            JOIN subjectm6 AS s
            ON b.branches_Name = ? AND s.subjectM6_name = ?
            ");

            // ตรวจสอบว่า prepare คำสั่ง SQL สำเร็จหรือไม่
            if ($stmt) {
                $stmt->bind_param("iiss", $subject_Multiplier, $new_id, $branches_name, $subjectM6_name);

                // ดำเนินการเพิ่มข้อมูลและตรวจสอบผลลัพธ์
                if ($stmt->execute()) {
                    // เปลี่ยนเส้นทางไปยังหน้า Manage_attention_importance.php
                    header("Location: ../Manage/manage_importance_subjectm6.php");
                    exit();
                } else {
                    echo "Error executing statement: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error preparing statement: " . $connect->error;
            }
        } else {
            echo "Error retrieving current highest ID: " . $connect->error;
        }
    }
}

// Close the connection
$connect->close();
?>
