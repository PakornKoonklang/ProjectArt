<?php
// เชื่อมต่อกับฐานข้อมูล
include "../Connent/connent.php";

session_start();

// รับข้อมูลจากฟอร์ม
$username = $_POST['username'];
$password = $_POST['password'];

// ตรวจสอบข้อมูลในฐานข้อมูล
$sql = "SELECT admin.*, al.admin_level_Id, al.admin_level_Name FROM admin 
        JOIN admin_level al ON admin.admin_level_Id = al.admin_level_Id 
        WHERE admin.admin_User='$username' AND admin.admin_Pass='$password'";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    // เข้าสู่ระบบสำเร็จ
    $row = $result->fetch_assoc();

    // ตรวจสอบสถานะของผู้ใช้
    $admin_level_Id = $row['admin_level_Id'];
    $admin_level_Name = $row['admin_level_Name'];

    $_SESSION['user_data'] = [
        'admin_Firstname' => $row['admin_Firstname'],
        'admin_Lastname' => $row['admin_Lastname'],
        'admin_level_Id' => $admin_level_Id,
        'admin_level_Name' => $admin_level_Name,
        // *เพิ่มข้อมูลอื่น ๆ ที่คุณต้องการ
    ];
    $_SESSION['admin_level_Id'] = $admin_level_Id;
    $_SESSION['admin_level_Name'] = $admin_level_Name;

    echo '<script>alert("Login successful! Welcome ' . $admin_level_Name . '."); window.location.href = "../Admin/Edit/admin_dashboard.php";</script>';
    exit();
} else {
    // *เข้าสู่ระบบไม่สำเร็จ
    echo '<script>alert("ล็อคอินผิดพลาด กรุณาตรวจสอบอีกครั้ง"); window.location.href = "Login.php";</script>';
    exit();
}

$connect->close();
?>
