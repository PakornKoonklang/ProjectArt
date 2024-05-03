<?php
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

$total_membership_grade = 0;
$total_membership_interest = 0;

$sql_grade = "SELECT * FROM subjects WHERE study_level_Id = 3";
$result_grade = $connect->query($sql_grade);

$sql_interest = "SELECT * FROM attention";
$result_interest = $connect->query($sql_interest);

$a = 0;
$b = 4;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $grades = isset($_POST['grades']) ? $_POST['grades'] : [];
    $scores = isset($_POST['scores']) ? $_POST['scores'] : [];

    foreach ($grades as $subjectId => $grade) {
        if (is_numeric($grade)) {
            $membership_value = right_shoulder(floatval($grade), $a, $b);
            $total_membership_grade += $membership_value;
        }
    }

    foreach ($scores as $attentionId => $score) {
        if (is_numeric($score)) {
            $membership_value = right_shoulder(floatval($score), $a, $b);
            $total_membership_interest += $membership_value;
        }
    }

    $total_subject_membership = [];
    $sql_branches = "SELECT branches_Id, branches_Name FROM branches";
    $result_branches = $connect->query($sql_branches);
    while ($branch = $result_branches->fetch_assoc()) {
        $branchId = $branch['branches_Id'];
        $total_subject_membership[$branch['branches_Name']] = 0;

        $sql_multiplier = "SELECT subjects.subject_Id, subjects.subject_name, branches_subjects.subject_Multiplier 
                            FROM subjects 
                            INNER JOIN branches_subjects ON subjects.subject_Id = branches_subjects.subject_Id 
                            WHERE branches_subjects.branches_Id = $branchId AND branches_subjects.study_level_Id = 3";
        $result_multiplier = $connect->query($sql_multiplier);
        while ($row = $result_multiplier->fetch_assoc()) {
            $subject_multiplier = floatval($row['subject_Multiplier']);
            $membership_value = right_shoulder($subject_multiplier, $a, $b);
            $total_subject_membership[$branch['branches_Name']] += $membership_value;
        }
    }

    // หาสาขาที่ใกล้เคียงกับค่า total_membership_grade ที่กรอกมา
    $nearest_branches = [];
    $min_diff = INF;
    foreach ($total_subject_membership as $branchName => $membership) {
        $diff = abs($total_membership_grade - $membership);
        if ($diff < $min_diff) {
            $nearest_branches = [$branchName];
            $min_diff = $diff;
        } elseif ($diff == $min_diff) {
            $nearest_branches[] = $branchName;
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ระบบแนะนำนักเรียนเข้าวิศวกรรมระดับปริญญาตรี</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <br>
        <div class="row">
            <div class="col">
                <h3>รายวิชาพื้นฐานระดับมัธยมศึกษาปีที่ 6</h3>
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
                <h3>ด้านความสนใจระดับมัธยมศึกษาปีที่ 6</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ชื่อรายวิชา</th>
                            <th scope="col">คะแนนความสนใจเเต่ละรายวิชา</th>
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
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-calculator"></i> คำนวณ</button>
        </form>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && (empty($grades) || empty($scores))) : ?>
                    <h2>กรุณาเพิ่มข้อมูล</h2>
                <?php else : ?>
                    <h2>ผลลัพธ์</h2>
                    <h3>ค่าความเป็นสมาชิกจากเกรด: <?php echo number_format($total_membership_grade, 2) ?> </h3>
                    <h3>ค่าความเป็นสมาชิกจากคะแนนความสนใจ: <?php echo number_format($total_membership_interest, 2) ?> </h3>
                    <?php foreach ($total_subject_membership as $branchName => $membership) : ?>
                        <h3>ค่าความเป็นสมาชิกจากค่า subject_Multiplier สำหรับสาขา <?php echo $branchName; ?>: <?php echo number_format($membership, 2) ?> </h3>
                    <?php endforeach; ?>
                    <h3>ค่าความเป็นสมาชิกทั้งหมด: <?php echo number_format($total_membership_grade + $total_membership_interest + array_sum($total_subject_membership), 2) ?> </h3>
                    <br>
                    <br>
                    <h3>สาขาที่ใกล้เคียง: <?php echo implode(", ", $nearest_branches); ?><br> </h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
