<?php include('../includes/config.php');

// Insert subject
if (isset($_POST['submit'])) {
    $subject_name = $_POST['subject_name'];
    $class_id     = $_POST['class_id'];
    $teacher_id   = $_POST['teacher_id'] ?? null;
    $added_date   = date('Y-m-d');

    mysqli_query(
        $db_conn,
        "INSERT INTO subject (subject_name, class_id, teacher_id, added_date) 
         VALUES ('$subject_name','$class_id','$teacher_id','$added_date')"
    ) or die(mysqli_error($db_conn));

    header("Location: subject.php?class_id=$class_id&added=1");
    exit;
}

// Delete subject
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $class_id = $_GET['class_id'] ?? '';
    mysqli_query($db_conn, "DELETE FROM subject WHERE id='$id'") or die('Delete Error');
    header("Location: subject.php?class_id=$class_id&deleted=1");
    exit;
}

// Update Subject
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $subject = trim($_POST['subject']);
    $teacher_id = $_POST['teacher_id'] ?? null;

    $stmt = $db_conn->prepare("UPDATE subject SET subject_name = ?, teacher_id = ? WHERE id = ?");
    $stmt->bind_param("ssi", $subject, $teacher_id, $id);
    $stmt->execute();

    $class_id = $_GET['class_id'] ?? $_POST['class_id'] ?? '';
    header("Location: subject.php?class_id=$class_id&updated=1");
    exit;
}

// Get selected class
$class_id = $_GET['class_id'] ?? null;

// Handle edit request
$editing = false;
$edit_subject = null;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $res = mysqli_query($db_conn, "SELECT * FROM subject WHERE id='$edit_id' LIMIT 1");
    if (mysqli_num_rows($res) > 0) {
        $edit_subject = mysqli_fetch_object($res);
        $editing = true;
    }
}
?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>



<main class="app-main p-4" style="flex:1; min-height:100vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Manage Subjects</h2>
    </div>

    <section class="content">
        <div class="container-fluid">

            <?php if (isset($_GET['added'])) { ?>
                <div class="alert alert-success">Subject added successfully.</div>
            <?php } elseif (isset($_GET['updated'])) { ?>
                <div class="alert alert-success">Subject updated successfully.</div>
            <?php } elseif (isset($_GET['deleted'])) { ?>
                <div class="alert alert-danger">Subject deleted successfully.</div>
            <?php } ?>

            <?php if (!$class_id) { ?>
                <!-- Step 1: Select Class -->
                <div class="card">
                    <div class="card-header bg-dark text-white">Select Class</div>
                    <div class="card-body">
                        <form method="GET" action="subject.php">
                            <div class="form-group">
                                <label for="class_id">Choose Class</label>
                                <select name="class_id" id="class_id" class="form-control" required>
                                    <option value="">-- Select Class --</option>
                                    <?php
                                    $class_query = mysqli_query($db_conn, "SELECT * FROM classes ORDER BY class ASC");
                                    while ($cls = mysqli_fetch_object($class_query)) {
                                        echo "<option value='{$cls->id}'>{$cls->class}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Next</button>
                        </form>
                    </div>
                </div>

            <?php } else { ?>
                <!-- Step 2: Show Subjects for Selected Class -->
                <div class="card">
                    <div class="card-header py-2 d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            Subjects List (Class:
                            <?php
                            $c = mysqli_fetch_object(mysqli_query($db_conn, "SELECT class FROM classes WHERE id='$class_id'"));
                            echo $c ? $c->class : "Unknown";
                            ?>)
                        </h3>
                        <div class="card-tools">
                            <a href="?action=add-new&class_id=<?= $class_id ?>" class="btn btn-success btn-xs">
                                <i class="fa fa-plus mr-2"></i>Add New
                            </a>
                            <a href="subject.php" class="btn btn-secondary btn-xs">Change Class</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <!-- ✅ Edit Subject Form -->
                        <?php if ($editing && $edit_subject) { ?>
                            <div class="card mb-3">
                                <div class="card-header bg-info text-white">Edit Subject</div>
                                <div class="card-body">
                                    <form method="POST" action="subject.php?class_id=<?= $class_id ?>">
                                        <input type="hidden" name="id" value="<?= $edit_subject->id ?>">
                                        <input type="hidden" name="class_id" value="<?= $class_id ?>">
                                        <div class="form-group">
                                            <label>Subject Name</label>
                                            <input type="text" name="subject" value="<?= htmlspecialchars($edit_subject->subject_name) ?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Assign Teacher</label>
                                            <select name="teacher_id" class="form-control">
                                                <option value="">-- Select Teacher --</option>
                                                <?php
                                                $t_query = mysqli_query($db_conn, "SELECT * FROM account WHERE user_Type='Teacher'");
                                                while ($teacher = mysqli_fetch_object($t_query)) {
                                                    $selected = ($teacher->id == $edit_subject->teacher_id) ? 'selected' : '';
                                                    echo "<option value='{$teacher->id}' $selected>{$teacher->name}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" name="update" class="btn btn-primary">Update Subject</button>
                                        <a href="subject.php?class_id=<?= $class_id ?>" class="btn btn-secondary">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- ✅ Add Subject Form -->
                        <?php if (isset($_GET['action']) && $_GET['action'] == "add-new") { ?>
                            <div class="card mb-3">
                                <div class="card-header bg-success text-white">Add New Subject</div>
                                <div class="card-body">
                                    <form action="subject.php" method="POST">
                                        <input type="hidden" name="class_id" value="<?= $class_id ?>">
                                        <div class="form-group">
                                            <label for="subject_name">Subject Name</label>
                                            <input type="text" name="subject_name" required class="form-control" placeholder="Enter Subject">
                                        </div>
                                        <div class="form-group">
                                            <label for="teacher_id">Assign Teacher</label>
                                            <select name="teacher_id" class="form-control">
                                                <option value="">-- Select Teacher --</option>
                                                <?php
                                                $t_query = mysqli_query($db_conn, "SELECT * FROM account WHERE user_Type='Teacher'");
                                                while ($teacher = mysqli_fetch_object($t_query)) {
                                                    echo "<option value='{$teacher->id}'>{$teacher->name}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button name="submit" class="btn btn-success float-right">Save Subject</button>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- ✅ Subjects Table -->
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered table-hover table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Subject Name</th>
                                        <th>Teacher</th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $query = mysqli_query($db_conn, "SELECT * FROM subject WHERE class_id='$class_id'");
                                    while ($sub = mysqli_fetch_object($query)) {
                                        $t = mysqli_fetch_object(mysqli_query($db_conn, "SELECT name FROM account WHERE id='$sub->teacher_id'"));
                                        $teachername = $t ? $t->name : '-';
                                    ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $sub->subject_name ?></td>
                                            <td><?= $teachername ?></td>
                                            <td><?= $sub->added_date ?></td>
                                            <td>
                                                <a href="?edit=<?= $sub->id ?>&class_id=<?= $class_id ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="?delete=<?= $sub->id ?>&class_id=<?= $class_id ?>" onclick="return confirm('Delete this subject?')" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($count === 1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No subjects found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<?php include('footer.php'); ?>