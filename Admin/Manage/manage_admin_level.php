<?php
include "../../Connent/connent.php"; // Connect to the database

$results_per_page = 19;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$this_page_first_result = ($page - 1) * $results_per_page;

// SQL query to fetch data for the current page
$sql = "SELECT * FROM admin_level LIMIT $results_per_page OFFSET $this_page_first_result";
$result = $connect->query($sql);
$number_of_results = $result->num_rows;
$number_of_pages = ceil($number_of_results / $results_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management System</title>
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
            <!-- Main content -->
            <div class="content">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">จัดการสถานะ</h1>
                        </div>
                    </div>
                </div>
            </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <form method="post" class="form-inline">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search name" name="search_value">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit" name="submit"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        <a href='../Add/add_admin_level.php' class='btn btn-success'><i class="fas fa-plus"></i> Add New</a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Status Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?php echo $row['admin_level_id'] ?></td>
                                                    <td><?php echo $row['admin_level_name'] ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href='../Edit/edit_admin_level.php?admin_level_id=<?php echo $row['admin_level_id']; ?>' class='btn btn-warning'><i class="fas fa-edit"></i></a>
                                                            <a href='../Delete/process_delete_admin_level.php?admin_level_id=<?php echo $row['admin_level_id']; ?>' class='btn btn-danger' onclick="return confirm('Are you sure you want to delete this item?')"><i class="fas fa-trash"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
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
</body>

</html>
