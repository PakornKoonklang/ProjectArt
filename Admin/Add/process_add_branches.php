<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบและกำหนดค่าตัวแปร
    $branches_Name = isset($_POST['branches_Name']) ? $_POST['branches_Name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    // เช็คค่าที่ส่งมาจากฟอร์ม
    if ($branches_Name != '' && $description != '') {
        // ตั้งค่าคำสั่ง SQL สำหรับ INSERT
        $sql = "INSERT INTO branches (branches_Name, description) VALUES ('$branches_Name', '$description')";

        // ทำการ query และตรวจสอบผลลัพธ์
        if ($connect->query($sql) === TRUE) {
            // Redirect หลังจาก INSERT สำเร็จ
            header("Location: ../Manage/manage_branches.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    } else {
        echo "กรุณากรอกข้อมูลให้ครบทุกช่อง";
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$connect->close();
?>
