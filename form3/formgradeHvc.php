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
    include('../Components/Navbar.php');
    include('../Connent/connent.php');
    $total_membership_grade = 0;
    $total_membership_interest = 0;
    // ดึงข้อมูลรายวิชา
    $sql_grade = "SELECT * FROM subjects WHERE study_level_Id = 1";
    $result_grade = $connect->query($sql_grade);
    // ดึงข้อมูลความสนใจ
    $sql_interest = "SELECT * FROM attention";
    $result_interest = $connect->query($sql_interest);
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
    // ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // เก็บข้อมูลที่รับมาจากฟอร์ม
        $grades = isset($_POST['grades']) ? $_POST['grades'] : [];
        $scores = isset($_POST['scores']) ? $_POST['scores'] : [];
    }
    ?>
    <div class="container">
        <br>
        <div class="row">
            <div class="col">
                <h3>รายวิชาพื้นฐานระดับประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.)</h3>
                <form method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ชื่อรายวิชา</th>
                                <th scope="col">เกรดเเต่ละรายวิชา</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_grade->fetch_assoc()) : ?>
                                <tr>
                                    <td>
                                        <?php echo $row['subject_name']; ?>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="grades[<?php echo $row['subject_Id']; ?>]" placeholder="กรอกเกรด">
                                    </td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
            </div>
            <div class="col">
                <h3>ด้านความสนใจระดับระดับประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.)</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ชื่อรายวิชา</th>
                            <th scope="col">คะเเนนความสนใจเเต่ละรายวิชา</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_interest->fetch_assoc()) : ?>
                            <tr>
                                <td>
                                    <?php echo $row['attention_name']; ?>
                                </td>
                                <td>
                                    <input type="radio" name="scores[<?php echo $row['attention_Id']; ?>]" value="4"> ดีมาก
                                    <input type="radio" name="scores[<?php echo $row['attention_Id']; ?>]" value="3"> ดี
                                    <input type="radio" name="scores[<?php echo $row['attention_Id']; ?>]" value="2"> พอให้
                                    <input type="radio" name="scores[<?php echo $row['attention_Id']; ?>]" value="1"> ปรับปรุง
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
        <button type="submit" class="btn btn-success" onclick="calculate()"><i class="fa-solid fa-calculator"></i> คำนวณ</button>
        </form>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && (empty($grades) || empty($scores))) : ?>
                    <h2>กรุณาเพิ่มข้อมูล</h2>
                <?php else : ?>
                    <h2>ผลลัพธ์</h2>
                    <h3>ค่าความเป็นสมาชิกจากเกรด: <?php echo  number_format($total_membership_grade, 2)  ?> </h3>
                    <h3>ค่าความเป็นสมาชิกจากคะเเนนความสนใจ: <?php echo  number_format($total_membership_interest, 2)  ?> </h3>
                    <h3>ค่าความเป็นสมาชิกทั้งหมด: <?php echo  number_format($total_membership_grade + $total_membership_interest, 2)  ?> </h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        function calculate() {
            // รีโหลดหน้าหลังจากคำนวณ
            document.getElementById("result-container").innerHTML = "";
            location.reload();
        }
    </script>
    <script src="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
