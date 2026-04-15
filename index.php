<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Management System</title>
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
          <li  class="nav-item"><a class="btn   text-white ms-2" href="login.php">Login</a></li>
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
        <img src="IMG/caro1.jpeg" class="d-block w-100" alt="School Image 1">
        <div class="carousel-caption d-flex flex-column justify-content-center h-100 ">
          <h1 class="display-4 fw-bold text-light">Manage Your School Smarter</h1>
          <p class="lead text-light">A complete ERP solution for schools, colleges, and institutions</p>
          <a href="register.php" class="btn btn-primary" role="button">Get Started</a>
        </div>

      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <img src="IMG/caro2.png" class="d-block w-100" alt="School Image 2">
        <div class="carousel-caption d-flex flex-column justify-content-center h-100">
          <h1 class="display-4 fw-bold text-light">Empower Teachers & Students</h1>
          <p class="lead text-light">Smart dashboards for teachers, students, and parents</p>

        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <img src="IMG/caro3.jpg" class="d-block w-100" alt="School Image 3">
        <div class="carousel-caption d-flex flex-column justify-content-center h-100">
          <h1 class="display-4 fw-bold text-light">Track Performance & Growth</h1>
          <p class="lead text-light">Attendance, results, and fees in one place</p>
          <a href="about.php" class="btn btn-primary">Learn More</a>
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



  <!-- Features -->
  <section class="container my-5">
    <div class="text-center mb-4">
      <h2 class="fw-bold text-white">Core Features</h2>
      <p class=" text-white">Everything you need to run your school in one place</p>
    </div>
    <div class=" row g-4">
      <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4 box-shadow">
          <i class="bi bi-people fs-1 text-primary"></i>
          <h5 class="mt-3">Student Management</h5>
          <p class="text-muted">Manage student profiles, attendance, grades, and performance.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <i class="bi bi-mortarboard fs-1 text-warning"></i>
          <h5 class="mt-3">Teacher Dashboard</h5>
          <p class="text-muted">Tools for teachers to manage classes, assignments, and results.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <i class="bi bi-cash-coin fs-1 text-success"></i>
          <h5 class="mt-3">Fees & Accounts</h5>
          <p class="text-muted">Track and manage school fees, expenses, and accounts.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Stats -->







  
  <section class=" text-center py-5 ">
    <div class="container">
      <div class="row">
        <div class="col-md-4 " id="1">
          <h3 class="text-primary">500+</h3>
          <p class="text-primary">Students</p>
        </div>
        <div class="col-md-4">
          <h3 class="text-warning">50+</h3>
          <p class="text-primary">Teachers</p>
        </div>
        <div class="col-md-4">
          <h3 class="text-danger">10+</h3>
          <p class="text-primary">Years of Excellence</p>
        </div>
        
      </div>
      
    </div>
  </section>





  <?php include('footer.php') ?>