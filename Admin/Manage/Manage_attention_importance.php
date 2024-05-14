<?php
 include "../../Connent/connent.php"; // เพิ่มเฉพาะส่วนนี้เมื่อต้องการเรียกใช้งาน $connect

$results_per_page = 10;
$sql = "SELECT * FROM branches_attention";
$result = $connect->query($sql);
$number_of_results = $result->num_rows;
$number_of_pages = ceil($number_of_results / $results_per_page);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$this_page_first_result = ($page - 1) * $results_per_page;
$sql .= " LIMIT $results_per_page OFFSET $this_page_first_result";
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

<body class="container" ;>
    <?php include "../../Components/Admin/Navbar.php"; ?>
    <br>
    <div class="row">
        <div class="col-3"><?php include "../../Components/Admin/Menubar.php"; ?></div>
        <div class="col-9">

            <body>
                <div class="col-md-9" id="contentContainer">
                    <h2 class="text-primary" id="welcomeMessage">จัดการค่าด้านความสนใจ</h2>
                    <button type="button" class="btn btn-success mb-3"
                        onclick="window.location.href='add_attention_importance.php';">เพิ่มค่าด้านความสนใจ</button>
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">รหัสความสนใจ</th>
                                
                                <th scope="col">ค่าความสำคัญ</th>
                                <th scope="col">จัดการข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    while ($row = $result->fetch_assoc()) {
                ?>
                            <tr>
                                <td><?php echo $row['attention_Id']; ?></td>
                                
                                <td><?php echo $row['attention_Adder'];?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href='edit_attention_importance?attention_Id=<?php echo $row['attention_Id']; ?>'
                                            class='btn btn-warning mx-1'>Edit</a>
                                        <a href='process_delete_attention_importance.php?attention_Id=<?php echo $row['attention_Id']; ?>'
                                            class='btn btn-danger'
                                            onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่?')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                    }
                ?>
                        </tbody>
                    </table>

                    <!-- แสดงปุ่มเลื่อนหน้า -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php
        for ($i = 1; $i <= $number_of_pages; $i++) {
            echo "<li class='page-item'><a class='page-link' href='javascript:void(0)' onclick='loadPage($i)'>$i</a></li>";
        }
        ?>
                        </ul>
                    </nav>
                </div>
            </body>
        </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/c233baf144.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
function loadPage(page) {
    window.location.href = "manage_attention.php?page=" + page;
}
</script>

</html>
