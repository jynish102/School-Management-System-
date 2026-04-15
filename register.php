<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="CSS/all.css">
</head>
<style>
    body {
        background: url("IMG/bg5.webp") no-repeat center center fixed;
        background-size: cover;
        /* makes sure image fills the whole page */
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .register-container {
        width: 950px;
        height: 550px;
        border-radius: 20px;
        display: flex;
        overflow: hidden;
        border: 6px solid;
        animation: borderColors 6s linear infinite;
        box-shadow: 0 0 30px rgba(10, 50, 0.23, 0.3);
    }

    /* Left side image */
    .register-image {
        flex: 1;
        background: url("IMG/rg_site.gif") no-repeat center center/cover;
    }




    /* Right form */
    .form-box {
        flex: 1;
        background: linear-gradient(135deg, #56ab2f, #00c6ff, #f5af19);
        /* Green gradient */
        /* Blue gradient */
        padding: 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: white;
    }

    /* Border + Shadow Animation */
    @keyframes borderColors {
        0% {
            border-color: #28a745;
            box-shadow: 0 0 25px #28a745;
        }

        33% {
            border-color: #ffc107;
            box-shadow: 0 0 25px #ffc107;
        }

        66% {
            border-color: #dc3545;
            box-shadow: 0 0 25px #dc3545;
        }

        100% {
            border-color: #28a745;
            box-shadow: 0 0 25px #28a745;
        }
    }

    /* Bigger input boxes */
    .form-control {
        height: 55px;
        font-size: 1rem;
        padding-left: 2.8rem;
        border-radius: 12px;
    }

    .input-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 1.2rem;
    }


    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
    }

    button {
        border-radius: 12px;
        height: 50px;
        font-size: 1.1rem;
        font-weight: 600;
    }
</style>

<body>
    <div class="register-container">
        <!-- Left Image -->
        <div class="register-image d-none d-md-block"></div>

        <!-- Right Form -->
        <div class="form-box">
            <h3 class="fw-bold text-center mb-4">Create Account</h3>

            <form action="Action/register-valid.php" method="POST">
                <!-- Full Name -->
                <div class="mb-3 position-relative">
                    <i class="bi bi-person-fill input-icon"></i>
                    <input type="text" autofocus class="form-control" placeholder="Full Name" name="name" required>
                </div>

                <!-- Email -->
                <div class="mb-3 position-relative">
                    <i class="bi bi-envelope-fill input-icon"></i>
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                </div>

                <!-- Username -->
                <div class="mb-3 position-relative">
                    <i class="bi bi-person-badge-fill input-icon"></i>
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>

                <!-- Password -->
                <div class="mb-3 position-relative">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-4 position-relative">
                    <i class="bi bi-shield-lock-fill input-icon"></i>
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                </div>
                <!-- User Type -->
                <div class="mb-3 position-relative">
                    <i class="bi bi-people-fill input-icon"></i>
                    <select class="form-control" name="user_type" required>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        
                    </select>
                </div>


                <!-- Error Modal -->
                <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-danger">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="errorModalLabel">Registration Error</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="errorMessage">
                                <!-- Error text injected here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-success w-100">Register</button>
            </form>

            <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has("error")) {
            const errorMessage = decodeURIComponent(urlParams.get("error"));
            document.getElementById("errorMessage").innerText = errorMessage;
            var myModal = new bootstrap.Modal(document.getElementById("errorModal"));
            myModal.show();
        }
    });
</script>


</html>