<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/all.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="IMG/Logo3.png" alt="JYNISH Logo"
                    style="height:65px; width:auto; object-fit:contain;">
                <span class="ms-2 fw-bold text-light">Alpha Education Group</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link " href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="features.php">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="btn text-white ms-2" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <!-- Hero Carousel -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img src="IMG/asp1.png" class="d-block w-100" alt="School Image 1">
                <div class="carousel-caption d-flex flex-column justify-content-center h-100 ">
                    <i class="bi bi-geo-alt-fill text-primary"> Addresh: </i>
                    <p class="lead text-primary bg-white">Laxminagar Society, A, G I D C-Ii, Sadar Baug, Junagadh - 362001. </p>

                </div>

            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="IMG/asp2.png" class="d-block w-100" alt="School Image 2">
                <div class="carousel-caption d-flex flex-column justify-content-center h-100">
                    <i class="bi bi-geo-alt-fill text-primary"> Addresh: </i>
                    <p class="lead text-primary bg-white">Laxmi Nagar Marg, Near Deep Jyoti Palace, Junagadh, Gujarat, 362001</p>

                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <img src="IMG/asp3.webp" class="d-block w-100" alt="School Image 3">
                <div class="carousel-caption d-flex flex-column justify-content-center h-100">
                    <i class="bi bi-geo-alt-fill text-primary"> Addresh: </i>
                    <p class="lead text-primary bg-white">GF63+J24, Jayshree Rd, Rayjibaug, Talav Gate, Junagadh, Gujarat 362001</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

    <!-- Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>

    <!-- ✉️ Envelopes Section -->
    <section class="envelope-section text-center container">
        <h2 class="mb-4">Our Achievements</h2>
        <div class="row justify-content-center">
            <!-- Envelope 1 -->
            <div class="col-md-4">
                <i class="fa-solid fa-envelope envelope-icon" data-bs-toggle="modal" data-bs-target="#envelope1"></i>
            </div>
            <!-- Envelope 2 -->
            <div class="col-md-4">
                <i class="fa-solid fa-envelope envelope-icon" data-bs-toggle="modal" data-bs-target="#envelope2"></i>
            </div>
            <!-- Envelope 3 -->
            <div class="col-md-4">
                <i class="fa-solid fa-envelope envelope-icon" data-bs-toggle="modal" data-bs-target="#envelope3"></i>
            </div>
        </div>
    </section>

    <!-- 🖼 Modals for Envelopes -->
    <div class="modal fade" id="envelope1" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="IMG/home_bg.jpg" class="img-fluid" alt="School Achievement 1">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="envelope2" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="your-image2.png" class="img-fluid" alt="School Achievement 2">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="envelope3" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="your-image3.png" class="img-fluid" alt="School Achievement 3">
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php') ?>