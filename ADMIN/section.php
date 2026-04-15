<?php include('../includes/config.php'); ?>

<?php
// ======================= ADD NEW SECTION =======================
if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    if ($title != "") {
        mysqli_query($db_conn, "INSERT INTO section (title) VALUES ('$title')")
            or die('Insert failed');
    }
    header("Location: section.php?success=1");
    exit();
}

// ======================= UPDATE SECTION =======================
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $title = trim($_POST['title']);
    if ($title != "") {
        mysqli_query($db_conn, "UPDATE section SET title='$title' WHERE id='$id'")
            or die('Update failed');
    }
    header("Location: section.php?updated=1");
    exit();
}

// ======================= DELETE SECTION (Restrict if linked) =======================
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // ✅ Check if any class uses this section
    $check = mysqli_query($db_conn, "SELECT COUNT(*) as cnt FROM classes WHERE FIND_IN_SET('$id', section)");
    $res = mysqli_fetch_assoc($check);

    if ($res['cnt'] > 0) {
        header("Location: section.php?error=linked");
        exit();
    } else {
        mysqli_query($db_conn, "DELETE FROM section WHERE id='$id'") or die('Delete failed');
        header("Location: section.php?deleted=1");
        exit();
    }
}
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<main class="app-main p-4" style="flex:1; min-height:100vh;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Manage Sections</h2>
    </div>

    <!-- ✅ Alerts -->
    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success">Section added successfully!</div>
    <?php } elseif (isset($_GET['updated'])) { ?>
        <div class="alert alert-info">Section updated successfully!</div>
    <?php } elseif (isset($_GET['deleted'])) { ?>
        <div class="alert alert-danger">Section deleted successfully!</div>
    <?php } elseif (isset($_GET['error']) && $_GET['error'] == 'linked') { ?>
        <div class="alert alert-warning">Cannot delete this section because it is linked to a class!</div>
    <?php } ?>

    <!-- ================== ADD / EDIT SECTION FORM ================== -->
    <div class="card mb-4">
        <div class="card-header py-2">
            <h3 class="card-title">
                <?= isset($_GET['edit']) ? "Edit Section" : "Add New Section" ?>
            </h3>
        </div>
        <div class="card-body">
            <?php
            $editData = null;
            if (isset($_GET['edit'])) {
                $id = intval($_GET['edit']);
                $editQuery = mysqli_query($db_conn, "SELECT * FROM section WHERE id=$id");
                $editData = mysqli_fetch_object($editQuery);
            }
            ?>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $editData->id ?? '' ?>">
                <div class="form-group">
                    <label for="title"><?= isset($editData) ? "Edit Section" : "Add Section" ?></label>
                    <input type="text" name="title" required class="form-control"
                        value="<?= htmlspecialchars($editData->title ?? '') ?>" placeholder="Enter Section Name">
                </div>
                <?php if ($editData) { ?>
                    <button type="submit" name="update" class="btn btn-primary mt-2">
                        <i class="fa fa-save"></i> Update
                    </button>
                    <a href="section.php" class="btn btn-secondary mt-2">Cancel</a>
                <?php } else { ?>
                    <button type="submit" name="submit" class="btn btn-success mt-2">
                        <i class="fa fa-plus"></i> Add
                    </button>
                <?php } ?>
            </form>
        </div>
    </div>

    <!-- ================== SECTION LIST ================== -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-easel-fill me-2"></i> Sections List
        </div>
        <div class="card-body">
            <div class="table-responsive bg-white">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Section</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $query = mysqli_query($db_conn, 'SELECT * FROM section ORDER BY id DESC');
                        while ($section = mysqli_fetch_object($query)) { ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= htmlspecialchars($section->title) ?></td>
                                <td>
                                    <a href="section.php?edit=<?= $section->id ?>" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="section.php?delete=<?= $section->id ?>"
                                        onclick="return confirm('Are you sure you want to delete this section?');"
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
</main>

<?php include('footer.php'); ?>