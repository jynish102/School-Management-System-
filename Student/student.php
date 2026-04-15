<?php
session_start();

// Prevent cached version of the page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// Check login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: ../login.php");
    exit();
}

include('header.php');
// Check if user is logged in and is an admin
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || strtolower($_SESSION['user_type']) !== 'student') {
    // Not logged in or not an admin – redirect to login or registration page
    header("Location: ../login.php?error=Access denied. Please login as admin.");
    exit();
}


// ✅ Get logged-in admin details
$user_id = $_SESSION['user_id'];       // numeric ID from database
$user_name = $_SESSION['user_name'];   // name from login
$user_type = $_SESSION['user_type'];   // should be "Admin"
$color = match ($user_type) {
    'Admin' => 'text-danger',
    'Teacher' => 'text-warning',
    'Student' => 'text-success',
    default => 'text-secondary'
};
?>
<?php include('sidebar.php'); ?>
<?php include('dashboard.php'); ?>
<!-- ✅ Login Success Modal -->
<div class="modal fade" id="loginSuccessModal" tabindex="-1" aria-labelledby="loginSuccessLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="loginSuccessLabel">Login Successful 🎉</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <img src="https://i.gifer.com/7efs.gif" alt="Success" style="width: 100px; margin-bottom: 15px;">

                <!-- ✅ Dynamic Welcome Message -->
                <h5>
                    Welcome, <strong><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></strong>!
                </h5>

                <p class="text-muted">
                    You have logged in successfully as
                    <span class="fw-bold <?php echo $color; ?>">
                        <?php echo htmlspecialchars($user_type); ?>
                    </span>.
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
</div>

<?php
// ✅ Show modal only once per login
if (isset($_SESSION['show_login_modal'])) {
    echo "
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('loginSuccessModal'));
        myModal.show();
      });
    </script>";
    unset($_SESSION['show_login_modal']);
}
?>





<?php include('footer.php'); ?>