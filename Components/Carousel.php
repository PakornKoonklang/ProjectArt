<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center Text</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .carousel {
            height: 100vh; /* ให้ Carousel เต็มความสูงของ viewport */
        }
        .carousel-inner {
            height: 100%;
        }
        .carousel-item img {
            object-fit: cover; /* ให้รูปภาพครอบคลุมพื้นที่ทั้งหมด */
        }
        .footer {
            text-align: center;
            padding: 1rem;
            background-color: #f8f9fa; /* เปลี่ยนสีพื้นหลังตามต้องการ */
        }
        .full-height {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .flex-grow-1 {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="full-height d-flex flex-column">
        <div id="carouselExampleFade" class="carousel slide carousel-fade flex-grow-1">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="Img/001.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="Img/003.jpg" class="d-block w-100" alt="...">
                 
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="footer">
            ©2024 RMUTI.AC.TH. ALL RIGHTS RESERVED.
        </div>
    </div>

    <script src="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
