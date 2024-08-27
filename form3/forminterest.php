<?php
session_start();
ob_start(); // เริ่มการบัฟเฟอร์เอาท์พุต
include('../Components/Navbar.php'); // ตรวจสอบว่ามีข้อมูลส่งออกที่นี่หรือไม่
include('../Connent/connent.php');

// จัดการการรีเซตข้อมูลในเซสชัน
if (isset($_GET['reset']) && $_GET['reset'] == 'true') {
    unset($_SESSION['scores']);
    header('Location: ' . $_SERVER['PHP_SELF']); // รีเฟรชหน้าเว็บหลังจากรีเซต
    exit;
}

// เก็บคะแนนที่ส่งมาจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['scores'] = $_POST['scores'] ?? [];
    header('Location: result.php'); // เปลี่ยนไปยังหน้าผลลัพธ์
    exit;
}

// ดึงข้อมูลจากตาราง attention
$sql_attention = "SELECT * FROM attention";
$result_attention = $connect->query($sql_attention);

if (!$result_attention) {
    die("ข้อผิดพลาดในการดึงข้อมูล: " . $connect->error);
}

// สร้าง array เพื่อเก็บข้อมูล attention
$attentions = [];
while ($row_attention = $result_attention->fetch_assoc()) {
    $attentions[$row_attention['attention_Id']] = $row_attention['attention_name'];
}

ob_end_flush(); // ส่งข้อมูลบัฟเฟอร์ออก
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>กรอกข้อมูลความสนใจ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3 class="mb-4">ด้านความสนใจระดับประกาศนียบัตรวิชาชีพขั้นสูง(ปวส.)</h3>
        <form method="post" action="">
            <input type="hidden" name="grades" value='<?php echo htmlspecialchars(json_encode($_SESSION['grades']), ENT_QUOTES, 'UTF-8'); ?>'>
            <table class="table table-bordered table-striped">
                <thead >
                    <tr>
                        <th scope="col">ชื่อความสนใจ</th>
                        <th scope="col">คะแนนความสนใจ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attentions as $attention_id => $attention_name) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($attention_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <div>
                                    <?php
                                    $score_value = $_SESSION['scores'][$attention_id] ?? '';
                                    ?>
                                    <input type="radio" name="scores[<?php echo htmlspecialchars($attention_id, ENT_QUOTES, 'UTF-8'); ?>]" value="4" <?php echo $score_value == '4' ? 'checked' : ''; ?>> สนใจมาก
                                    <input type="radio" name="scores[<?php echo htmlspecialchars($attention_id, ENT_QUOTES, 'UTF-8'); ?>]" value="3" <?php echo $score_value == '3' ? 'checked' : ''; ?>> สนใจ
                                    <input type="radio" name="scores[<?php echo htmlspecialchars($attention_id, ENT_QUOTES, 'UTF-8'); ?>]" value="2" <?php echo $score_value == '2' ? 'checked' : ''; ?>> พอสนใจ
                                    <input type="radio" name="scores[<?php echo htmlspecialchars($attention_id, ENT_QUOTES, 'UTF-8'); ?>]" value="1" <?php echo $score_value == '1' ? 'checked' : ''; ?>> ไม่สนใจ
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">ถัดไป</button>
            <a href="?reset=true" class="btn btn-warning">รีเซต</a>
            <a href="formgrade.php" class="btn btn-primary">ย้อนกลับ</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
