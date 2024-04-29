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
$admin_level_Id = $user_data['admin_level_Id']
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Welcome To <?php echo $admin_level_Id  ?> </a>
        <form class="d-flex">
            <span class="navbar-text me-3"><b>Logged in as:</b>
                <?php echo $admin_Firstname . ' ' . $admin_Lastname; ?></span>
            <button class="btn btn-outline-info" type="submit">เเก้ไขโปรไฟล์</button>&nbsp;
            <button class="btn btn-outline-danger" type="submit">Logout</button>
        </form>
    </div>
    </div>
</nav>