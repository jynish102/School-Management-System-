<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// ✅ Add New Class
if (isset($_POST['submit'])) {
    $class_name = trim($_POST['class']);
    $sections = isset($_POST['section']) ? $_POST['section'] : [];
    $section_csv = implode(',', $sections);
    $added_date = date('Y-m-d');

    $stmt = $db_conn->prepare("INSERT INTO classes (class, section_id, added_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $class_name, $section_csv, $added_date);
    $stmt->execute();

    header("Location: classes.php?success=1");
    exit;
}

// ✅ Update Class
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $class_name = trim($_POST['class']);
    $sections = isset($_POST['section']) ? $_POST['section'] : [];
    $section_csv = implode(',', $sections);

    $stmt = $db_conn->prepare("UPDATE classes SET class = ?, section_id = ? WHERE id = ?");
    $stmt->bind_param("ssi", $class_name, $section_csv, $id);
    $stmt->execute();

    header("Location: classes.php?updated=1");
    exit;
}

// ✅ Delete class
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($db_conn, "DELETE FROM classes WHERE id = $id");
    header("Location: classes.php?deleted=1");
    exit;
}

// ✅ Edit mode: load class for update
$edit_class = null;
if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);
    $result = mysqli_query($db_conn, "SELECT * FROM classes WHERE id = $edit_id");
    $edit_class = mysqli_fetch_assoc($result);
}
?>

<main class="app-main p-4" style="flex:1; min-height:100vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Manage Accounts</h2>
        <a href="classes.php?action=add-new" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New
        </a>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- ✅ Alerts -->
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success text-center">✅ Class added successfully!</div>
            <?php elseif (isset($_GET['updated'])): ?>
                <div class="alert alert-success text-center">✅ Class updated successfully!</div>
            <?php elseif (isset($_GET['deleted'])): ?>
                <div class="alert alert-danger text-center">🗑️ Class deleted successfully!</div>
            <?php endif; ?>

            <!-- ✅ Add/Edit Form -->
            <?php if ($edit_class || (isset($_GET['action']) && $_GET['action'] == 'add-new')): ?>
                <div class="card mb-4">
                    <div class="card-header py-2">
                        <h3 class="card-title"><?= $edit_class ? 'Edit Class' : 'Add New Class' ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <?php if ($edit_class): ?>
                                <input type="hidden" name="id" value="<?= $edit_class['id'] ?>">
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="class">Class Name</label>
                                <input type="text" name="class" placeholder="Enter Class Name" required class="form-control"
                                    value="<?= $edit_class ? htmlspecialchars($edit_class['class']) : '' ?>">
                            </div>

                            <div class="form-group">
                                <label>Sections</label><br>
                                <?php
                                $selected_sections = $edit_class ? explode(',', $edit_class['section_id']) : [];
                                $query = mysqli_query($db_conn, "SELECT * FROM section ORDER BY title ASC");
                                $count = 1;
                                while ($section = mysqli_fetch_object($query)) {
                                    $checked = in_array($section->id, $selected_sections) ? 'checked' : '';
                                ?>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="sec<?= $count ?>"
                                            name="section[]" value="<?= $section->id ?>" <?= $checked ?>>
                                        <label class="form-check-label" for="sec<?= $count ?>"><?= htmlspecialchars($section->title) ?></label>
                                    </div>
                                <?php $count++;
                                } ?>
                            </div>

                            <button name="<?= $edit_class ? 'update' : 'submit' ?>" class="btn btn-success float-right mt-2">
                                <?= $edit_class ? 'Update' : 'Submit' ?>
                            </button>
                            <a href="classes.php" class="btn btn-secondary mt-2">Cancel</a>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ✅ Class List -->
            <div class="card">
                <div class="card-header py-2 d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Classes List</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Class Name</th>
                                    <th>Sections</th>
                                    <th>Added Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $query = mysqli_query($db_conn, "SELECT * FROM classes ORDER BY id DESC");
                                while ($class = mysqli_fetch_object($query)) {
                                    // Convert section_id CSV to titles
                                    $section_titles = [];
                                    if (!empty($class->section_id)) {
                                        $ids = explode(',', $class->section_id);
                                        $id_list = implode(',', array_map('intval', $ids));
                                        $sec_query = mysqli_query($db_conn, "SELECT title FROM section WHERE id IN ($id_list)");
                                        while ($s = mysqli_fetch_object($sec_query)) {
                                            $section_titles[] = $s->title;
                                        }
                                    }
                                ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= htmlspecialchars($class->class) ?></td>
                                        <td>
                                            <?php
                                            if (!empty($section_titles)) {
                                                foreach ($section_titles as $title) {
                                                    echo '<span class=" mx-1">' . htmlspecialchars($title) . '</span>';
                                                }
                                            } else {
                                                echo '<span class="text-muted">No Sections</span>';
                                            }
                                            ?>
                                        </td>
                                        <td><?= htmlspecialchars($class->added_date) ?></td>
                                        <td>
                                            <a href="classes.php?edit_id=<?= $class->id ?>" class="btn btn-sm btn-info">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a href="classes.php?delete=<?= $class->id ?>"
                                                onclick="return confirm('Are you sure you want to delete this class?');"
                                                class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include('footer.php'); ?>