<?php
include('../includes/config.php');

$user_id   = $_GET['user_id'];
$user_type = ucfirst($_GET['user_type']); // passed from add_user.php after insert
?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<html>

<head>
    <title><?php echo ucfirst($user_type); ?> Profile Form</title>
</head>

<body>
    <main class="app-main p-2 mt-4" style="flex:1;">

        <h2 class="text-primary">Complete <?php echo ucfirst($user_type); ?> Profile</h2>

        <div class="card shadow col-md-12 mx-auto">
            <div class="card-header bg-info text-white">
                <i class="bi bi-person-workspace"></i> Complete Teacher Profile
            </div>
            <div class="card-body">
                <form method="POST" action="../Action/teacher-registration.php">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="user_type" value="<?php echo $user_type; ?>">

                    <!-- Teacher info -->
                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="float-none w-auto px-3">Teacher Information</legend>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control mb-1" name="name" placeholder="Full Name" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label">DOB</label>
                                    <input type="date" class="form-control mb-1" name="dob" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label">Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="">Select</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Contact info -->
                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="float-none w-auto px-3">Contact Information</legend>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Mobile</label>
                                <input type="number" class="form-control" name="mobile" placeholder="Mobile Number">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="name@gmail.com" required>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address" rows="3" placeholder="Enter your address"></textarea>
                        </div>
                    </fieldset>

                    <!-- Qualification -->
                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="float-none w-auto px-3">Qualification & Experience</legend>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Highest Qualification</label>
                                <input type="text" class="form-control" name="qualification" placeholder="e.g. M.Sc, B.Ed">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Experience (Years)</label>
                                <input type="number" class="form-control" name="experience" placeholder="Years of Experience">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label class="form-label">Class</label>
                                <input type="text" class="form-control" name="class" placeholder="e.g. Class 8,9">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label class="form-label">Specialization / Subject</label>
                                <input type="text" class="form-control" name="subject" placeholder="e.g. Mathematics, Science">
                            </div>
                        </div>
                    </fieldset>

                    <!-- Joining -->
                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="float-none w-auto px-3">Joining Details</legend>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Joining Date</label>
                                <input type="date" class="form-control" name="joining_date">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" name="designation" placeholder="e.g. Assistant Teacher">
                            </div>
                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-outline-primary mt-2">Register</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>