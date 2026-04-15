<?php
session_start();
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// ✅ Get logged-in user info
$user_id = $_SESSION['user_id'];
$user_type = strtolower($_SESSION['user_type'] ?? '');

// Redirect if not student
if ($user_type !== 'student') {
    echo "<div class='alert alert-danger m-4'>Access Denied. Only students can view this page.</div>";
    include('footer.php');
    exit;
}

// ✅ Fetch class and section from usermeta
$meta = [];
$meta_query = mysqli_query($db_conn, "SELECT meta_key, meta_value FROM usermeta WHERE user_id='$user_id'");
while ($m = mysqli_fetch_assoc($meta_query)) {
    $meta[$m['meta_key']] = $m['meta_value'];
}

$class_name = $meta['class'] ?? '';
$section_name = $meta['section'] ?? '';

if (!$class_name || !$section_name) {
    echo "<div class='alert alert-warning m-4'>Your class and section are not assigned yet. Please contact your admin.</div>";
    include('footer.php');
    exit;
}

// ✅ Fetch class & section IDs
$class_res = mysqli_query($db_conn, "SELECT id FROM classes WHERE class='$class_name'");
$section_res = mysqli_query($db_conn, "SELECT id FROM section WHERE title='$section_name'");
$class_data = mysqli_fetch_assoc($class_res);
$section_data = mysqli_fetch_assoc($section_res);
$class_id = $class_data['id'] ?? 0;
$section_id = $section_data['id'] ?? 0;

// ✅ Fetch student’s attendance records
$attendance_query = mysqli_query($db_conn, "
    SELECT date, status 
    FROM attendance 
    WHERE student_id = '$user_id' 
      AND class_id = '$class_id'
    ORDER BY date DESC
");
?>

<main class="app-main p-4" style="flex:1; min-height:100vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">My Attendance</h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            Attendance Summary — <?= htmlspecialchars($class_name) ?> (<?= htmlspecialchars($section_name) ?>)
        </div>
        <div class="card-body">
            <?php if (mysqli_num_rows($attendance_query) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $present = $absent = $late = 0;
                            while ($row = mysqli_fetch_assoc($attendance_query)) {
                                if ($row['status'] == 'Present') $present++;
                                if ($row['status'] == 'Absent') $absent++;
                                if ($row['status'] == 'Late') $late++;

                                $status_class = match ($row['status']) {
                                    'Present' => 'text-success fw-bold',
                                    'Absent' => 'text-danger fw-bold',
                                    'Late' => 'text-warning fw-bold',
                                    default => '',
                                };
                                echo "<tr>
                                        <td>{$count}</td>
                                        <td>{$row['date']}</td>
                                        <td class='{$status_class}'>{$row['status']}</td>
                                      </tr>";
                                $count++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- ✅ Summary -->
                <div class="mt-3">
                    <h5 class="fw-semibold">Summary:</h5>
                    <ul class="list-unstyled mb-0">
                        <li>✅ Present: <?= $present ?></li>
                        <li>❌ Absent: <?= $absent ?></li>
                        <li>⚠️ Late: <?= $late ?></li>
                        <li>📅 Total Records: <?= ($present + $absent + $late) ?></li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="alert alert-info">No attendance records found for you yet.</div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>