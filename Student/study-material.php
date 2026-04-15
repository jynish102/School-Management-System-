<?php
session_start();
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// ✅ Check if logged in & is student
if (!isset($_SESSION['user_id']) || strtolower($_SESSION['user_type']) != 'student') {
    echo "<div class='alert alert-danger m-4'>Access Denied. Students only.</div>";
    include('footer.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// ✅ Get student's class from usermeta
$class_meta = mysqli_query($db_conn, "SELECT meta_value FROM usermeta WHERE user_id='$user_id' AND meta_key='class'");
$class_row = mysqli_fetch_assoc($class_meta);
$class_name = $class_row['meta_value'] ?? '';

if (!$class_name) {
    echo "<div class='alert alert-warning m-4'>Your class is not assigned yet. Please contact your admin.</div>";
    include('footer.php');
    exit;
}

// ✅ Fetch class_id from classes table
$class_q = mysqli_query($db_conn, "SELECT id FROM classes WHERE class='$class_name'");
$class_data = mysqli_fetch_object($class_q);
$class_id = $class_data->id ?? 0;

if (!$class_id) {
    echo "<div class='alert alert-warning m-4'>Invalid class detected. Please contact your admin.</div>";
    include('footer.php');
    exit;
}

// ✅ Fetch study materials for this class
$query = mysqli_query($db_conn, "SELECT * FROM study_materials WHERE class_id='$class_id' ORDER BY uploaded_date DESC");
?>

<main class="app-main p-4" style="flex:1; min-height:100vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📘 My Study Materials</h2>
    </div>

    <!-- CLASS HEADER -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top">
            <span>Study Materials for <b><?= htmlspecialchars($class_name) ?></b></span>
        </div>
    </div>

    <!-- MATERIAL LIST -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-secondary text-white">Available Materials</div>
        <div class="card-body table-responsive bg-white">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Download</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    if (mysqli_num_rows($query) > 0) {
                        while ($mat = mysqli_fetch_object($query)) {
                            $sub = mysqli_fetch_object(mysqli_query($db_conn, "SELECT subject_name FROM subject WHERE id='$mat->subject_id'"));
                    ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= htmlspecialchars($mat->title) ?></td>
                                <td><?= $sub ? htmlspecialchars($sub->subject_name) : '-' ?></td>
                                <td>
                                    <a href="../uploads/study_materials/<?= htmlspecialchars($mat->file_path) ?>"
                                        target="_blank"
                                        class="btn btn-info btn-sm">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($mat->uploaded_date) ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No study materials uploaded for your class yet.
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>