<?php
include "../../Connent/connent.php";

// ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบการส่งข้อมูลที่จำเป็น
    if (isset($_POST['id']) && isset($_POST['attention_Adder'])) {
        $id = $_POST['id'];
        $attentionAdder = $_POST['attention_Adder'];

        // ตรวจสอบว่า id และ attention_Adder เป็นตัวเลขหรือไม่
        if (is_numeric($id) && is_numeric($attentionAdder)) {
            // เตรียมคำสั่ง SQL สำหรับการอัพเดต
            $stmt = $connect->prepare("UPDATE branches_attention SET attention_Adder = ? WHERE attention_Id = ?");
            
            // ตรวจสอบว่า prepare คำสั่ง SQL สำเร็จหรือไม่
            if ($stmt) {
                $stmt->bind_param("ii", $attentionAdder, $id);
                
                // ดำเนินการอัพเดตและตรวจสอบผลลัพธ์
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
            echo "Invalid input. ID and Attention Adder must be numeric.";
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
