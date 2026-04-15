<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-pic {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #007bff;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        .navbar-profile-btn {
            border: none;
            background: transparent;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- Navbar (Example with Profile Button) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">School Admin</a>

            <div class="d-flex align-items-center">
                <!-- Profile Button (No redirect) -->
                <button class="navbar-profile-btn" data-bs-toggle="modal" data-bs-target="#adminProfileModal">
                    <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Admin" title="View Profile">
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h3>Welcome to the Admin Dashboard</h3>
        <!-- Other content goes here -->
    </div>

    <!-- Profile Modal (No Redirect, Static Info) -->
    <div class="modal fade" id="adminProfileModal" tabindex="-1" aria-labelledby="adminProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">

                <div class="modal-header">
                    <h5 class="modal-title" id="adminProfileModalLabel">Admin Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Profile Picture -->
                    <img src="https://via.placeholder.com/120" alt="Profile Picture" class="profile-pic mb-3">

                    <!-- Static Details -->
                    <h4>John Doe</h4>
                    <p><strong>Email:</strong> admin@example.com</p>
                    <p><strong>Designation:</strong> School Administrator</p>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>