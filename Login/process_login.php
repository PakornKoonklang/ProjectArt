<?php
// เชื่อมต่อกับฐานข้อมูล
include "../Connent/connent.php";

session_start();

// รับข้อมูลจากฟอร์ม
$username = $_POST['username'];
$password = $_POST['password'];

// ตรวจสอบข้อมูลในฐานข้อมูล
$sql = "SELECT * FROM admin WHERE admin_User='$username' AND admin_Pass='$password'";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    // เข้าสู่ระบบสำเร็จ
    $row = $result->fetch_assoc();

    // ตรวจสอบสถานะของผู้ใช้
    if ($row['admin_level_Id'] == '10') {
        $_SESSION['user_data'] = [
            'admin_Firstname' => $row['admin_Firstname'],
            'admin_Lastname' => $row['admin_Lastname'],
            'admin_level_Id' => $row['admin_level_Id'] = 'SupperAdmin',
            // *เพิ่มข้อมูลอื่น ๆ ที่คุณต้องการ
        ];
        $_SESSION['admin_level_Id'] = 'SupperAdmin';
        echo '<script>alert("Login successful! Welcome SupperAdmin."); window.location.href = "../Admin/Manage/admin_dashboard.php";</script>';
        exit();
    } elseif ($row['admin_level_Id'] == '11') {
        $_SESSION['user_data'] = [
            'admin_Firstname' => $row['admin_Firstname'],
            'admin_Lastname' => $row['admin_Lastname'],
            'admin_level_Id' => $row['admin_level_Id'] = 'Admin',
            // *เพิ่มข้อมูลอื่น ๆ ที่คุณต้องการ
        ];
        $_SESSION['admin_level_Id'] = 'Admin';
        echo '<script>alert("Login successful! Welcome Admin."); window.location.href = "../Admin/Manage/admin_dashboard.php";</script>';
        exit();
    }
} else {
    // *เข้าสู่ระบบไม่สำเร็จ
    echo '<script>alert("ล็อคอินผิดพลาด กรุณาตรวจสอบอีกครั้ง"); window.location.href = "Login.php";</script>';
    exit();
}

$connect->close();
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
