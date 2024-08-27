<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขผู้ดูแล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous">
</head>

<body>
    <?php
    include "../../Connent/connent.php"; // เชื่อมต่อฐานข้อมูล

    // ตรวจสอบว่ามีการส่ง admin_Id มาหรือไม่
    if (isset($_GET['admin_Id'])) {
        $adminId = $_GET['admin_Id'];

        // ดึงข้อมูลสาขาจากฐานข้อมูล
        $sql = "SELECT * FROM admin WHERE admin_Id = '$adminId'";
        $result = $connect->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            // ถ้าไม่พบข้อมูลสาขา
            echo "<div class='alert alert-danger' role='alert'>Admin not found.</div>";
            exit();
        }
    } else {
        // ถ้าไม่ได้รับ admin_Id
        echo "<div class='alert alert-danger' role='alert'>Admin ID not provided.</div>";
        exit();
    }
    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-primary mb-4">แก้ไขผู้ดูแล</h2>
                <form action="../Edit/process_edit_member.php" method="post">
                    <!-- Hidden input เพื่อส่ง admin_Id ไปยังหน้า process_edit_member.php -->
                    <input type="hidden" name="adminid" value="<?php echo htmlspecialchars($row['admin_Id']); ?>">

                    <div class="mb-3">
                        <label for="admin_Firstname" class="form-label">ชื่อจริง</label>
                        <input type="text" class="form-control" id="admin_Firstname" name="admin_Firstname"
                            value="<?php echo htmlspecialchars($row['admin_Firstname']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_Lastname" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" id="admin_Lastname" name="admin_Lastname"
                            value="<?php echo htmlspecialchars($row['admin_Lastname']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_User" class="form-label">Username</label>
                        <input type="text" class="form-control" id="admin_User" name="admin_User"
                            value="<?php echo htmlspecialchars($row['admin_User']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_Pass" class="form-label">Password</label>
                        <input type="text" class="form-control" id="admin_Pass" name="admin_Pass"
                            value="<?php echo htmlspecialchars($row['admin_Pass']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_Phone" class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" id="admin_Phone" name="admin_Phone"
                            value="<?php echo htmlspecialchars($row['admin_Phone']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_Email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" id="admin_Email" name="admin_Email"
                            value="<?php echo htmlspecialchars($row['admin_Email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_level_Id" class="form-label">Admin_Level</label>
                        <select class="form-select" id="admin_level_Id" name="admin_level_Id" required>
                            <option value=""></option>
                            <?php
                            // ดึงข้อมูล admin_level จากฐานข้อมูล
                            $sql = "SELECT admin_level_Id, admin_level_name FROM admin_level";
                            $result = $connect->query($sql);
                            while ($levelRow = $result->fetch_assoc()) {
                                $selected = ($levelRow['admin_level_Id'] == $row['admin_level_Id']) ? 'selected' : '';
                                echo "<option value='" . $levelRow['admin_level_Id'] . "' $selected>" . $levelRow['admin_level_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">อัพเดต</button>
                    <a href="../Manage/manage_member.php" class="btn btn-secondary btn-block">กลับ</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8f+ua/CJ4Ll48p+Aaxj3UqI9q9I8+3N48Npx2iOaAR2yZ1P1mAvpddHx"
        crossorigin="anonymous"></script>
</body>

</html>
