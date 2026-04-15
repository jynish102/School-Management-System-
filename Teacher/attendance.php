<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');
?>

<main class="app-main p-4" style="flex:1; min-height:100vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Manage Attendance</h2>
    </div>

    <?php if (!isset($_GET['class_id']) || !isset($_GET['sec_id'])) { ?>
        <!-- STEP 1: SELECT CLASS & DATE -->
        <div class="card">
            <div class="card-header bg-dark text-white">Select Class & Date</div>
            <div class="card-body">
                <form method="GET" action="attendance.php">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="class_id">Class</label>
                            <select name="class_id" class="form-control" required>
                                <option value="">-- Select Class --</option>
                                <?php
                                $c_query = mysqli_query($db_conn, "SELECT * FROM classes");
                                while ($cls = mysqli_fetch_object($c_query)) {
                                    echo "<option value='{$cls->id}'>{$cls->class}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="sec_id">Section</label>
                            <select name="sec_id" class="form-control" required>
                                <option value="">-- Select Section --</option>
                                <?php
                                $s_query = mysqli_query($db_conn, "SELECT * FROM section");
                                while ($sec = mysqli_fetch_object($s_query)) {
                                    echo "<option value='{$sec->id}'>{$sec->title}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <div class="col-md-3 align-self-end">
                            <button type="submit" class="btn btn-primary w-100">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <?php } else {
        // STEP 2: SHOW STUDENT LIST AS PER CLASS & SECTION
        $class_id = $_GET['class_id'];
        $section_id = $_GET['sec_id'];
        $date = $_GET['date'];

        // fetch class and section names
        $class = mysqli_fetch_object(mysqli_query($db_conn, "SELECT class FROM classes WHERE id='$class_id'"));
        $section = mysqli_fetch_object(mysqli_query($db_conn, "SELECT title FROM section WHERE id='$section_id'"));

        $class_name = $class->class;
        $section_name = $section->title;

        // 🔹 fetch students from usermeta (filtered by class & section)
        $sql = "
        SELECT a.id, a.name
        FROM account a
        JOIN usermeta m1 ON a.id = m1.user_id AND m1.meta_key = 'class'
        JOIN usermeta m2 ON a.id = m2.user_id AND m2.meta_key = 'section'
        WHERE m1.meta_value = '$class_name'
          AND m2.meta_value = '$section_name'
          AND a.user_Type = 'Student'
        ";
        $students = mysqli_query($db_conn, $sql);

        // Save attendance
        if (isset($_POST['save_attendance'])) {
            foreach ($_POST['status'] as $student_id => $status) {
                mysqli_query(
                    $db_conn,
                    "INSERT INTO attendance (class_id, student_id, date, status)
                     VALUES ('$class_id','$student_id','$date','$status')"
                ) or die("DB Error");
            }
            echo "<div class='alert alert-success'>Attendance saved successfully!</div>";
        }
    ?>

        <!-- STEP 3: ATTENDANCE TABLE -->
        <div class="card mt-4">
            <div class="card-header bg-dark text-white">
                Attendance for <strong><?= $class_name ?> - <?= $section_name ?></strong> (<?= $date ?>)
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered table-striped align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Roll No</th>
                                    <th>Student Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                if (mysqli_num_rows($students) > 0) {
                                    while ($stu = mysqli_fetch_object($students)) { ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $stu->id ?></td>
                                            <td><?= htmlspecialchars($stu->name) ?></td>
                                            <td>
                                                <select name="status[<?= $stu->id ?>]" class="form-control">
                                                    <option value="Present">Present</option>
                                                    <option value="Absent">Absent</option>
                                                    <option value="Late">Late</option>
                                                </select>
                                            </td>
                                        </tr>
                                <?php }
                                } else {
                                    echo "<tr><td colspan='4' class='text-muted'>No students found for this class & section.</td></tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" name="save_attendance" class="btn btn-success mt-3">Save Attendance</button>
                    <a class ="btn btn-info" href="attendance.php">Change Class</a>
                </form>
            </div>
        </div>
    <?php } ?>
</main>

<?php include('footer.php'); ?>
