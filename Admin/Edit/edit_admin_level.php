<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เเก้ไขความสนใจ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous">
</head>

<body>
    <?php include "../../Connent/connent.php"; ?>

    <?php
    // ตรวจสอบว่ามีการส่ง admin_level_id มาหรือไม่
    if (isset($_GET['admin_level_id'])) {
        $attentionId = $_GET['admin_level_id'];

        // ดึงข้อมูลสาขาจากฐานข้อมูล
        $sql = "SELECT * FROM admin_level WHERE admin_level_id = $attentionId";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            // ถ้าไม่พบข้อมูลสาขา
            echo "Branch not found.";
            exit();
        }
    } else {
        // ถ้าไม่ได้รับ admin_level_id
        echo "Branch ID not provided.";
        exit();
    }
    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-primary mb-4">เเก้ไขความสนใจ</h2>
                <form action="../Edit/process_edit_admin_level.php" method="post">
                    <!-- Hidden input เพื่อส่ง admin_level_id ไปยังหน้า update_branch.php -->
                    <input type="hidden" name="admin_level_id" value="<?php echo $row['admin_level_id']; ?>">
                    <div class="mb-3">
                        <label for="admin_level_name" class="form-label">ชื่อความสนใจ</label>
                        <input type="text" class="form-control" id="admin_level_name" name="admin_level_name" value="<?php echo isset($row['admin_level_name']) ? htmlspecialchars($row['admin_level_name']) : ''; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">อัพเดต</button>
                    <a href="../Manage/manage_admin_level.php" class="btn btn-secondary btn-block">กลับ</a>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua/CJ4Ll48p+Aaxj3UqI9q9I8+3N48Npx2iOaAR2yZ1P1mAvpddHx" crossorigin="anonymous"></script>
</body>

</html>
