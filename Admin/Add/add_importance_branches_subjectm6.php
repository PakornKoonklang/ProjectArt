<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Attention Importance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-primary">เพิ่มความสนใจ</h2>
        <form action="../Add/process_add_importance_branches_subjectm6.php" method="POST">
            <div class="mb-3">
                <label for="branch_Id" class="form-label">Branch ID</label>
                <select class="form-select" id="branches_name" name="branches_name" required>
                    <option value="">เลือก Branch ID</option>
                    <?php
                    // Include connection file and fetch branch data from database
                    include "../../Connent/connent.php";
                    $sql = "SELECT branches_name FROM branches";
                    $result = $connect->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['branches_name'] . "'>" . $row['branches_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="subjectM6_id" class="form-label">SubjectM6 ID</label>
                <select class="form-select" id="subjectM6_name" name="subjectM6_name" required>
                    <option value="">เลือก Attention ID</option>
                    <?php
                    // Include connection file and fetch branch data from database
                    include "../../Connent/connent.php";
                    $sql = "SELECT subjectM6_name FROM subjectm6";
                    $result = $connect->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['subjectM6_name'] . "'>" . $row['subjectM6_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
            <label for="subject_Multiplier" class="form-label">ค่าความสนใจ</label>
                <input type="text" class="form-control" id="subject_Multiplier" name="subject_Multiplier" required>
            </div>
            <button type="submit" class="btn btn-primary">ยืนยัน</button>
            <a href="../Manage/manage_importance_subjectm6.php" class="btn btn-secondary btn-block">กลับ</a>
        </form>
    </div>
</body>

</html>
