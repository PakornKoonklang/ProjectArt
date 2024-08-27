<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขความสนใจ</title>
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
        $sql = "SELECT b.*, br.branches_Name, s.subjectM6_name 
                FROM branches_subjectm6 AS b 
                INNER JOIN branches AS br ON b.branches_Id = br.branches_Id 
                INNER JOIN subjectm6 AS s ON b.subjectM6_id = s.subjectM6_id 
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
                <h2 class="text-primary mb-4">แก้ไขความสนใจ</h2>
                <form action="../Edit/process_edit_importance_branches_subjectm6.php" method="post">
                    <!-- Hidden input เพื่อส่ง id ไปยังหน้า process_edit_attention_importance.php -->
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

                    <div class="mb-3">
                        <label for="branches_Name" class="form-label">ชื่อสาขา</label>
                        <input type="text" class="form-control" id="branches_Name" name="branches_Name" value="<?php echo htmlspecialchars($row['branches_Name']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="subjectM6_name" class="form-label">ชื่อวิชา </label>
                        <input type="text" class="form-control" id="subjectM6_name" name="subjectM6_name" value="<?php echo htmlspecialchars($row['subjectM6_name']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="subject_Multiplier" class="form-label">ค่าความสนใจ</label>
                        <input type="number" class="form-control" id="subject_Multiplier" name="subject_Multiplier" value="<?php echo htmlspecialchars($row['subject_Multiplier']); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">อัพเดต</button>
                    <a href="../Manage/manage_importance_subjectm6.php" class="btn btn-secondary btn-block">กลับ</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua/CJ4Ll48p+Aaxj3UqI9q9I8+3N48Npx2iOaAR2yZ1P1mAvpddHx" crossorigin="anonymous"></script>
</body>
</html>
