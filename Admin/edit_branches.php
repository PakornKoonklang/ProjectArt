<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เเก้ไขสาขางาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous">
</head>

<body>
    <?php include "../Connent/connent.php"; ?>

    <?php
    // ตรวจสอบว่ามีการส่ง branch_id มาหรือไม่
    if (isset($_GET['branch_Id'])) {
        $branchId = $_GET['branch_Id'];

        // ดึงข้อมูลสาขาจากฐานข้อมูล
        $sql = "SELECT * FROM branches WHERE branch_Id = $branchId";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            // ถ้าไม่พบข้อมูลสาขา
            echo "Branch not found.";
            exit();
        }
    } else {
        // ถ้าไม่ได้รับ branch_id
        echo "Branch ID not provided.";
        exit();
    }
    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-primary mb-4">เเก้ไขสาขางาน</h2>
                <form action="process_edit_branches.php" method="post">
                    <!-- Hidden input เพื่อส่ง branch_id ไปยังหน้า update_branch.php -->
                    <input type="hidden" name="branchId" value="<?php echo $row['branch_Id']; ?>">

                    <div class="mb-3">
                        <label for="branchName" class="form-label">ชื่อสาขา</label>
                        <input type="text" class="form-control" id="branchName" name="branchName" value="<?php echo $row['branch_Name']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">รายละเอียดสาขา</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo $row['description']; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">อัพเดต</button>
                    <a href="admin_dashboard.php" class="btn btn-secondary btn-block">กลับ</a>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua/CJ4Ll48p+Aaxj3UqI9q9I8+3N48Npx2iOaAR2yZ1P1mAvpddHx" crossorigin="anonymous"></script>
</body>

</html>