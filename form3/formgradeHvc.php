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
        $sql = "SELECT * FROM subjects";
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
            $grades = isset($_POST['grades']) ? $_POST['grades'] : [];
        }
        ?>
        <div class="container">
            <br>
            <h3>รายวิชาพื้นฐานระดับประกาศนียบัตรวิชาชีพชั้นสูง(ปวส.)</h3>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <form method="post">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ชื่อรายวิชา</th>
                                        <th scope="col">เกรดเเต่ละรายวิชา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['subject_Name']; ?>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="grades[<?php echo $row['subject_Id']; ?>]" placeholder="กรอกเกรด">
                                            </td>
                                        </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success" onclick="calculate()"><i class="fa-solid fa-calculator"></i> คำนวณ</button>
                        </form>
                            <button class="btn btn-info" onclick="goToNextPage()" ><i class="fa-solid fa-door-open"></i> กรอกฟอร์มด้านความสนใจ</button>
                    </div>
                    <div class="col">
                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($grades)) : ?>
                            <h2>กรุณาเพิ่มข้อมูล</h2>
                        <?php else : ?>
                           <h2>ผลลัพธ์</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">วิชา</th>
                                    <th scope="col">เกรด</th>
                                    <th scope="col">ค่าความเป็นสมาชิก</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
$index = 1;

// Check if $grades is defined and is an array or object
if (isset($grades) && (is_array($grades) || is_object($grades))) {
    foreach ($grades as $subjectId => $grade) {
        // Check if $grade is a valid value for your calculation
        if (is_numeric($grade)) {
            // Calculate membership value using right_shoulder function
            $membership_value = right_shoulder(floatval($grade), $a, $b);

            // Fetch subject name from the database
            $sql_subject = "SELECT subject_Name FROM subjects WHERE subject_Id = '$subjectId'";
            $result_subject = $connect->query($sql_subject);
            
            // Check if the query was successful
            if ($result_subject) {
                $row_subject = $result_subject->fetch_assoc();
                $subject_name = $row_subject['subject_Name'];

                // Add membership value to the total
                $total_membership += $membership_value;
?>
                <tr>
                    <th scope="row"><?php echo $index; ?></th>
                    <td><?php echo $subject_name; ?></td>
                    <td><?php echo $grade; ?></td>
                    <td><?php echo number_format($membership_value, 2); ?></td>
                </tr>
<?php
                $index++;
            } else {
                // Handle the case where the query was not successful
                // You might want to log an error or handle this case differently
            }
        } else {
            // Handle the case where $grade is not a valid value
            // You might want to log an error or handle this case differently
        }
    }
} else {
    // Handle the case where $grades is not defined or not an array/object
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
            window.location.href = 'forminterest3.php';
        }
        </script>
    </body>
    <script src="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </html>