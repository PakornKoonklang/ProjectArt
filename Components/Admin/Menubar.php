<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 320px;
            background-color: #f1f1f1;
        }

        li a {
            display: block;
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
        }

        li a.active {
            background-color: #3333FF;
            color: white;
        }

        li a:hover:not(.active) {
            background-color: #555;
            color: white;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>
    <h4>การจัดการข้อมูล</h4>
    <ul>
        <li><a class="active" href="../Manage/admin_dashboard.php">Home</a></li>
        <li><a href="../Manage/manage_member.php">จัดการรายชื่อAdmin</a></li>
        <li><a href="#about">จัดการสถานะ</a></li>
        <li><a href="#about">จัดการระดับชั้น</a></li>
        <li><a href="../Manage/manage_branches.php">จัดการสาขาที่อยู่ในคณะวิศวกรรมศาสตร์</a></li>
        <li><a href="../Manage/manage_attention.php">จัดการรายชื่อความสนใจ</a></li>
        <li><a href="#about">จัดการค่าความสนใจในเเต่ละวิชา</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">กำหนดค่าความสำคัญของวิชาในเเต่ละสาขา</a>
            <ul class="dropdown-menu">
                <li><a href="../Manage/manage_importance_subject6.php">ม.6</a></li>
                <li><a href="../Manage/manage_importance_subject3.php">ปวช.</a></li>
                <li><a href="../Manage/manage_importance_subject2.php">ปวส.</a></li>
            </ul>
        </li>
    </ul>

    <script src="https://kit.fontawesome.com/c233baf144.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
