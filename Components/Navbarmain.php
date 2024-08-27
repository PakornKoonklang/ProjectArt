<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบแนะนำเข้าศึกษาต่อคณะวิศวกรรมศาสตร์และเทคโนโลยี</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c233baf144.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .navbar-custom {
            background-color: #F1C353;
        }

     

        .modal-header-custom {
            background-color: #F1C353;
        }
        
    
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i> หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Branch_information/lnformation.php"><i class="fa-solid fa-users-line"></i> ข้อมูลสาขาทั้งหมด</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownForms" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-list"></i> แบบฟอร์มรายวิชาพื้นฐานและด้านที่สนใจ
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownForms">
                            <li><a class="dropdown-item" href="form1/formgrade.php">ระดับ ม.6</a></li>
                            <li><a class="dropdown-item" href="form2/formgrade.php">ระดับ ปวช.</a></li>
                            <li><a class="dropdown-item" href="form3/formgrade.php">ระดับ ปวส.</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="Login/login.php" class="btn btn-custom">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> เข้าสู่ระบบ
                </a>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title" id="staticBackdropLabel"><i class="fa-solid fa-right-to-bracket"></i> Login Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="Username" class="form-label"><i class="fa-solid fa-user-tie"></i> Username</label>
                            <input type="text" class="form-control" id="Username">
                        </div>
                        <div class="mb-3">
                            <label for="Passsword" class="form-label"><i class="fa-solid fa-key"></i> Password</label>
                            <input type="password" class="form-control" id="Passsword">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNIPxtqylfPjrYBkARQ8ZmJQ9DBFHBVuJ0hxK3DAKZp30PC5pdxIMjV7KcsTSrU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cL8c3X6MEbSDU5O/sm6Jw5nCJ6yUw3td9k6rmYNeDQmC2QgydmDF++lr8ODoSFGp" crossorigin="anonymous"></script>
</body>

</html>
