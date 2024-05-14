<!DOCTYPE html>
<html lang="th">

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

        //เรียกข้อมูลรายวิชาทั้งหมดที่เป็นรายวิชาพื้นฐานระดับมัธยมศึกษาปีที่ 6 
    $sql_grade = "SELECT * FROM subjects WHERE study_level_Id = 3";
    $result_grade = $connect->query($sql_grade);

        //ดึงข้อมูลค่าความสนใจ
    $sql_interest = "SELECT * FROM attention";
    $result_interest = $connect->query($sql_interest);
    //ดึงข้อมูลสาขา
    $sql_branches = "SELECT * FROM branches";
    $result_branches = $connect->query($sql_branches);

        //ดึงข้อมูลค่าความสนใจของสาขาต่างๆ
    $sql_branches_attention = "SELECT branches_attention.*, attention.attention_name
                           FROM branches_attention
                           INNER JOIN attention ON branches_attention.attention_Id = attention.attention_Id";
$result_branches_attention = $connect->query($sql_branches_attention);



   //กำหนดตัวแปร $branch_memberships ไว้สำหรับเก็บข้อมูลค่าสมาชิกของนักเรียนในแต่ละสาขา 
    $branch_memberships = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $grades = isset($_POST['grades']) ? $_POST['grades'] : [];
        $scores = isset($_POST['scores']) ? $_POST['scores'] : [];
        $grade_memberships = [];
        $interest_memberships = [];

        foreach ($grades as $subjectId => $grade) {
            if (is_numeric($grade)) {
                $membership_value = right_shoulder(floatval($grade), $a, $b);
                $grade_memberships[$subjectId] = $membership_value;
            }
        }

        foreach ($scores as $attentionId => $score) {
            if (is_numeric($score)) {
                $membership_value = right_shoulder(floatval($score), $a, $b);
                $interest_memberships[$attentionId] = $membership_value;
            }
        }

        while ($branch = $result_branches->fetch_assoc()) {
            $branch_id = $branch['branches_Id'];
            $branch_name = $branch['branches_Name'];

            $total_grade_membership = 0;
            $total_interest_membership = 0;

            // คำนวณค่าสมาชิกรวมสำหรับเกรด
            foreach ($grade_memberships as $subjectId => $membership_value) {
                $sql_subject_multiplier = "SELECT subject_Multiplier FROM branches_subjects WHERE branches_Id = $branch_id AND subject_Id = $subjectId AND study_level_Id = 3";
                $result_subject_multiplier = $connect->query($sql_subject_multiplier);
                if ($result_subject_multiplier && $multiplier_row = $result_subject_multiplier->fetch_assoc()) {
                    $multiplier = $multiplier_row['subject_Multiplier'];
                    $total_grade_membership += $membership_value * $multiplier;
                }
            }

                        // คำนวณมูลค่าสมาชิกทั้งหมดสำหรับความสนใจ
            foreach ($interest_memberships as $attentionId => $membership_value) {
                $sql_interest_adder = "SELECT attention_Adder FROM branches_attention WHERE branch_Id = $branch_id AND attention_Id = $attentionId";
                $result_interest_adder = $connect->query($sql_interest_adder);
                if ($result_interest_adder && $adder_row = $result_interest_adder->fetch_assoc()) {
                    $adder = $adder_row['attention_Adder'];
                    $total_interest_membership += $membership_value * $adder;
                }
            }

            //เก็บข้อมูลเกี่ยวกับค่าสมาชิกของนักเรียนในแต่ละสาขา
            $branch_memberships[$branch_name] = [
                
                'grade_membership' => $total_grade_membership, //เก็บค่าสมาชิกที่ได้จากเกรดของนักเรียนในสาขานั้น 
                'interest_membership' => $total_interest_membership, // เก็บค่าสมาชิกที่ได้จากคะแนนความสนใจของนักเรียนในสาขานั้น
                'total_membership' => $total_grade_membership + $total_interest_membership, //เก็บค่าสมาชิกทั้งหมดรวมของนักเรียนในสาขานั้น
            ];
        }
    }
    ?>
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
                                    <td><?php echo htmlspecialchars($row['subject_name']); ?></td>
                                    <td>
                                        <input type="text" class="form-control" name="grades[<?php echo htmlspecialchars($row['subject_Id']); ?>]" placeholder="กรอกเกรด">
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
            </div>
            <div class="col">
                <h3>ด้านความสนใจระดับมัธยมศึกษาปีที่ 6</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ชื่อรายวิชา</th>
                            <th scope="col">คะเเนนความสนใจ</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_interest->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['attention_name']); ?></td>
                                <td>
                                    <input type="radio" name="scores[<?php echo htmlspecialchars($row['attention_Id']); ?>]" value="4"> ดีมาก
                                    <input type="radio" name="scores[<?php echo htmlspecialchars($row['attention_Id']); ?>]" value="3"> ดี
                                    <input type="radio" name="scores[<?php echo htmlspecialchars($row['attention_Id']); ?>]" value="2"> พอใช้
                                    <input type="radio" name="scores[<?php echo htmlspecialchars($row['attention_Id']); ?>]" value="1"> ปรับปรุง
                                </td>
                            </tr>
                        <?php endwhile; ?>
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
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && (empty($grades) || empty($scores))) {
                echo "<h2>กรุณาเพิ่มข้อมูล</h2>";
            } else {
                echo "<h2>ผลลัพธ์</h2>";

                if (empty($branch_memberships)) {
                    echo "<p>ไม่มีข้อมูลสาขา</p>";
                } else {
                    echo "<h2>ค่าสมาชิกของสาขา</h2>";
                    // เรียงลำดับสาขาตามค่าสมาชิกทั้งหมด
                    arsort($branch_memberships);

                    // เลือกเพียง 4 สาขาแรก
                    $top_branches = array_slice($branch_memberships, 0, 4);

                    echo "<table class='table'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th scope='col'>ชื่อสาขา</th>";
                    echo "<th scope='col'>ค่าความเป็นสมาชิกจากเกรด</th>";
                    echo "<th scope='col'>ค่าความเป็นสมาชิกจากคะแนนความสนใจ</th>";
                    echo "<th scope='col'>ค่าความเป็นสมาชิกทั้งหมด</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach ($top_branches as $branch_name => $memberships) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($branch_name) . "</td>";
                        echo "<td>" . number_format($memberships['grade_membership'], 2) . "</td>";
                        echo "<td>" . number_format($memberships['interest_membership'], 2) . "</td>";
                        echo "<td>" . number_format($memberships['total_membership'], 2) . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                }
            }
            ?>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
