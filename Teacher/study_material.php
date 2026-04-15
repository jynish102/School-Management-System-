<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// ==========================
// FETCH CLASS
// ==========================
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;

// Get class name
$class_name = '';
if ($class_id) {
    $class_q = mysqli_query($db_conn, "SELECT class FROM classes WHERE id='$class_id'");
    if ($class_row = mysqli_fetch_object($class_q)) {
        $class_name = $class_row->class;
    }
}

// ==========================
// DELETE MATERIAL
// ==========================
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $mat = mysqli_fetch_object(mysqli_query($db_conn, "SELECT * FROM study_materials WHERE id='$id'"));
    if ($mat) {
        $file_path = "../uploads/study_materials/" . $mat->file_path;
        if (file_exists($file_path)) unlink($file_path);
        mysqli_query($db_conn, "DELETE FROM study_materials WHERE id='$id'");
        echo "<script>alert('Material deleted successfully!'); window.location='teacher_study_material.php?class_id=$class_id';</script>";
        exit;
    }
}

// ==========================
// EDIT MODE CHECK
// ==========================
$edit = false;
$edit_data = null;
if (isset($_GET['edit_id'])) {
    $edit = true;
    $edit_id = intval($_GET['edit_id']);
    $edit_data = mysqli_fetch_object(mysqli_query($db_conn, "SELECT * FROM study_materials WHERE id='$edit_id'"));
}

// ==========================
// UPLOAD OR UPDATE MATERIAL
// ==========================
if (isset($_POST['save_material'])) {
    $title = mysqli_real_escape_string($db_conn, $_POST['title']);
    $subject_id = intval($_POST['subject_id']);
    $upload_date = date('Y-m-d');

    $target_dir = "../uploads/study_materials/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

    $file_name = '';
    if (!empty($_FILES['file']['name'])) {
        $file_name = basename($_FILES["file"]["name"]);
        $target_file = $target_dir . $file_name;
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    }

    if (!empty($_POST['edit_id'])) {
        // UPDATE
        $id = intval($_POST['edit_id']);
        if ($file_name != '') {
            $old = mysqli_fetch_object(mysqli_query($db_conn, "SELECT file_path FROM study_materials WHERE id='$id'"));
            if ($old && file_exists($target_dir . $old->file_path)) unlink($target_dir . $old->file_path);
            mysqli_query($db_conn, "UPDATE study_materials SET title='$title', subject_id='$subject_id', file_path='$file_name' WHERE id='$id'");
        } else {
            mysqli_query($db_conn, "UPDATE study_materials SET title='$title', subject_id='$subject_id' WHERE id='$id'");
        }
        echo "<script>alert('Material updated successfully!'); window.location='study_material.php?class_id=$class_id';</script>";
    } else {
        // INSERT NEW
        mysqli_query($db_conn, "INSERT INTO study_materials (title, class_id, subject_id, file_path, uploaded_date) 
                                VALUES ('$title', '$class_id', '$subject_id', '$file_name', '$upload_date')");
        echo "<script>alert('Material uploaded successfully!'); window.location='study_material.php?class_id=$class_id';</script>";
    }
}
?>

<main class="app-main p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📚 Study Materials (Teacher Panel)</h2>
    </div>

    <?php if (!$class_id): ?>
        <!-- STEP 1: SELECT CLASS -->
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Select Class</div>
            <div class="card-body">
                <form method="GET" action="">
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
                    <button type="submit" class="btn btn-primary mt-3 px-4">Next</button>
                </form>
            </div>
        </div>

    <?php else: ?>

        <!-- CLASS HEADER -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top">
                <span>Study Materials for Class <b><?= htmlspecialchars($class_name) ?></b></span>
                <a href="study_material.php" class="btn btn-light btn-sm px-3 shadow-sm">
                    <i class="fa fa-sync-alt"></i> Change Class
                </a>
            </div>
        </div>

        <!-- UPLOAD / EDIT FORM -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-primary text-white"><?= $edit ? 'Edit Material' : 'Upload New Material' ?></div>
            <div class="card-body bg-light">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" value="<?= $edit ? $edit_data->id : '' ?>">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"
                                value="<?= $edit ? htmlspecialchars($edit_data->title) : '' ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Subject</label>
                            <select name="subject_id" class="form-control" required>
                                <option value="">-- Select Subject --</option>
                                <?php
                                $subjects = mysqli_query($db_conn, "SELECT * FROM subject WHERE class_id='$class_id'");
                                while ($sub = mysqli_fetch_object($subjects)) {
                                    $selected = ($edit && $edit_data->subject_id == $sub->id) ? 'selected' : '';
                                    echo "<option value='{$sub->id}' $selected>{$sub->subject_name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><?= $edit ? 'Replace File (optional)' : 'Upload File' ?></label>
                            <input type="file" name="file" class="form-control" <?= $edit ? '' : 'required' ?>>
                        </div>
                    </div>
                    <button type="submit" name="save_material" class="btn <?= $edit ? 'btn-warning' : 'btn-success' ?> px-4">
                        <?= $edit ? 'Update' : 'Upload' ?>
                    </button>
                    <?php if ($edit): ?>
                        <a href="study_material.php?class_id=<?= $class_id ?>" class="btn btn-secondary px-4">Cancel</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <!-- MATERIAL LIST -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-secondary text-white">Available Materials</div>
            <div class="card-body table-responsive bg-white">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>File</th>
                            <th>Uploaded Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $query = mysqli_query($db_conn, "SELECT * FROM study_materials WHERE class_id='$class_id' ORDER BY uploaded_date DESC");
                        if (mysqli_num_rows($query) > 0) {
                            while ($mat = mysqli_fetch_object($query)) {
                                $sub = mysqli_fetch_object(mysqli_query($db_conn, "SELECT subject_name FROM subject WHERE id='$mat->subject_id'"));
                        ?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= htmlspecialchars($mat->title) ?></td>
                                    <td><?= $sub ? htmlspecialchars($sub->subject_name) : '-' ?></td>
                                    <td>
                                        <a href="../uploads/study_material/<?= htmlspecialchars($mat->file_path) ?>"
                                            target="_blank" class="btn btn-info btn-sm">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($mat->uploaded_date) ?></td>
                                    <td>
                                        <a href="?class_id=<?= $class_id ?>&edit_id=<?= $mat->id ?>"
                                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="?class_id=<?= $class_id ?>&delete_id=<?= $mat->id ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure to delete this material?');">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="6" class="text-center text-danger">No study materials found for this class.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php include('footer.php'); ?>