<?php
include('../includes/config.php');

// ✅ Handle Update
if (isset($_POST['update_account'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($db_conn, $_POST['name']);
    $email = mysqli_real_escape_string($db_conn, $_POST['email']);
    $user_type = mysqli_real_escape_string($db_conn, $_POST['user_type']);

    $update_query = "UPDATE account SET name='$name', email='$email', user_Type='$user_type' WHERE id='$id'";
    if (mysqli_query($db_conn, $update_query)) {
        echo "<div class='alert alert-success text-center'>✅ Account updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>❌ Error updating account: " . mysqli_error($db_conn) . "</div>";
    }
}

// ✅ Handle Delete
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    if (mysqli_query($db_conn, "DELETE FROM account WHERE id='$delete_id'")) {
        echo "<div class='alert alert-danger text-center'>🗑️ Account deleted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>❌ Error deleting account.</div>";
    }
}

// ✅ If edit mode is active, fetch user data
$edit_user = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $edit_user = mysqli_fetch_assoc(mysqli_query($db_conn, "SELECT * FROM account WHERE id='$edit_id'"));
}
?>


<?php
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$sql = "SELECT * FROM account";
if ($filter) {
    $sql .= " WHERE user_Type = '" . mysqli_real_escape_string($db_conn, $filter) . "'";
}
$sql .= " ORDER BY id DESC";  // Optional: add ordering here

$result = mysqli_query($db_conn, $sql);
?>


<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<main class="app-main p-4" style="flex:1; min-height:100vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Manage Accounts</h2>
        <a href="add_user.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New
        </a>
    </div>




    <!-- ✅ Edit Form (Shown only when editing) -->
    <?php if ($edit_user): ?>
        <div class="card shadow p-4 mb-4">
            <h4 class="text-primary mb-3">✏️ Edit Account (ID: <?php echo $edit_user['id']; ?>)</h4>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?php echo $edit_user['id']; ?>">

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($edit_user['name']); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($edit_user['email']); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label>User Type</label>
                        <select name="user_type" class="form-control" required>
                            <option value="Admin" <?php if ($edit_user['user_Type'] == 'Admin') echo 'selected'; ?>>Admin</option>
                            <option value="Teacher" <?php if ($edit_user['user_Type'] == 'Teacher') echo 'selected'; ?>>Teacher</option>
                            <option value="Student" <?php if ($edit_user['user_Type'] == 'Student') echo 'selected'; ?>>Student</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="update_account" class="btn btn-success">💾 Update</button>
                <a href="manage_account.php" class="btn btn-secondary">❌ Cancel</a>
            </form>
        </div>
    <?php endif; ?>

    <!-- ✅ Account Table -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-people-fill"></i> All Users
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <td>{$count}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['user_Type']}</td>
                        <td>
                            <a href='manage_account.php?edit_id={$row['id']}' class='btn btn-sm btn-warning'>
                                <i class='bi bi-pencil-square'></i> Edit
                            </a>
                            <a href='manage_account.php?delete_id={$row['id']}' 
                            onclick=\"return confirm('Are you sure you want to delete this account?');\" 
                            class='btn btn-sm btn-danger'>
                            <i class='bi bi-trash'></i> Delete
                            </a>
                            <a href='profile_form.php?user_id={$row['id']}&user_type={$row['user_Type']}' 
                            class='btn btn-sm btn-info'>
                            <i class='bi bi-person-lines-fill'></i> Profile
                            </a>
                        </td>
                    </tr>";
                                    $count++;
                                }
                                ?>

                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>