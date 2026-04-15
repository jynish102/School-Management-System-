<?php
session_start();
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Get logged-in user info
$user_id = $_SESSION['user_id'];
$user_type = strtolower($_SESSION['user_type']);

// Initialize
$class_id = '';
$section_id = '';
$class_name = '';
$section_name = '';

// ✅ If student logged in → fetch their class & section automatically
if ($user_type === 'student') {
    $meta_query = mysqli_query($db_conn, "SELECT meta_key, meta_value FROM usermeta WHERE user_id='$user_id'");
    $meta = [];
    while ($row = mysqli_fetch_assoc($meta_query)) {
        $meta[$row['meta_key']] = $row['meta_value'];
    }

    $class_name = $meta['class'] ?? '';
    $section_name = $meta['section'] ?? '';

    // Get class_id and section_id from actual tables
    $class_res = mysqli_query($db_conn, "SELECT id FROM classes WHERE class='$class_name'");
    $section_res = mysqli_query($db_conn, "SELECT id FROM section WHERE title='$section_name'");

    $class_data = mysqli_fetch_assoc($class_res);
    $section_data = mysqli_fetch_assoc($section_res);

    $class_id = $class_data['id'] ?? '';
    $section_id = $section_data['id'] ?? '';
}

// ✅ If Admin or Teacher → allow dropdown filter
if ($user_type !== 'student') {
    $class_id = $_GET['class_id'] ?? '';
    $section_id = $_GET['section_id'] ?? '';

    $class_query = mysqli_query($db_conn, "SELECT * FROM classes ORDER BY class ASC");
    $section_query = mysqli_query($db_conn, "SELECT * FROM section ORDER BY title ASC");

    if (!empty($class_id) && !empty($section_id)) {
        $class_info = mysqli_fetch_object(mysqli_query($db_conn, "SELECT * FROM classes WHERE id='$class_id'"));
        $section_info = mysqli_fetch_object(mysqli_query($db_conn, "SELECT * FROM section WHERE id='$section_id'"));

        $class_name = $class_info->class ?? 'N/A';
        $section_name = $section_info->title ?? 'N/A';
    }
}

$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
?>

<main class="app-main p-4" style="flex:1; min-height:100vh;">
    <h2 class="fw-bold text-primary mb-4">
        <?= ucfirst($user_type) ?> Timetable
    </h2>

    <!-- 🧩 FILTER (only visible for Admin or Teacher) -->
    <?php if ($user_type !== 'student'): ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white">Filter by Class & Section</div>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Class</label>
                            <select name="class_id" class="form-control" required>
                                <option value="">-- Select Class --</option>
                                <?php while ($cls = mysqli_fetch_object($class_query)) { ?>
                                    <option value="<?= $cls->id ?>" <?= ($class_id == $cls->id ? 'selected' : '') ?>>
                                        <?= htmlspecialchars($cls->class) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Section</label>
                            <select name="section_id" class="form-control" required>
                                <option value="">-- Select Section --</option>
                                <?php
                                mysqli_data_seek($section_query, 0);
                                while ($sec = mysqli_fetch_object($section_query)) { ?>
                                    <option value="<?= $sec->id ?>" <?= ($section_id == $sec->id ? 'selected' : '') ?>>
                                        <?= htmlspecialchars($sec->title) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-4 align-self-end">
                            <button type="submit" class="btn btn-primary w-100">View Timetable</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($class_id) && !empty($section_id)) {
        $time_slots = mysqli_query(
            $db_conn,
            "SELECT DISTINCT time_slot FROM timetable 
             WHERE class_id = '$class_id' AND section_id = '$section_id' 
             ORDER BY time_slot ASC"
        );
    ?>

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                Timetable for Class: <?= htmlspecialchars($class_name) ?> | Section: <?= htmlspecialchars($section_name) ?>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Time</th>
                            <?php foreach ($days as $day): ?>
                                <th><?= $day ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        while ($slot = mysqli_fetch_object($time_slots)) {
                            echo "<tr>";
                            echo "<td>{$count}</td>";
                            echo "<td>{$slot->time_slot}</td>";

                            foreach ($days as $day) {
                                $res = mysqli_query(
                                    $db_conn,
                                    "SELECT sub.subject_name, acc.name AS teacher
                                     FROM timetable t
                                     LEFT JOIN subject sub ON t.subject_id = sub.id
                                     LEFT JOIN account acc ON t.teacher_id = acc.id
                                     WHERE t.class_id = '$class_id'
                                       AND t.section_id = '$section_id'
                                       AND t.time_slot = '{$slot->time_slot}'
                                       AND t.day = '$day'"
                                );
                                $entry = mysqli_fetch_object($res);

                                echo "<td>";
                                if ($entry) {
                                    echo "<b>{$entry->subject_name}</b><br><small>{$entry->teacher}</small>";
                                } else {
                                    echo "-";
                                }
                                echo "</td>";
                            }

                            echo "</tr>";
                            $count++;
                        }

                        if ($count == 1) {
                            echo "<tr><td colspan='8' class='text-muted'>No timetable found for this class & section.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } elseif ($user_type === 'student') { ?>
        <div class="alert alert-warning">No timetable found for your assigned class and section.</div>
    <?php } ?>
</main>

<?php include('footer.php'); ?>