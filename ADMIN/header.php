<?php
include('../includes/config.php');

// ✅ Get current logged-in user info
$user_id = $_SESSION['user_id'] ?? 0;
$role = $_SESSION['user_Type'] ?? '';

// Fetch from accounts
$user_q = mysqli_query($db_conn, "SELECT name, email, user_Type,image FROM account WHERE id='$user_id'");
$user = mysqli_fetch_assoc($user_q);

$name  = $user['name'] ?? 'Unknown';
$email = $user['email'] ?? 'N/A';
$role  = ucfirst($user['user_Type'] ?? 'User');
$image = !empty($user['image'])
    ? "../" . htmlspecialchars($user['image'])
    : "https://cdn-icons-png.flaticon.com/512/3135/3135715.png";

// Extra info (from usermeta)
$class = $section = $subject = '';

if ($role === 'Teacher') {
    $meta_q = mysqli_query($db_conn, "SELECT meta_key, meta_value FROM usermeta WHERE user_id='$user_id'");
    while ($row = mysqli_fetch_assoc($meta_q)) {
        if ($row['meta_key'] === 'class') $class = $row['meta_value'];
        if ($row['meta_key'] === 'subject') $subject = $row['meta_value'];
    }
} elseif ($role === 'Student') {
    $meta_q = mysqli_query($db_conn, "SELECT meta_key, meta_value FROM usermeta WHERE user_id='$user_id'");
    while ($row = mysqli_fetch_assoc($meta_q)) {
        if ($row['meta_key'] === 'class') $class = $row['meta_value'];
        if ($row['meta_key'] === 'section') $section = $row['meta_value'];
    }
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/i2.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet" />


</head>


<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">My Dashboard</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#userProfileModal">Profile</a>
                </li>

                <li class="nav-item"><a href="../logout.php" class="nav-link">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="d-flex">

        <!-- 🌈 User Profile Modal -->
        <div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                    <!-- Header with gradient background -->
                    <div class="modal-header border-0 bg-primary bg-gradient text-white">
                        <h5 class="modal-title w-100 fw-semibold" id="userProfileModalLabel">
                            <i class="bi bi-person-circle me-2"></i><?= htmlspecialchars($role) ?> Profile
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Body with soft background color -->
                    <div class="modal-body text-center bg-light">
                        <div class="position-relative d-inline-block mb-3">
                            <img
                                src="<?= htmlspecialchars($image) ?>"
                                alt="Profile Picture"
                                class="rounded-circle shadow-lg border border-3 border-white"
                                id="profileImagePreview"
                                style="width:120px; height:120px; object-fit:cover;">

                            <!-- Camera icon overlay -->
                            <span
                                class="position-absolute bottom-0 end-0 bg-white border border-light rounded-circle p-2 shadow-sm"
                                id="editImageBtn"
                                style="cursor:pointer;">
                                <i class="bi bi-camera-fill text-primary"></i>
                            </span>
                        </div>

                        <div id="viewProfile">
                            <h4 class="fw-bold text-dark mb-1"><?= htmlspecialchars($name) ?></h4>
                            <p class="text-secondary mb-1"><i class="bi bi-envelope"></i> <?= htmlspecialchars($email) ?></p>
                        </div>

                        <!-- Editable form (hidden by default) -->
                        <div id="editProfile" class="d-none">
                            <input type="text" id="editName" class="form-control mb-2" value="<?= htmlspecialchars($name) ?>">
                            <input type="email" id="editEmail" class="form-control mb-2" value="<?= htmlspecialchars($email) ?>">
                        </div>


                        <?php if ($role === 'Teacher'): ?>
                            <p class="text-secondary mb-0"><i class="bi bi-journal-bookmark"></i> Subject: <?= htmlspecialchars($subject ?: 'N/A') ?></p>
                            <p class="text-secondary"><i class="bi bi-easel"></i> Class: <?= htmlspecialchars($class ?: 'N/A') ?></p>
                        <?php elseif ($role === 'Student'): ?>
                            <p class="text-secondary mb-0"><i class="bi bi-easel"></i> Class: <?= htmlspecialchars($class ?: 'N/A') ?></p>
                            <p class="text-secondary"><i class="bi bi-grid"></i> Section: <?= htmlspecialchars($section ?: 'N/A') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Footer with gradient accent -->
                    <div class="modal-footer border-0 justify-content-center bg-primary bg-gradient">
                        <button type="button" class="btn btn-light px-4" id="openEditDetails">
                            <i class="bi bi-pencil-fill me-1"></i>Edit
                        </button>
                        <button type="button" id="saveProfileBtn" class="btn btn-success px-4 d-none">Save</button>
                        <button type="button" class="btn btn-outline-light px-4" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
      
        <!-- Hidden File Input -->
        <input type="file" id="profileImageInput" accept="image/*" class="d-none">

        <!-- Crop Image Modal -->
        <div class="modal fade" id="cropImageModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-light">
                    <div class="modal-header">
                        <h5 class="modal-title">Crop Profile Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="imageToCrop" style="max-width:100%;" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" id="cropAndUploadBtn">Save</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>