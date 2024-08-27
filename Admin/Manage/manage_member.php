<?php
include "../../Connent/connent.php"; // เชื่อมต่อฐานข้อมูล

$results_per_page = 10; // จำนวนผลลัพธ์ที่จะแสดงต่อหน้า
if (isset($_GET['page'])) {
    $page = $_GET['page']; // ตรวจสอบหน้าปัจจุบันจากตัวแปร GET
} else {
    $page = 1; // ถ้าไม่มีตัวแปร GET ให้แสดงหน้าที่ 1
}
$this_page_first_result = ($page - 1) * $results_per_page; // คำนวณผลลัพธ์แรกของหน้าปัจจุบัน

// SQL query เพื่อดึงข้อมูลจากตาราง admin และ admin_level ที่มี admin_level_Id เท่ากับ 10 หรือ 11
$sql = "SELECT * FROM admin JOIN admin_level ON admin.admin_level_Id = admin_level.admin_level_Id WHERE admin_level.admin_level_Id BETWEEN 10 AND 1016 LIMIT $results_per_page OFFSET $this_page_first_result";

$result = $connect->query($sql);
$number_of_results = $result->num_rows; // นับจำนวนผลลัพธ์ที่ได้
$number_of_pages = ceil($number_of_results / $results_per_page); // คำนวณจำนวนหน้าทั้งหมด
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
                            <h1 class="m-0 text-dark">จัดการรายชื่อสมาชิก</h1>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-end">
                                <form method="post" class="form-inline me-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="ค้นหาชื่อ" name="search_value">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <a href='../Add/add_member.php' class='btn btn-success'><i class="fas fa-plus"></i> เพิ่ม</a>
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
                                                <th scope="col">รหัสสมาชิก</th>
                                                <th scope="col">ชื่อจริง</th>
                                                <th scope="col">นามสกุล</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Password</th>
                                                <th scope="col">เบอร์โทร</th>
                                                <th scope="col">E-mail</th>
                                                <th scope="col">รหัสสถานะ</th>
                                                <th scope="col">สถานะ</th>
                                                <th scope="col">จัดการข้อมูล</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?php echo $row['admin_Id'] ?></td>
                                                    <td><?php echo $row['admin_Firstname'] ?></td>
                                                    <td><?php echo $row['admin_Lastname'] ?></td>
                                                    <td><?php echo $row['admin_User'] ?></td>
                                                    <td><?php echo $row['admin_Pass'] ?></td>
                                                    <td><?php echo $row['admin_Phone'] ?></td>
                                                    <td><?php echo $row['admin_Email'] ?></td>
                                                    <td><?php echo $row['admin_level_Id'] ?></td>
                                                    <td><?php echo $row['admin_level_name'] ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href='../Edit/edit_member.php?admin_Id=<?php echo $row['admin_Id']; ?>' class='btn btn-warning mx-1'><i class="fas fa-edit"></i></a>
                                                            <a href='../Delete/process_delete_member.php?admin_Id=<?php echo $row['admin_Id']; ?>' class='btn btn-danger' onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่?')"><i class="fas fa-trash"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <!-- Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <?php if ($page > 1) { ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php for ($i = 1; $i <= $number_of_pages; $i++) { ?>
                                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($page < $number_of_pages) { ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
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
