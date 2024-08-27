<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($row['branches_Name']) ? htmlspecialchars($row['branches_Name']) : 'Branch Information'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            /* background-image: url('img_branch/2023-09-19.jpg'); */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .custom-heading {
            color: black;
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            text-align: center;  
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            
        }
        .description {
            font-family: 'Arial', sans-serif;
            text-align: justify; /* จัดเรียงข้อความให้เรียบเนียน */
           
            font-size: 20px;
            line-height: 1.8;
            color: #333;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(249, 249, 249, 0.8);
            border: 2px solid #ddd;
            border-radius: 5px;
            margin: 500px;
            margin-top: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* เพิ่มเงาให้กับกล่องเพื่อให้ดูมีมิติ */
            letter-spacing: 0.2px; /* เพิ่มระยะห่างระหว่างตัวอักษรเล็กน้อย */
            
        }
    </style>
</head>
<body>
    <?php
    include('../Components/Navbar.php');
    include('../Connent/connent.php');

    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // ตรวจสอบว่ามีการส่ง branchID มาหรือไม่
    if (isset($_GET['branchID'])) {
        $branchID = $_GET['branchID'];

        // ป้องกัน SQL Injection
        $branchID = $connect->real_escape_string($branchID);

        // ดึงข้อมูลสาขาจากฐานข้อมูล
        $sql = "SELECT * FROM branches WHERE branches_Id = '$branchID'";
        $result = $connect->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Branch with ID '$branchID' not found.</div>";
            exit();
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Branch ID not provided.</div>";
        exit();
    }
    ?>
    <div>
        <h1 class="custom-heading"><?php echo htmlspecialchars($row['branches_Name']); ?></h1>
        <p class="description"><?php echo htmlspecialchars($row['description']); ?></p>
        <!-- <a href="javascript:history.back()" class="btn btn-primary back-button">ย้อนกลับ</a> -->
    </div>

    <script src="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
