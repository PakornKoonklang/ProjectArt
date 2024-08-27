<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ตรวจสอบว่ามีค่า admin_level_Id ในเซสชันหรือไม่
$admin_level_id = isset($_SESSION['admin_level_Id']) ? $_SESSION['admin_level_Id'] : 10;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูล</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Your custom styles */
        .nav-link.active {
            background-color: #007bff !important;
            color: white !important;
        }
        
        /* Remove shadow from sidebar */
        .main-sidebar {
            box-shadow: none !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Common Menu Items -->
                        <li class="nav-item">
                            <a id="home-link" href="../Edit/admin_dashboard.php" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>

                        <?php if ($admin_level_id == 10): ?>
                            <!-- Admin Level 10 Menu Items -->

                            <li class="nav-item">
                                <a id="manage-member-link" href="../Manage/manage_member.php" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>จัดการรายชื่อAdmin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="manage-admin-level-link" href="../Manage/manage_admin_level.php" class="nav-link">
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>จัดการสถานะ</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="manage-branches-link" href="../Manage/manage_branches.php" class="nav-link">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>จัดการสาขาที่อยู่ในคณะวิศวกรรมศาสตร์</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="manage-attention-link" href="../Manage/manage_attention.php" class="nav-link">
                                    <i class="nav-icon fas fa-eye"></i>
                                    <p>จัดการรายชื่อความสนใจ</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="manage-attention-importance-link" href="../Manage/manage_attention_importance.php" class="nav-link">
                                    <i class="nav-icon fas fa-star"></i>
                                    <p>จัดการค่าด้านความสนใจในสาขา</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" id="manage-subjects" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        จัดการรายวิชา
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a id="manage-subjectM6-link" href="../Manage/manage_subjectM6.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ม.6</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="manage-subjectvc-link" href="../Manage/manage_subjectvc.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ปวช.</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="manage-subjectvcc-link" href="../Manage/manage_subjectvcc.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ปวส.</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" id="manage-importance" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        กำหนดค่าความสำคัญของวิชาในแต่ละสาขา
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a id="manage-importance-subjectm6-link" href="../Manage/manage_importance_subjectm6.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ม.6</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="manage-importance-subjectvc-link" href="../Manage/manage_importance_subjectvc.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ปวช.</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="manage-importance-subjectvcc-link" href="../Manage/manage_importance_subjectvcc.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ปวส.</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php elseif ($admin_level_id >= 1001 && $admin_level_id <= 1016): ?>
                            <!-- Non-Admin Level 10 Menu Items -->

                            <li class="nav-item">
                                <a id="manage-branches-link" href="../Manage/manage_branches.php" class="nav-link">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>จัดการสาขาที่อยู่ในคณะวิศวกรรมศาสตร์</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a id="manage-attention-importance-link" href="../Manage/Manage_attention_importance.php" class="nav-link">
                                    <i class="nav-icon fas fa-star"></i>
                                    <p>จัดการค่าด้านความสนใจในสาขา</p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="#" id="manage-importance" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        กำหนดค่าความสำคัญของวิชาในแต่ละสาขา
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a id="manage-importance-subjectm6-link" href="../Manage/manage_importance_subjectm6.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ม.6</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="manage-importance-subjectvc-link" href="../Manage/manage_importance_subjectvc.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ปวช.</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="manage-importance-subjectvcc-link" href="../Manage/manage_importance_subjectvcc.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>ปวส.</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- Custom Script for Active Menu Management -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let lastActiveMenuId = localStorage.getItem('activeLinkId') || 'home-link';

            function setActiveLink() {
                document.querySelectorAll('.nav-link').forEach(function(link) {
                    link.classList.remove('active');
                });

                const activeLink = document.getElementById(lastActiveMenuId);
                if (activeLink) {
                    activeLink.classList.add('active');

                    // ตรวจสอบการทำงานของการเปิดเมนูย่อย
                    const parentMenu = activeLink.closest('.nav-treeview');
                    if (parentMenu) {
                        parentMenu.classList.add('show');
                        parentMenu.closest('.nav-item.has-treeview').classList.add('menu-open');
                        console.log("เปิดเมนูย่อย: ", parentMenu);
                    }

                    const parentMenuLink = activeLink.closest('.nav-item.has-treeview').querySelector('.nav-link');
                    if (parentMenuLink) {
                        parentMenuLink.classList.add('active');
                    }
                }
            }

            function saveActiveLink(event) {
                const target = event.target.closest('.nav-link');
                if (target) {
                    lastActiveMenuId = target.id;
                    localStorage.setItem('activeLinkId', lastActiveMenuId);
                    console.log("บันทึกเมนูที่เลือก: ", lastActiveMenuId);
                }
            }

            function handleMenuClick(event) {
                const target = event.target.closest('.nav-link');
                if (target) {
                    const subMenu = target.nextElementSibling;

                    // ปิดเมนูย่อยอื่นๆ
                    document.querySelectorAll('.nav-treeview').forEach(function(menu) {
                        if (menu !== subMenu) {
                            menu.classList.remove('show');
                            menu.closest('.nav-item.has-treeview').classList.remove('menu-open');
                        }
                    });

                    // สลับการแสดงผลของเมนูย่อย
                    if (subMenu && subMenu.classList.contains('nav-treeview')) {
                        subMenu.classList.toggle('show');
                        subMenu.closest('.nav-item.has-treeview').classList.toggle('menu-open');
                        console.log("สลับการแสดงผลเมนูย่อย: ", subMenu);
                        if (subMenu.classList.contains('show')) {
                            saveActiveLink(event);
                        }
                    } else {
                        saveActiveLink(event);
                    }
                }
            }

            document.querySelectorAll('.nav-link').forEach(function(link) {
                link.addEventListener('click', handleMenuClick);
            });

            setActiveLink();
        });
    </script>
</body>

</html>
