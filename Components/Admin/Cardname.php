<?php
session_start();

// ตรวจสอบว่า session มีข้อมูลหรือไม่
if (!isset($_SESSION['user_data']) || empty($_SESSION['user_data'])) {
    // ถ้าไม่มี session หรือ session ว่างเปล่า ให้ redirect ไปที่หน้า Login
    header("Location: ../Login/login.php");
    exit();
}

// ตอนนี้ session มีข้อมูล สามารถใช้ได้ตามต้องการ
$user_data = $_SESSION['user_data'];
$admin_Firstname = $user_data['admin_Firstname'];
$admin_Lastname = $user_data['admin_Lastname'];
?>
<div class="card bg-light mb-3">
    <div class="card-body">
        <p class="card-text"><strong>Logged in as:</strong> <?php echo $admin_Firstname . ' ' . $admin_Lastname; ?></p>
        <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
        <a href="logout.php" class="btn btn-danger">Logout</a> <!-- เพิ่มปุ่ม Logout นี้ -->
    </div>
</div>