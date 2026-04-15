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

    <!-- Page Title -->
    <div class="container my-5 text-center">
        <h1 class="page-title gradient-text">Contact Us</h1>
        <p class="lead text-light">We’re here to answer your questions. Reach out to us anytime.</p>
    </div>

    <!-- Contact Form and Info -->
    <div class="container mb-5">
        <div class="row g-4">

            <!-- Contact Form -->
            <div class="col-md-7">
                <div class="form-container">
                    <form action="./Action/contact_submit.php" method="POSt">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Your full name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="Enter subject like (Addmision,any other)" required>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" rows="4" placeholder="Type your message..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 form-control">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-md-5">
                <div class="info-box">
                    <h5>School Contact Information</h5>
                    <i class="bi bi-geo-alt-fill text-primary"> Addresh : </i>
                    <p class="lead">
                    <ul>
                        <li>Laxminagar Society, A, G I D C-Ii, Sadar Baug, Junagadh - 362001.</li>
                        <li> Laxmi Nagar Marg, Near Deep Jyoti Palace, Junagadh, Gujarat, 362001</li>
                        <li>GF63+J24, Jayshree Rd, Rayjibaug, Talav Gate, Junagadh, Gujarat 362001</li>
                    </ul>
                    </p>
                    <p><strong>Email:</strong> info@schoolname.edu</p>
                    <p><strong>Phone:</strong> (123) 456-7890</p>

                    <h6 class="mt-4">Operating Hours</h6>
                    <p>Monday – Saturday: 7:00 AM – 6:00 PM</p>
                    <p>Closed on weekends and holidays</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Google Map -->
    <div class="container mb-5">
        <h4 class="text-light mb-3">Our Location</h4>
        <div class="ratio ratio-16x9">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3805798.531128841!2d77.0!3d20.5937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff5ef1c6f3f%3A0x80f7c5b0bbf8d0f9!2sIndia!5e0!3m2!1sen!2sin!4v1635030483000!5m2!1sen!2sin"
                width="600"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>

        </div>
    </div>




    <?php include('footer.php') ?>