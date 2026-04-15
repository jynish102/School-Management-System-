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
            <a class="navbar-brand d-flex align-items-center" href="index.php" target="_blank">
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

    <!-- About Section with Image and Text Overlay -->
    <section id="about" class="position-relative text-center">
        <img src="IMG/Logo3.png" class="img-fluid w-100" alt="About Alpha Schools" style="height:400px; object-fit:cover;">

        <!-- Overlay text -->
        <div class="position-absolute top-50 start-50 translate-middle text-white">
            <h2 class="fw-bold text-primary">About Alpha Group of Schools</h2>
            <p class="lead fw-bold text-primary">Empowering students with knowledge, values, and innovation for a brighter tomorrow.</p>
        </div>
    </section>
    <section class="about-section py-5">
        <div class="container position-relative text-center">

            <!-- BIG BACKGROUND TEXT -->
            <h1 class="big-bg-text">ALPHA</h1>

            <!-- Foreground content -->
            <div class="content position-absolute top-50 start-50 translate-middle">
                <h1 class="text-uppercase fw-bold gradient-text">Who We Are?</h1>
                <h2 class="gradient-text">
                    About <span class="gradient-text">Alpha Group</span>
                </h2>
                <p class="lead text-white">
                    At Alpha, we empower students across four schools with academic excellence,
                    digital skills, and strong values. We focus on modern teaching approaches,
                    extracurricular growth, and future-ready education.
                </p>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row g-4">

                <!-- Mission Card -->
                <div class="col-md-4">
                    <div class="card custom-card mission h-100 text-start">
                        <div class="card-body">
                            <div class="icon-box mb-3">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h4 class="fw-bold">Our Mission</h4>
                            <p>
                                Our mission is to support students in their academic journey by providing reliable digital solutions.
                                From learning resources to performance tracking, we deliver secure, easy-to-use, and affordable tools
                                designed to meet the unique needs of students.
                            </p>

                        </div>
                    </div>
                </div>

                <!-- Vision Card -->
                <div class="col-md-4">
                    <div class="card custom-card vision h-100 text-start">
                        <div class="card-body">
                            <div class="icon-box mb-3">
                                <i class="fas fa-eye"></i>
                            </div>
                            <h4 class="fw-bold">Our Vision</h4>
                            <p>
                                We strive to set new standards in education technology, becoming a trusted platform
                                known for innovative digital solutions that transform the way students learn and grow.
                            </p>

                        </div>
                    </div>
                </div>

                <!-- Core Value Card -->
                <div class="col-md-4">
                    <div class="card custom-card value h-100 text-start">
                        <div class="card-body">
                            <div class="icon-box mb-3">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h4 class="fw-bold">Our Core Value</h4>
                            <p>
                                Our values are rooted in empowering students by encouraging adaptability,
                                promoting continuous learning, and fostering discipline to achieve academic excellence.
                            </p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Why Choose Us Section -->
    <section class="py-5">
        <div class="container text-center mb-5">
            <h2 class="fw-bold" style="color:#1AC6C9;">Why <span style="color:#1AC6C9;">Choose Us</span>?</h2>
            <p style="color:#1AC6C9;">We focus on innovation, trust, and delivering results that matter.</p>
        </div>

        <div class="container">
            <div class="row g-4">

                <!-- Quality -->
                <div class="col-md-4">
                    <div class="card custom-card why quality h-100 text-start">
                        <div class="card-body">
                            <div class="icon-box mb-3">
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="fw-bold">High Quality</h4>
                            <p>
                                We ensure every learning resource and tool meets the highest educational standards,
                                with clear content, reliable performance, and attention to student needs.
                            </p>

                        </div>
                    </div>
                </div>

                <!-- Support -->
                <div class="col-md-4">
                    <div class="card custom-card why support h-100 text-start">
                        <div class="card-body">
                            <div class="icon-box mb-3">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h4 class="fw-bold">24/7 Support</h4>
                            <p>
                                We are available anytime to assist students, providing guidance and technical support
                                to ensure uninterrupted learning and access to resources.
                            </p>

                        </div>
                    </div>
                </div>

                <!-- Innovation -->
                <div class="col-md-4">
                    <div class="card custom-card why innovation h-100 text-start">
                        <div class="card-body">
                            <div class="icon-box mb-3">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h4 class="fw-bold">Innovation</h4>
                            <p>
                                We bring fresh, creative ideas to enhance the student learning experience,
                                making education more engaging, interactive, and effective.
                            </p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php include('footer.php') ?>