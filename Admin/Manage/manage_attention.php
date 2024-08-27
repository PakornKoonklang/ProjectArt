<?php
include "../../Connent/connent.php"; // Connect to the database

$results_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$this_page_first_result = ($page - 1) * $results_per_page;

$sql = "SELECT * FROM attention LIMIT $results_per_page OFFSET $this_page_first_result";
$result = $connect->query($sql);

$number_of_results = $connect->query("SELECT COUNT(*) AS total FROM attention")->fetch_assoc()['total'];
$number_of_pages = ceil($number_of_results / $results_per_page);
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
                            <h1 class="m-0 text-dark">จัดการรายชื่อด้านความสนใจ</h1>
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
                                <div class="card-header">
                                    <a href='../Add/add_attention.php' class='btn btn-success'><i class="fas fa-plus"></i> เพิ่มรายชื่อด้านความสนใจ</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>รหัสความสนใจ</th>
                                                <th>ชื่อด้านความสนใจ</th>
                                                <th>จัดการข้อมูล</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['attention_Id']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['attention_name']); ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href='../Edit/edit_attention.php?attention_Id=<?php echo $row['attention_Id']; ?>' class='btn btn-warning'><i class="fas fa-edit"></i></a>
                                                            <a href='../Delete/process_delete_attention.php?attention_Id=<?php echo $row['attention_Id']; ?>' class='btn btn-danger' onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่?')"><i class="fas fa-trash"></i></a>
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
                                            <?php for ($i = 1; $i <= $number_of_pages; $i++) { ?>
                                                <li class='page-item <?php echo ($i == $page) ? 'active' : ''; ?>'>
                                                    <a class='page-link' href='?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    <!-- Font Awesome Icons -->
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/js/all.min.js"></script>
</body>

</html>
