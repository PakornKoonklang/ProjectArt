<?php
session_start();
include('../Components/Navbar.php');
include('../Connent/connent.php');

function right_shoulder($x, $a, $b) {
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

$grades = $_SESSION['grades'] ?? [];
$scores = $_SESSION['scores'] ?? [];

$branch_memberships = [];

$sql_branches = "SELECT * FROM branches";
$result_branches = $connect->query($sql_branches);

while ($branch = $result_branches->fetch_assoc()) {
    $branch_id = $branch['branches_Id'];
    $branch_name = $branch['branches_Name'];

    $total_grade_membership = 0;
    $total_interest_membership = 0;

    foreach ($grades as $subjectId => $grade) {
        if (is_numeric($grade)) {
            $membership_value = right_shoulder(floatval($grade), $a, $b);
            $sql_subject_multiplier = "SELECT subject_Multiplier FROM branches_subjectvcc WHERE branches_Id = $branch_id AND subjectvcc_id = $subjectId";
            $result_subject_multiplier = $connect->query($sql_subject_multiplier);
            if ($result_subject_multiplier && $multiplier_row = $result_subject_multiplier->fetch_assoc()) {
                $multiplier = $multiplier_row['subject_Multiplier'];
                $total_grade_membership += $membership_value * $multiplier;
            }
        }
    }

    foreach ($scores as $attentionId => $score) {
        if (is_numeric($score)) {
            $membership_value = right_shoulder(floatval($score), $a, $b);
            $sql_interest_adder = "SELECT attention_Adder FROM branches_attention WHERE branch_Id = $branch_id AND attention_Id = $attentionId";
            $result_interest_adder = $connect->query($sql_interest_adder);
            if ($result_interest_adder && $adder_row = $result_interest_adder->fetch_assoc()) {
                $adder = $adder_row['attention_Adder'];
                $total_interest_membership += $membership_value * $adder;
            }
        }
    }

    $branch_memberships[$branch_id] = [
        'branch_name' => $branch_name,
        'grade_membership' => $total_grade_membership,
        'interest_membership' => $total_interest_membership,
        'total_membership' => $total_grade_membership + $total_interest_membership,
    ];
}

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ผลลัพธ์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>ผลลัพธ์</h2>
        <?php if (empty($branch_memberships)) : ?>
            <p>ไม่มีข้อมูลสาขา</p>
        <?php else : ?>
            <?php
            uasort($branch_memberships, function ($a, $b) {
                return $b['total_membership'] <=> $a['total_membership'];
            });

            $top_branches = array_slice($branch_memberships, 0, 4);
            ?>

            <h3>ค่าสมาชิกของสาขา</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ชื่อสาขา</th>
                        <th scope="col">ค่าความเป็นสมาชิกทั้งหมด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($top_branches as $branch_id => $memberships) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($memberships['branch_name']); ?></td>
                            <td><?php echo number_format($memberships['total_membership'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php foreach ($top_branches as $branch_id => $memberships) : ?>
                <?php
                $sql_branch_details = "SELECT * FROM branches WHERE branches_Id = $branch_id";
                $result_branch_details = $connect->query($sql_branch_details);
                if ($result_branch_details && $branch_details = $result_branch_details->fetch_assoc()) : ?>
                    <h4>รายละเอียดสาขา: <?php echo htmlspecialchars($memberships['branch_name']); ?></h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">รายละเอียด</th>
                                <th scope="col">ข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>รหัสสาขา</td><td><?php echo htmlspecialchars($branch_details['branches_Id']); ?></td></tr>
                            <tr><td>ชื่อสาขา</td><td><?php echo htmlspecialchars($branch_details['branches_Name']); ?></td></tr>
                            <tr><td>รายละเอียด</td><td><?php echo htmlspecialchars($branch_details['branches_Detail']); ?></td></tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <a href="forminterest.php" class="btn btn-primary">ย้อนกลับ</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
