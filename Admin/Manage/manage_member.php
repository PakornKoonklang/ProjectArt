<?php
include "../../Connent/connent.php";

$sql = "SELECT * FROM admin WHERE admin_level_Id = 11";

// Check if search form submitted
if(isset($_POST['submit'])) {
    // Get search value from form input
    $search_value = $_POST['search_value'];
    // Add WHERE condition to search by branch name
    $sql .= " AND admin_Firstname LIKE '%$search_value%'";
}

$result = $connect->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบแนะนำในการเข้าศึกษาต่อในคณะวิศวกรรมศาสตร์และเทคโนโลยี</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="container">
    <?php include "../../Components/Admin/Navbar.php"; ?>
    <br>
    <div class="row">
        <div class="col-3"><?php include "../../Components/Admin/Menubar.php"; ?></div>
        <div class="col-9">
            <div class="col-md-9" id="contentContainer">
                <h2 class="text-primary" id="welcomeMessage">จัดการรายชื่อสมาชิก</h2>
                <div class="row">
                    <div class="col-sm-8">
                        <form method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="ค้นหาชื่อ" name="search_value">
                                <button class="btn btn-outline-secondary" type="submit" name="submit"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4"><button type="button" class="btn btn-success mb-3"
                            onclick="window.location.href='add_branches.php';"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">รหัสสมาชิก</th>
                            <th scope="col">ชื่อจริง</th>
                            <th scope="col">นามสกุล</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">เบอร์โทร</th>
                            <th scope="col">E-mail</th>
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
                            <td><?php echo $row['admin_Eamil'] ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href='edit_branches.php?admin_Id=<?php echo $row['admin_Id']; ?>'
                                        class='btn btn-warning mx-1'><i class="fa-solid fa-file-pen"></i></a>
                                    <a href='process_delete_branches.php?admin_Id=<?php echo $row['admin_Id']; ?>'
                                        class='btn btn-danger' onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่?')"><i
                                            class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/c233baf144.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
