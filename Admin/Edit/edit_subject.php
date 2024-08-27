<?php
// Include เพื่อเชื่อมต่อฐานข้อมูล
include "../../Connent/connent.php";

// ตรวจสอบว่ามีการส่ง id มาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ดึงข้อมูลจากตาราง branches_subjects
    $sql = "SELECT bs.*, s.subject_Name, b.branches_Name, sl.study_level_name 
            FROM branches_subjects bs
            JOIN subjects s ON bs.subject_Id = s.subject_Id
            JOIN branches b ON bs.branches_Id = b.branches_Id
            JOIN study_level sl ON bs.study_level_Id = sl.study_level_Id
            WHERE bs.id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found.";
        exit();
    }
} else {
    echo "ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขความสำคัญของวิชา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-primary mb-4">แก้ไขความสำคัญของวิชา</h2>
                <form action="process_edit_subject.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="mb-3">
                        <label for="subjectMultiplier" class="form-label">ค่าความสำคัญ</label>
                        <input type="number" class="form-control" id="subjectMultiplier" name="subjectMultiplier" value="<?php echo $row['subject_Multiplier']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">อัพเดต</button>
                    <a href="admin_dashboard.php" class="btn btn-secondary btn-block">กลับ</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8f+ua/CJ4Ll48p+Aaxj3UqI9q9I8+3N48Npx2iOaAR2yZ1P1mAvpddHx" crossorigin="anonymous">
    </script>
</body>

</html>
