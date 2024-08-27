<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Branch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-primary">เพิ่มสาขา</h2>
        <form action="../Add/process_add_branches.php" method="POST">
            <div class="mb-3">
                <label for="branches_Name" class="form-label">ชื่อสาขา</label>
                <input type="text" class="form-control" id="branches_Name" name="branches_Name" required>
            </div>
            <div class="mb-3">
                        <label for="description" class="form-label">รายละเอียดสาขา</label>
                        <textarea class="form-control" id="description" name="description"required ></textarea>
                    </div>

            <button type="submit" class="btn btn-primary">ยืนยัน</button>
            <a href="../Manage/manage_branches.php" class="btn btn-secondary btn-block">กลับ</a>
        </form>
    </div>
</body>

</html>

