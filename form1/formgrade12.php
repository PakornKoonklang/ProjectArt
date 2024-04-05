<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ระบบแนะนำนักเรียนเข้าวิศวกรรมระดับปริญญาตรี</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php
    include('../Components/navbar.php');
    include('../Connent/connent.php');

    function right_shoulder($x, $a, $b)
    {
        if ($x <= $a) {
            return 0;
        } elseif ($x >= $b) {
            return 1;
        } else {
            return ($x - $a) / ($b - $a);
        }
    }

    $a = 0;
    $b = 4;

    // ดึงข้อมูลรายวิชา
    $sql_subject = "SELECT * FROM subjects";
    $result_subject = $connect->query($sql_subject);

    // เก็บข้อมูลรายวิชา
    $data = [];
    while ($row_subject = $result_subject->fetch_assoc()) {
        $data[] = $row_subject;
    }

    // ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // เก็บข้อมูลที่รับมาจากฟอร์ม
        $grades = isset($_POST['grades']) ? $_POST['grades'] : [];

        // เก็บค่าความเป็นสมาชิกของแต่ละวิชา
        $membershipValues = [];
        foreach ($grades as $subjectId => $grade) {
            // คำนวณค่าความเป็นสมาชิก
            $membership_value = right_shoulder(floatval($grade), $a, $b);

            // เก็บค่าความเป็นสมาชิก
            $membershipValues[$subjectId] = $membership_value;
        }

        // เรียงลำดับค่าความเป็นสมาชิกจากรายวิชาที่มีค่ามากที่สุดไปน้อยที่สุด
        arsort($membershipValues);
    }
    ?>
    <div class="container">
        <br>
        <h3>รายวิชาพื้นฐานระดับมัธยมศึกษาปีที่ 6</h3>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <form method="post">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">รหัสวิชา</th>
                                    <th scope="col">ชื่อรายวิชา</th>
                                    <th scope="col">เกรดเเต่ละรายวิชา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <td><?php echo $row['subject_Id']; ?></td>
                                        <td><?php echo $row['subject_Name']; ?></td>
                                        <td>
                                            <input type="text" class="form-control" name="grades[<?php echo $row['subject_Id']; ?>]" placeholder="กรอกเกรด">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-calculator"></i> คำนวณ</button>
                    </form>
                </div>
                <div class="col">
                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
                        <h2>รายวิชาที่มีค่ามากที่สุด 4 ลำดับ:</h2>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th scope='col'>รหัสวิชา</th>
                                    <th scope='col'>ชื่อวิชา</th>
                                    <th scope='col'>ค่าความเป็นสมาชิก</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach ($membershipValues as $subjectId => $membershipValue) {
                                    $subjectName = $data[$subjectId - 1]['subject_Name']; ?>
                                    <tr>
                                        <td><?php echo $subjectId; ?></td>
                                        <td><?php echo $subjectName; ?></td>
                                        <td><?php echo number_format($membershipValue, 2); ?></td>
                                    </tr>
                                <?php
                                    $count++;
                                    if ($count >= 4) {
                                        break;
                                    }
                                } ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>