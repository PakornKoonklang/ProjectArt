<?php
include('../Components/Navbar.php');
include('../Connent/connent.php'); // ตรวจสอบเส้นทางและชื่อไฟล์ให้ถูกต้อง

// Query to fetch branch information from the database
$query = "SELECT branches_Id, branches_Name FROM branches";
$result = mysqli_query($connect, $query); // เปลี่ยนจาก $conn เป็น $connect

if (!$result) {
    die('Query failed: ' . mysqli_error($connect)); // เปลี่ยนจาก $conn เป็น $connect
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>
    body {
        background-image: url('img_branch/1.jpg');
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat; 
    }
    .list-group-item {
        background-color: rgba(255, 255, 255, 0.5); 
    }
    .list-group-item a:hover {
        background-color: #F2BE3D;
        text-decoration: underline; 
    }
</style>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">สาขาทั้งหมด</h1>
        <ul class="list-group">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <li class="list-group-item">
                    <a class="dropdown-item" href="branch_information.php?branchID=<?php echo $row['branches_Id']; ?>">
                        <?php echo $row['branches_Name']; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div><br><br>

    <script src="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($connect); // เปลี่ยนจาก $conn เป็น $connect
?>
