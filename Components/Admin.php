<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "datadast";

// Create connection
$conn = new  mysqli($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: ". $conn->connect_error);
}
//echo "Connected successfully";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body><br>

<!-- <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>

<select class="form-select form-select-sm" aria-label=".form-select-sm example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select> -->

    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <a href="../home/show_admin.php" class="btn btn-danger">แก้ไขข้อมูลผู้ดูแลระบบ</a>
        <a href="../home/show_attention.php" class="btn btn-info">แก้ไขขูอมูลความสนใจ</a>
        <a href="../home/show_subject.php" class="btn btn-warning">แก้ไขข้อมูลรายวิชา</a>
        <a href="../home/show_branches.php" class="btn btn-success">แก้ไขขูอมูลสาขา</a>
    </div>
  
 
</body>
<script src="https://kit.fontawesome.com/c233baf144.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>