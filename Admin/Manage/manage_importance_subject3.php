<?php
include "../../Connent/connent.php";

$sql = "SELECT * FROM branches_subjects bs 
        JOIN branches b ON bs.branches_Id = b.branches_Id 
        JOIN subjects s ON bs.subject_Id = s.subject_Id 
        JOIN study_level sl ON bs.study_level_Id = sl.study_level_Id 
        WHERE bs.study_level_Id = 2";

// Check if search form submitted
if(isset($_POST['submit'])) {
    // Get search value from form input
    $search_value = $_POST['search_value'];
    // Add WHERE condition to search by branch name
    $sql .= " AND b.branches_Name LIKE '%$search_value%'";
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
                <h2 class="text-primary" id="welcomeMessage">กำหนดค่าความสำคัญของวิชาในเเต่ละสาขา ในระดับชั้น ปวช.</h2>
                <div class="row">
                    <div class="col-sm-8">
                        <form method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="ค้นหาสาขา" name="search_value">
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
                            <th scope="col">ชื่อสาขา</th>
                            <th scope="col">ชื่อรายวิชา</th>
                            <th scope="col">ระดับชั้น</th>
                            <th scope="col">ความสำคัญ</th>
                            <th scope="col">จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['branches_Name'] ?></td>
                            <td><?php echo $row['subject_name'] ?></td>
                            <td><?php echo $row['study_level_name'] ?></td>
                            <td><?php echo $row['subject_Multiplier'] ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href='edit_branches.php?id=<?php echo $row['id']; ?>'
                                        class='btn btn-warning mx-1'><i class="fa-solid fa-file-pen"></i></a>
                                    <a href='process_delete_branches.php?id=<?php echo $row['id']; ?>'
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