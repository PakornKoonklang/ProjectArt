<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous">
</head>

<body>
    <?php include "../../Connent/connent.php"; ?>

    <!-- ตำแหน่งที่ต้องการแสดงข้อมูล -->
    <div class="col-md-9" id="contentContainer">
        <!-- แสดงข้อความต้อนรับ -->
        <h2 class="text-primary" id="welcomeMessage">จัดการสาขาที่อยู่ในคณะวิศวกรรมศาสตร์</h2>

        <!-- ปุ่มเพิ่มข้อมูล -->
        <button type="button" class="btn btn-success mb-3" onclick="window.location.href='add_subject.php';">เพิ่มรายชื่อสาขา</button>

        <!-- ตารางแสดงข้อมูล -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">รหัสวิชา</th>
                    <th scope="col">ชื่อรายวิชา</th>
                    <th scope="col">จัดการข้อมูล</th>
                  
                </tr>
            </thead>
            <tbody>
                <?php
                // ดึงข้อมูลจากฐานข้อมูล
                $sql = "SELECT * FROM subjects";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo "{$row['subject_Id']}" ?></td>
                            <td><?php echo "{$row['subject_Name']}" ?></td>
                            
                            <td>
                                <div class="btn-group" role="group">
                                    <a href='edit_subject.php?subject_Id=<?php echo $row['subject_Id']; ?>' class='btn btn-warning mx-1'>Edit</a>
                                    <a href='process_delete_subject.php?subject_Id=<?php echo $row['subject_Id']; ?>' class='btn btn-danger' onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>

