<?php
ob_start(); // เริ่มการบัฟเฟอร์เอาต์พุต
session_start();
include('../Components/Navbar.php'); // ตรวจสอบว่ามีข้อมูลส่งออกที่นี่หรือไม่
include('../Connent/connent.php');

// จัดการการรีเซตข้อมูลในเซสชัน
if (isset($_GET['reset']) && $_GET['reset'] == 'true') {
    unset($_SESSION['grades']);
    header('Location: ' . $_SERVER['PHP_SELF']); // รีเฟรชหน้าเว็บหลังจากรีเซต
    exit;
}

// เก็บคะแนนที่ส่งมาจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['grades'] = $_POST['grades'] ?? [];
    header('Location: forminterest.php'); // เปลี่ยนไปยังหน้าผลลัพธ์
    exit;
}

$sql_grade = "SELECT * FROM subjectm6";
$result_grade = $connect->query($sql_grade);
ob_end_flush(); // จบการบัฟเฟอร์เอาต์พุตและส่งข้อมูล
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>กรอกรายวิชา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
        .table th{
            text-align: center;
            vertical-align: middle;     
        }
        .grade-options {
            display: flex;
            flex-wrap: wrap; /* ทำให้ตัวเลือกเกรดจัดเรียงเป็นบรรทัดใหม่ถ้าพื้นที่ไม่พอ */
            justify-content: center; /* จัดกลางตัวเลือกเกรด */
            font-size: 16px; /* ขนาดของฟอนต์ */
        }
        .grade-options label {         
            border: 2px solid #ddd; /* ขอบของช่อง */
            border-radius: 5px; /* มุมโค้งของช่อง */
            background-color: #f9f9f9; /* สีพื้นหลังของช่อง */
            margin-left: 10px;
        }
        .grade-options label:hover {
            background-color: #e0e0e0; /* เปลี่ยนสีพื้นหลังเมื่อเคอร์เซอร์ชี้ที่ช่อง */
        }
        .grade-options input {
            margin-right: 5px; /* เพิ่มระยะห่างระหว่างตัวเลือกและข้อความ */
        }
       
    </style>
</head>
<body>
    <div class="container mt-4">
        <h3 class="mb-4">รายวิชาพื้นฐานระดับมัธยม ม.6</h3>
        <form method="post" action="">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">ชื่อรายวิชา</th>
                        <th scope="col">เกรดแต่ละรายวิชา</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_grade->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['subjectM6_name']); ?></td>
                            <td>
                                <div class="grade-options">
                                    <?php
                                    $subject_id = htmlspecialchars($row['subjectM6_id']);
                                    $grade_value = $_SESSION['grades'][$subject_id] ?? '';
                                    ?>
                                    <label>
                                        1 <input type="radio" name="grades[<?php echo $subject_id; ?>]" value="1" <?php echo $grade_value == '1' ? 'checked' : ''; ?>>
                                        
                                    </label>
                                    <label>
                                        1.5 <input type="radio" name="grades[<?php echo $subject_id; ?>]" value="1.5" <?php echo $grade_value == '1.5' ? 'checked' : ''; ?>>
                                        
                                    </label>
                                    <label>
                                        2 <input type="radio" name="grades[<?php echo $subject_id; ?>]" value="2" <?php echo $grade_value == '2' ? 'checked' : ''; ?>>
                                        
                                    </label>
                                    <label>
                                        2.5 <input type="radio" name="grades[<?php echo $subject_id; ?>]" value="2.5" <?php echo $grade_value == '2.5' ? 'checked' : ''; ?>>
                                        
                                    </label>
                                    <label>
                                        3 <input type="radio" name="grades[<?php echo $subject_id; ?>]" value="3" <?php echo $grade_value == '3' ? 'checked' : ''; ?>>
                                        
                                    </label>
                                    <label>
                                        3.5 <input type="radio" name="grades[<?php echo $subject_id; ?>]" value="3.5" <?php echo $grade_value == '3.5' ? 'checked' : ''; ?>>
                                        
                                    </label>
                                    <label>
                                        4 <input type="radio" name="grades[<?php echo $subject_id; ?>]" value="4" <?php echo $grade_value == '4' ? 'checked' : ''; ?>>
                                        
                                    </label>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">ถัดไป</button>
            <a href="?reset=true" class="btn btn-warning">รีเซต</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
