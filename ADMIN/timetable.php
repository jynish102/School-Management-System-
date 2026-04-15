<?php
include('../includes/config.php');

// Define days
$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

// ✅ ADD timetable entry
if (isset($_POST['submit'])) {
    $class_id   = $_POST['class_id'];
    $section_id = $_POST['section_id'];
    $time_slot  = trim($_POST['time_slot']);
    $day        = $_POST['day'];
    $subject_id = $_POST['subject_id'];
    $teacher_id = $_POST['teacher_id'];

    // ✅ Check if this teacher is already assigned for the same class, section, day, and time slot
    $check = $db_conn->prepare("
        SELECT t.id, c.class AS class_name, s.title AS section_name, sub.subject_name, tc.name AS teacher_name
        FROM timetable t
        JOIN classes c ON t.class_id = c.id
        JOIN section s ON t.section_id = s.id
        JOIN subject sub ON t.subject_id = sub.id
        JOIN account tc ON t.teacher_id = tc.id
        WHERE t.teacher_id = ? AND t.day = ? AND t.time_slot = ?
    ");
    $check->bind_param("iss", $teacher_id, $day, $time_slot);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // 🟥 Teacher already assigned → show error
        $row = $result->fetch_assoc();
        echo "<script>
            alert('❌ Teacher \"{$row['teacher_name']}\" is already assigned for Class: {$row['class_name']}, Section: {$row['section_name']}, Subject: {$row['subject_name']} on {$day} at {$time_slot}.');
            window.location.href = 'timetable.php?class_id=$class_id&section_id=$section_id';
        </script>";
        exit;
    }

    // ✅ Safe to insert new timetable entry
    $stmt = $db_conn->prepare("
        INSERT INTO timetable (class_id, section_id, time_slot, day, subject_id, teacher_id)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("iissii", $class_id, $section_id, $time_slot, $day, $subject_id, $teacher_id);
    $stmt->execute();

    header("Location: timetable.php?class_id=$class_id&section_id=$section_id&success=1");
    exit;
}


// ✅ UPDATE timetable entry
if (isset($_POST['update'])) {
    $id         = $_POST['id'];
    $class_id   = $_POST['class_id'];
    $section_id = $_POST['section_id'];
    $time_slot  = trim($_POST['time_slot']);
    $day        = $_POST['day'];
    $subject_id = $_POST['subject_id'];
    $teacher_id = $_POST['teacher_id'];

    $stmt = $db_conn->prepare("UPDATE timetable SET time_slot=?, day=?, subject_id=?, teacher_id=? WHERE id=?");
    $stmt->bind_param("ssiii", $time_slot, $day, $subject_id, $teacher_id, $id);
    $stmt->execute();

    header("Location: timetable.php?class_id=$class_id&section_id=$section_id&updated=1");
    exit;
}

// ✅ DELETE timetable entry
if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    $class_id = $_GET['class_id'];
    $section_id = $_GET['section_id'];
    mysqli_query($db_conn, "DELETE FROM timetable WHERE id=$del_id");
    header("Location: timetable.php?class_id=$class_id&section_id=$section_id&deleted=1");
    exit;
}

// ✅ FETCH CLASS & SECTION
$class_id   = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;
$section_id = isset($_GET['section_id']) ? intval($_GET['section_id']) : 0;

$class_name = '';
$section_name = '';
$class_q = mysqli_query($db_conn, "SELECT class FROM classes WHERE id='$class_id'");
if ($class_row = mysqli_fetch_object($class_q)) {
    $class_name = $class_row->class;
}

// Fetch section title
$section_q = mysqli_query($db_conn, "SELECT title FROM section WHERE id='$section_id'");
if ($sec_row = mysqli_fetch_object($section_q)) {
    $section_name = $sec_row->title;
}

// ✅ Edit mode
$edit = null;
if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);
    $edit = mysqli_fetch_object(mysqli_query($db_conn, "SELECT * FROM timetable WHERE id='$edit_id'"));
}

// ✅ Handle AJAX call for sections dynamically
if (isset($_GET['ajax']) && $_GET['ajax'] === 'sections') {
    $class_id = $_GET['class_id'] ?? 0;

    if (!$class_id) {
        echo json_encode([]);
        exit;
    }

    // ✅ Fetch the section_id linked to this class from classes table
    $query = $query = "
    SELECT id, title 
    FROM section 
    WHERE FIND_IN_SET(id, (SELECT section_id FROM classes WHERE id = '$class_id'))
";

    $result = mysqli_query($db_conn, $query);
    $sections = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $sections[] = $row;
    }

    echo json_encode($sections);
    exit;
}


?>
<?php include('header.php');?>
<?php include('sidebar.php');?>

