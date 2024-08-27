<?php
include "../../Connent/connent.php"; // เชื่อมต่อกับฐานข้อมูล
session_start(); // เริ่มต้น session เพื่อดึงข้อมูล

// ตรวจสอบระดับของ Admin
$admin_level_id = isset($_SESSION['admin_level_Id']) ? (int)$_SESSION['admin_level_Id'] : 0;

$results_per_page = 25;

// คำนวณหน้าปัจจุบัน
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$this_page_first_result = ($page - 1) * $results_per_page;

// ตรวจสอบสิทธิ์ของ Admin และดึงข้อมูลตามสิทธิ์
$sql = "SELECT b.*, br.branches_Name, s.subjectM6_name
        FROM branches_subjectm6 AS b 
        INNER JOIN branches AS br ON b.branches_Id = br.branches_Id
        INNER JOIN subjectm6 AS s ON b.subjectM6_id = s.subjectM6_id";

// กรองข้อมูลตามสาขาของแอดมิน
if ($admin_level_id != 10) {
    // แอดมินทั่วไป: ดึงข้อมูลเฉพาะสาขาของแอดมิน
    $sql .= " WHERE br.branches_Id = $admin_level_id";
}

// เพิ่มเงื่อนไขการค้นหา
if (isset($_POST['submit'])) {
    $search_value = $connect->real_escape_string($_POST['search_value']);
    $sql .= " AND br.branches_Name LIKE '%$search_value%'";
}

// เพิ่ม LIMIT และ OFFSET
$sql .= " LIMIT $results_per_page OFFSET $this_page_first_result";

$result = $connect->query($sql);

// คำนวณจำนวนข้อมูลทั้งหมดและหน้าทั้งหมด
$count_sql = $sql; // ใช้ SQL เดียวกับการดึงข้อมูล แต่ไม่ใช้ LIMIT
$count_result = $connect->query($count_sql);
$total_row = $count_result->num_rows;
$total_pages = ceil($total_row / $results_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบแนะนำในการเข้าศึกษาต่อในคณะวิศวกรรมศาสตร์และเทคโนโลยี</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include "../../Components/Admin/Navbar.php"; ?>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <?php include "../../Components/Admin/Menubar.php"; ?>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">กำหนดค่าความสำคัญของวิชาในเเต่ละสาขา ในระดับชั้น ม.6</h1>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-end">
                                <form method="post" class="form-inline">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="ค้นหาสาขา" name="search_value">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <?php if ($admin_level_id == 10) { ?>
                                    <a href='../Add/add_importance_branches_subjectm6.php' class='btn btn-success ml-3'><i class="fas fa-plus"></i> เพิ่ม</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>รหัส</th>
                                                <th>ชื่อสาขา</th>
                                                <th>ชื่อรายวิชา</th>
                                                <th>ความสำคัญ</th>
                                                <th>จัดการข้อมูล</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['branches_Name']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['subjectM6_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['subject_Multiplier']); ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <?php if ($admin_level_id == 10 || $row['branches_Id'] == $admin_level_id) { ?>
                                                                <a href='../Edit/edit_importance_branches_subjectm6.php?id=<?php echo $row['id']; ?>' class='btn btn-warning mx-1'><i class="fas fa-edit"></i></a>
                                                                <a href='../Delete/process_delete_importance_subjectm6.php?id=<?php echo $row['id']; ?>' class='btn btn-danger' onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่?')"><i class="fas fa-trash"></i></a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <!-- Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-center">
                                            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                                <li class='page-item <?php echo ($i == $page) ? 'active' : ''; ?>'>
                                                    <a class='page-link' href='?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /.wrapper -->

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    <!-- Font Awesome Icons -->
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/js/all.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
