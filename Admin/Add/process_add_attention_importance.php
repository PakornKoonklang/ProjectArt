<?php
include "../../Connent/connent.php";

// ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบการส่งข้อมูลที่จำเป็น
    if (isset($_POST['branches_name']) && isset($_POST['attention_name']) && isset($_POST['attention_Adder'])) {
        $branchesName = $_POST['branches_name'];
        $attentionName = $_POST['attention_name'];
        $attentionAdder = $_POST['attention_Adder'];

        // ตรวจสอบว่าค่าที่ได้รับถูกต้องและป้องกันการโจมตี SQL Injection
        if (!empty($branchesName) && !empty($attentionName) && is_numeric($attentionAdder)) {
            // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูล
            $stmt = $connect->prepare("
                INSERT INTO branches_attention (branch_Id, attention_Id, attention_Adder)
                SELECT b.branches_Id, a.attention_Id, ?
                FROM branches AS b
                JOIN attention AS a
                ON b.branches_Name = ? AND a.attention_name = ?
            ");
            
            // ตรวจสอบว่า prepare คำสั่ง SQL สำเร็จหรือไม่
            if ($stmt) {
                $stmt->bind_param("iss", $attentionAdder, $branchesName, $attentionName);
                
                // ดำเนินการเพิ่มข้อมูลและตรวจสอบผลลัพธ์
                if ($stmt->execute()) {
                    // เปลี่ยนเส้นทางไปยังหน้า Manage_attention_importance.php
                    header("Location: ../Manage/Manage_attention_importance.php");
                    exit();
                } else {
                    echo "Error executing statement: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error preparing statement: " . $connect->error;
            }
        } else {
            echo "Invalid input. Ensure all fields are filled out correctly.";
        }
    } else {
        echo "Required data not provided.";
    }
} else {
    echo "Invalid request method.";
}

// ปิดการเชื่อมต่อฐานข้อมูล
$connect->close();
?>
