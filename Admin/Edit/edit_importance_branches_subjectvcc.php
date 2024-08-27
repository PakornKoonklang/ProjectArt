<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขความสำคัญของวิชา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous">
</head>

<body>
<?php
    include "../../Connent/connent.php"; // เชื่อมต่อฐานข้อมูล

    // ตรวจสอบว่ามีการส่ง id มาหรือไม่
    if (isset($_GET['id'])) {
        $Id = $_GET['id'];

        // ดึงข้อมูลสาขาจากฐานข้อมูล
        $sql = "SELECT b.*, br.branches_Name, s.subjectVCC_name 
                FROM branches_subjectvcc AS b 
                INNER JOIN branches AS br ON b.branches_Id = br.branches_Id 
                INNER JOIN subjectvcc AS s ON b.subjectvcc_id = s.subjectvcc_id 
                WHERE b.id = '$Id'";
        $result = $connect->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            // ถ้าไม่พบข้อมูลสาขา
            echo "<div class='alert alert-danger' role='alert'>ข้อมูลไม่พบ.</div>";
            exit();
        }
    } else {
        // ถ้าไม่ได้รับ id
        echo "<div class='alert alert-danger' role='alert'>ID ไม่ได้ถูกส่งมา.</div>";
        exit();
    }
?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-primary mb-4">แก้ไขความสำคัญของวิชา</h2>
                <form action="../Edit/process_edit_importance_branches_subjectvcc.php" method="post">
                    <!-- Hidden input เพื่อส่ง id ไปยังหน้า process_edit_importance_branches_subjectvcc.php -->
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

                    <div class="mb-3">
                        <label for="branches_Name" class="form-label">ชื่อสาขา</label>
                        <input type="text" class="form-control" id="branches_Name" name="branches_Name" value="<?php echo htmlspecialchars($row['branches_Name']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="subjectVCC_name" class="form-label">ชื่อวิชา</label>
                        <input type="text" class="form-control" id="subjectVCC_name" name="subjectVCC_name" value="<?php echo htmlspecialchars($row['subjectVCC_name']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="subject_Multiplier" class="form-label">ความสำคัญ</label>
                        <input type="text" class="form-control" id="subject_Multiplier" name="subject_Multiplier" value="<?php echo htmlspecialchars($row['subject_Multiplier']); ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                    <a href="../Manage/manage_importance_subjectvcc.php" class="btn btn-secondary">ยกเลิก</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlCOv7/7bWUZ3K6QMcpCp8VP9dPj8aIu6EGx7axQj0Z+JO0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGkt1ek3xMGdE2m0FSCNND8w7Tx42pZ5LrYpVv1tgATm7SJmXkzWvKSlvZp" crossorigin="anonymous"></script>
</body>
</html>
