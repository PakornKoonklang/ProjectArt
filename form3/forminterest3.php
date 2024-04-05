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
    $total_membership = 0;
    // ดึงข้อมูลรายวิชา
    $sql = "SELECT * FROM attention";
    $result = $connect->query($sql);
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
        $scores = isset($_POST['scores']) ? $_POST['scores'] : [];
    }
    ?>
    <div class="container">
        <br>
        <h3>ด้านความสนใจระดับประกาศนียบัตรวิชาชีพชั้นสูง(ปวส.)</h3>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <form method="post">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ชื่อรายวิชา</th>
                                    <th scope="col">คะเเนนความสนใจเเต่ละรายวิชา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['attention_Name']; ?>
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
                        <button type="submit" class="btn btn-success" onclick="calculate()"><i class="fa-solid fa-calculator"></i> คำนวณ</button>
                    </form>
                    <button class="btn btn-info" onclick="goToNextPage()"><i class="fa-solid fa-door-open"></i> กลับ</button>
                </div>
                <div class="col">
                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($scores)) : ?>
                        <h2>กรุณาเพิ่มข้อมูล</h2>
                    <?php else : ?>
                        <h2>ผลลัพธ์</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">วิชา</th>
                                    <th scope="col">คะเนน</th>
                                    <th scope="col">ค่าความเป็นสมาชิก</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 1;

                                // Check if $scores is defined and is an array or object
                                if (isset($scores) && (is_array($scores) || is_object($scores))) {
                                    foreach ($scores as $AttentionId => $score) {
                                        // Check if $score is a valid value for your calculation
                                        if (is_numeric($score)) {
                                            // Calculate membership value using right_shoulder function
                                            $membership_value = right_shoulder(floatval($score), $a, $b);

                                            // Fetch attention name from the database
                                            $sql_attention = "SELECT attention_Name FROM attention WHERE attention_Id = '$AttentionId'";
                                            $result_attention = $connect->query($sql_attention);

                                            // Check if the query was successful
                                            if ($result_attention) {
                                                $row_attention = $result_attention->fetch_assoc();
                                                $attention_Name = $row_attention['attention_Name'];

                                                // Add membership value to the total
                                                $total_membership += $membership_value;
                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $index; ?></th>
                                                    <td><?php echo $attention_Name; ?></td>
                                                    <td><?php echo $score; ?></td>
                                                    <td><?php echo number_format($membership_value, 2); ?></td>
                                                </tr>
                                <?php
                                                $index++;
                                            } else {
                                                // Handle the case where the query was not successful
                                                // You might want to log an error or handle this case differently
                                            }
                                        } else {
                                            // Handle the case where $score is not a valid value
                                            // You might want to log an error or handle this case differently
                                        }
                                    }
                                } else {
                                    // Handle the case where $scores is not defined or not an array/object
                                    // You might want to log an error or handle this case differently
                                }
                                ?>

                            </tbody>
                            <h3>ค่าความเป็นสมาชิกทั้งหมด: <?php echo  number_format($total_membership, 2)  ?> </h3>
                        <?php endif; ?>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function calculate() {
            // รีโหลดหน้าหลังจากคำนวณ
            document.getElementById("result-container").innerHTML = "";
            location.reload();
        }

        function goToNextPage() {
            // ให้ window.location.href มีค่าเป็น URL ของหน้าถัดไป
            window.location.href = 'formgradeHvc.php';
        }
    </script>
</body>
<script src="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>