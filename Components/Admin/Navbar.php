<?php
// Start the session if it hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ตรวจสอบว่า session มีข้อมูลหรือไม่
if (!isset($_SESSION['user_data']) || empty($_SESSION['user_data'])) {
    // ถ้าไม่มี session หรือ session ว่างเปล่า ให้ redirect ไปที่หน้า Login
    header("Location: ../Login/login.php");
    exit();
}

// ตอนนี้ session มีข้อมูล สามารถใช้ได้ตามต้องการ
$user_data = $_SESSION['user_data'];
$admin_Firstname = isset($user_data['admin_Firstname']) ? $user_data['admin_Firstname'] : 'Unknown';
$admin_Lastname = isset($user_data['admin_Lastname']) ? $user_data['admin_Lastname'] : 'User';
$admin_level_Name = isset($user_data['admin_level_Name']) ? $user_data['admin_level_Name'] : 'N/A';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Admin LTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #fff; /* สีตัวอักษรของชื่อแบรนด์ */
        }

        .main-header {
            background-color: #343a40; /* สีพื้นหลังของ header */
        }

        .nav-item .navbar-text {
            color: #fff; /* สีตัวอักษรของข้อมูลผู้ใช้ */
        }

        .btn-outline-danger {
            color: #fff; /* สีตัวอักษรของปุ่ม logout */
            border-color: #ffc107; /* สีขอบของปุ่ม logout */
        }

        .btn-outline-danger:hover {
            background-color: #ffc107; /* สีพื้นหลังของปุ่ม logout เมื่อ hover */
            border-color: #ffc107;
        }

        .sidebar-dark-primary .nav-sidebar .nav-link {
            color: #fff; /* สีตัวอักษรของเมนู */
        }

        .sidebar-dark-primary .nav-sidebar .nav-link.active,
        .sidebar-dark-primary .nav-sidebar .menu-open > .nav-link {
            background-color: #343a40; /* สีพื้นหลังของเมนูเมื่อ active */
        }

        .sidebar-dark-primary .nav-sidebar .nav-treeview > .nav-item > .nav-link.active {
            background-color: #0062cc; /* สีพื้นหลังของเมนูย่อยเมื่อ active */
            color: #fff;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <a class="navbar-brand" href="#">Welcome To <?php echo htmlspecialchars($admin_level_Name); ?></a>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- User Info -->
            <li class="nav-item">
                <span class="navbar-text">
                    <b>Logged in as:</b> <?php echo htmlspecialchars($admin_Firstname . ' ' . $admin_Lastname); ?>
                </span>
            </li>
            <!-- Logout Button -->
            <li class="nav-item">
                <a class="btn btn-outline-danger ms-2" href="../../Login/login.php">Logout</a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar, content และองค์ประกอบอื่น ๆ ที่ต้องการตกแต่ง -->
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<!-- Admin LTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>
</html>