<main class="app-main p-4" style="flex:1; min-height:100vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Class Timetable</h2>
    </div>

    <!-- ✅ Select class & section if not chosen -->
    <?php if (!$class_id || !$section_id): ?>
        <div class="card">
            <div class="card-header bg-dark text-white">Select Class & Section</div>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="form-group mb-3">
                        <label>Choose Class</label>
                        <select name="class_id" class="form-control" required>
                            <option value="">-- Select Class --</option>
                            <?php
                            $class_q = mysqli_query($db_conn, "SELECT * FROM classes ORDER BY class ASC");
                            while ($cls = mysqli_fetch_object($class_q)) {
                                echo "<option value='{$cls->id}'>{$cls->class}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Choose Section</label>
                        <select name="section_id" class="form-control" required>
                            <option value="">-- Select forst classSection --</option>
                            <?php
                            // $sec_q = mysqli_query($db_conn, "SELECT * FROM section ORDER BY title ASC");
                            // while ($sec = mysqli_fetch_object($sec_q)) {
                            //     echo "<option value='{$sec->id}'>{$sec->title}</option>";
                            // }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Next</button>
                </form>
            </div>
        </div>

    <?php else: ?>

        <!-- ✅ Alerts -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success text-center">✅ Timetable entry added successfully!</div>
        <?php elseif (isset($_GET['updated'])): ?>
            <div class="alert alert-success text-center">✅ Timetable updated successfully!</div>
        <?php elseif (isset($_GET['deleted'])): ?>
            <div class="alert alert-danger text-center">🗑️ Entry deleted successfully!</div>
        <?php endif; ?>

        <!-- ✅ Add/Edit Form -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <?= $edit ? 'Edit Timetable Entry' : 'Add New Timetable Entry' ?>
            </div>
            <div class="card-body">
                <form method="POST">
                    <?php if ($edit): ?>
                        <input type="hidden" name="id" value="<?= $edit->id ?>">
                    <?php endif; ?>
                    <input type="hidden" name="class_id" value="<?= $class_id ?>">
                    <input type="hidden" name="section_id" value="<?= $section_id ?>">

                    <div class="row">
                        <div class="col-md-3">
                            <label>Time Slot</label>
                            <input type="text" name="time_slot" class="form-control"
                                value="<?= $edit ? htmlspecialchars($edit->time_slot) : '' ?>" placeholder="09:00 - 10:00" required>
                        </div>

                        <div class="col-md-3">
                            <label>Day</label>
                            <select name="day" class="form-control" required>
                                <option value="">-- Select Day --</option>
                                <?php foreach ($days as $d): ?>
                                    <option value="<?= $d ?>" <?= ($edit && $edit->day == $d) ? 'selected' : '' ?>><?= $d ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Subject</label>
                            <select name="subject_id" class="form-control" required>
                                <option value="">-- Select Subject --</option>
                                <?php
                                $sub_q = mysqli_query($db_conn, "SELECT * FROM subject WHERE class_id='$class_id'");
                                while ($sub = mysqli_fetch_object($sub_q)) {
                                    $sel = ($edit && $edit->subject_id == $sub->id) ? 'selected' : '';
                                    echo "<option value='{$sub->id}' $sel>{$sub->subject_name}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Teacher</label>
                            <select name="teacher_id" class="form-control" required>
                                <option value="">-- Select Teacher --</option>
                                <?php
                                $teacher_q = mysqli_query($db_conn, "SELECT * FROM account WHERE user_Type='Teacher'");
                                while ($teacher = mysqli_fetch_object($teacher_q)) {
                                    $sel = ($edit && $edit->teacher_id == $teacher->id) ? 'selected' : '';
                                    echo "<option value='{$teacher->id}' $sel>{$teacher->name}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4 align-self-end d-flex gap-2">
                            <button name="<?= $edit ? 'update' : 'submit' ?>"
                                class="btn <?= $edit ? 'btn-warning' : 'btn-success' ?> w-50">
                                <?= $edit ? 'Update' : 'Save' ?>
                            </button>

                            <?php if ($edit): ?>
                                <a href="timetable.php?class_id=<?= $class_id ?>&section_id=<?= $section_id ?>" class="btn btn-secondary w-25">Cancel</a>
                            <?php endif; ?>

                            <a href="timetable.php" class="btn btn-info w-25">Change Class</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- ✅ Timetable Matrix -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                Timetable for Class <b><?= htmlspecialchars($class_name) ?></b> — Section <b><?= htmlspecialchars($section_name) ?></b>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
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
                        $slots = mysqli_query($db_conn, "SELECT DISTINCT time_slot FROM timetable WHERE class_id='$class_id' ORDER BY time_slot ASC");
                        while ($slot = mysqli_fetch_object($slots)): ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= htmlspecialchars($slot->time_slot) ?></td>
                                <?php foreach ($days as $day):
                                    $query = mysqli_query($db_conn, "
                                        SELECT t.id, s.subject_name, a.name AS teacher
                                        FROM timetable t
                                        LEFT JOIN subject s ON t.subject_id = s.id
                                        LEFT JOIN account a ON t.teacher_id = a.id
                                        WHERE t.class_id = '$class_id'
                                        AND t.section_id = '$section_id'
                                        AND t.time_slot = '{$slot->time_slot}'
                                        AND t.day = '$day'
                                    ");
                                    $entry = mysqli_fetch_object($query);
                                ?>
                                    <td>
                                        <?php if ($entry): ?>
                                            <b><?= htmlspecialchars($entry->subject_name) ?></b><br>
                                            <small><?= htmlspecialchars($entry->teacher) ?></small><br>
                                            <a href="timetable.php?class_id=<?= $class_id ?>&section_id=<?= $section_id ?>&edit_id=<?= $entry->id ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="timetable.php?class_id=<?= $class_id ?>&section_id=<?= $section_id ?>&delete=<?= $entry->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this entry?');">Delete</a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>
</main>

<?php include('footer.php'); ?>