<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php" style="font-size: 16px;">ระบบแนะนำเข้าศึกษาต่อคณะวิศวกรรมศาสตร์และเทคโนโลยี</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i> Home</a>
        </li>
      
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-list"></i> แบบฟอร์มรายวิชาพื้นฐานและด้านที่สนใจ
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="form1/formgrade12.php">ระดับ ม.6</a></li>
            <li><a class="dropdown-item" href="form2/formgradeVc.php">ระดับ ปวช.</a></li>
            <li><a class="dropdown-item" href="form3/formgradeHvc.php">ระดับ ปวส.</a></li>
          </ul>
      </ul>

      <!-- Button trigger modal -->
      <a href="Login/login.php" class="btn btn-primary"><i class="fa-solid fa-arrow-right-to-bracket"></i> ผู้ดูแลระบบ เข้าสู่ระบบ</a>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa-solid fa-right-to-bracket"></i> Login Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<!-- login -->
      <form>
  <div class="mb-3">
    <label for="username" class="form-label"><i class="fa-solid fa-user-tie"></i>Username</label>
    <input type="text" class="form-control" id="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label"><i class="fa-solid fa-key"></i>Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
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
        
    </div>
  </div>
</nav>
<script src="https://kit.fontawesome.com/c233baf144.js" crossorigin="anonymous"></script>