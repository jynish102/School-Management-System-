<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<main class="app-main p-4" style="flex:1; ">
    <div class="card col-md-6 mx-auto shadow">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-plus-circle"></i> Add New User
        </div>
        <div class="card-body">
            <form action="../Action/save_user.php" method="POST">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" autofocus class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>User Type</label>
                    <select name="user_type" class="form-select" required>
                        <option value="">Select</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Save</button>
            </form>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>
