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
   <?php include "../Components/Admin/Navbar.php"; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <?php include "../Components/Admin/Cardname.php"; ?>
                <h4>การจัดการข้อมูล</h4>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action" onclick="loadPage('manage_branches.php')">จัดการสาขาในคณะวิศวกรรม</a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="loadPage('manage_subject.php')">จัดการวิชาในเเต่ละสาขา</a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="loadPage('manage_attention.php')">จัดการความสนใจในเเต่ละสาขา</a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="loadPage('.php')">กำหนดค่าความสนใจในเเต่ละสาขา</a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="loadPage('manage_importance_subject.php')">กำหนดค่าความสำคัญของวิชาในเเต่ละสาขา</a>
                </div>
            </div>

            <div class="col-md-9" id="contentContainer">
                <h2 class="text-primary" id="welcomeMessage">Welcome Admin!</h2>
                <!-- เนื้อหาจะถูกแทนที่ที่นี่ -->
            </div>

            <script>
                // ประกาศฟังก์ชันชื่อ loadPage ที่ใช้ async function เพื่อรอให้การดึงข้อมูลแบบ asynchronous ดำเนินการเสร็จสมบูรณ์
                async function loadPage(page) {
                    try {
                        // ใช้ fetch() เพื่อดึงข้อมูลจาก URL ที่กำหนด (page)
                        const response = await fetch(page);

                        // ดึงข้อมูล response ในรูปแบบข้อความ
                        const content = await response.text();

                        // ตรวจสอบว่า element ที่มี id เป็น 'welcomeMessage' มีหรือไม่
                        const welcomeMessageElement = document.getElementById('welcomeMessage');
                        if (welcomeMessageElement) {
                            // กำหนดข้อความใน element นั้น
                            welcomeMessageElement.innerText = 'Welcome Admin to ' + page + '!';
                        } else {
                            // ถ้าไม่พบ element ก็แสดงข้อผิดพลาดใน console
                            console.error('Element with id "welcomeMessage" not found.');
                        }

                        // ตรวจสอบว่า element ที่มี id เป็น 'contentContainer' มีหรือไม่
                        const contentContainerElement = document.getElementById('contentContainer');
                        if (contentContainerElement) {
                            // กำหนดเนื้อหาใน element นั้น
                            contentContainerElement.innerHTML = content;
                        } else {
                            // ถ้าไม่พบ element ก็แสดงข้อผิดพลาดใน console
                            console.error('Element with id "contentContainer" not found.');
                        }
                    } catch (error) {
                        // ถ้ามีข้อผิดพลาดในการดึงข้อมูล แสดงข้อผิดพลาดใน console
                        console.error('Error loading page:', error);
                    }
                }
                async function loadBranchData(branchId) {
                    try {
                        // ใช้ fetch() เพื่อดึงข้อมูลสาขาจาก URL ที่กำหนด
                        const response = await fetch('get_branch_data.php?branch_id=' + branchId);

                        // ดึงข้อมูล response ในรูปแบบ JSON
                        const branchData = await response.json();

                        // แสดงข้อมูลสาขาที่ได้จากฐานข้อมูล
                        console.log(branchData);
                    } catch (error) {
                        // ถ้ามีข้อผิดพลาดในการดึงข้อมูล แสดงข้อผิดพลาดใน console
                        console.error('Error loading branch data:', error);
                    }
                }
            </script>
</body>

</html>

