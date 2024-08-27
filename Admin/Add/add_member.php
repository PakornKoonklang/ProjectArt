<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="container">
    <?php include "../../Components/Admin/Navbar.php"; ?>
    <br>
    <div class="row">
        <div class="col-12">
            <h2 class="text-primary">เพิ่มสมาชิก</h2>
            <form action="process_add_member.php" method="POST">
                <div class="mb-3">
                    <label for="admin_Firstname" class="form-label">ชื่อจริง</label>
                    <input type="text" class="form-control" id="admin_Firstname" name="admin_Firstname" required>
                </div>
                <div class="mb-3">
                    <label for="admin_Lastname" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="admin_Lastname" name="admin_Lastname" required>
                </div>
                <div class="mb-3">
                    <label for="admin_User" class="form-label">Username</label>
                    <input type="text" class="form-control" id="admin_User" name="admin_User" required>
                </div>
                <div class="mb-3">
                    <label for="admin_Pass" class="form-label">Password</label>
                    <input type="password" class="form-control" id="admin_Pass" name="admin_Pass" required>
                </div>
                <div class="mb-3">
                    <label for="admin_Phone" class="form-label">เบอร์โทร</label>
                    <input type="text" class="form-control" id="admin_Phone" name="admin_Phone" required>
                </div>
                <div class="mb-3">
                    <label for="admin_Email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="admin_Email" name="admin_Email" required>
                </div>
                <div class="mb-3">
                    <label for="admin_level_Id" class="form-label">Admin_Level</label>
                    <select class="form-select" id="admin_level_Id" name="admin_level_Id" required>
                        <option value=""></option>
                        <?php
                        // Include connection file and fetch branch data from database
                        include "../../Connent/connent.php";
                        $sql = "SELECT admin_level_Id, admin_level_name FROM admin_level";
                        $result = $connect->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['admin_level_Id'] . "'>" . $row['admin_level_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
                <a href="../Manage/manage_member.php" class="btn btn-secondary btn-block">กลับ</a>
            </form>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/c233baf144.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>