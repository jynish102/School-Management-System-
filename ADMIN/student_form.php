<?php
include('../includes/config.php');

$user_id   = $_GET['user_id'];
$user_type = ucfirst($_GET['user_type']); // passed from add_user.php after insert

?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<html>

<head>
    <title>student Profile Form</title>
</head>

<body>
    <main class="app-main p-2 mt-4" style="flex:1; ">


        <h2 class="text-primary">Complete Student Profile</h2>

        <div class="card shadow col-md-12 mx-auto">
            <div class="card-header bg-success text-white">
                <i class="bi bi-person-lines-fill"></i> Complete Student Profile
            </div>
            <div class="card-body">
                <form method="POST" action="../Action/student-registration.php">
                    <input type="hidden" name="user_id" value="<?php echo isset($_GET['user_id']) ? $_GET['user_id'] : ''; ?>">
                    <input type="hidden" name="user_type" value="<?php echo isset($_GET['user_type']) ? $_GET['user_type'] : ''; ?>">


                    <!--Student info-->
                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="float-none w-auto px-3">Student Information</legend>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control mb-1" placeholder="Full Name" name="name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">DOB</label>
                                    <input type="date" class="form-control mb-1" placeholder="DOB" name="dob" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">Mobile</label>
                                    <input type="number" class="form-control" placeholder="mobile no" name="mobile">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label"> Current Address</label>
                                    <textarea class="form-control" name="caddress" rows="3" placeholder="Enter your current address"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" placeholder="India" name="ccountry">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" placeholder="Gujarat" name="cstate">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">Pincode</label>
                                    <input type="number" class="form-control" placeholder="362001" name="zip">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!--end Student info -->

                    <!--Parent info -->
                    <fieldset class="border border-secondary p-4 form-group">
                        <legend class="float-none w-auto px-3">Parents Information</legend>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Father Full Name</label>
                                    <input type="text" class="form-control mb-1" placeholder="Father Name" name="father_name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Father's Mobile No</label>
                                    <input type="number" class="form-control mb-1" placeholder="Father's Mobile Number" name="father_mobile">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Mother Name </label>
                                    <input type="text" class="form-control" placeholder="Mother Name" name="mother_name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Mother Mobile</label>
                                    <input type="number" class="form-control" placeholder="Mother's Mobile Number" name="mother_mobile">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Permanent Address</label>
                                    <textarea class="form-control" name="parents_address" rows="3" placeholder="Enter your permanent address"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" placeholder="India" name="parents_country">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" placeholder="Gujarat" name="parents_state">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">Pincode</label>
                                    <input type="number" class="form-control" placeholder="362001" name="pzip">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!--end Parents info -->

                    <!--Last Qulifications -->
                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="float-none w-auto px-3 ">Last Qulifications</legend>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">School Name</label>
                                    <input type="text" class="form-control mb-1" placeholder="School name" name="previous_school_name">
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label class="form-label">Class</label>
                                    <input type="text" class="form-control mb-1" placeholder="class" name="previous_class">
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <input type="text" class="form-control" placeholder="Status" name="status">
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label class="form-label">Total marks</label>
                                    <input type="number" class="form-control" placeholder="Total marks" name="total_marks">
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label class="form-label">Obtain marks</label>
                                    <input type="number" class="form-control" name="obtain_marks" placeholder="Obtain marks"></input>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label class="form-label">Percentage(%)</label>
                                    <input type="text" class="form-control" placeholder="Percentage(%)" name="previous_percentage">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!--end Last Qulifications -->

                    <!--Admission Details -->
                    <fieldset class="border border-secondary p-3 form-group">
                        <legend class="float-none w-auto px-3">Admission Details</legend>
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label class="form-label">Class</label>
                                    <select name="class_id" id="class_id" class="form-control" required>
                                        <option value="">-- Select Class --</option>
                                        <?php
                                        $class_query = mysqli_query($db_conn, "SELECT * FROM classes ORDER BY class ASC");
                                        while ($cls = mysqli_fetch_object($class_query)) {
                                            echo "<option value='{$cls->id}'>{$cls->class}</option>";
                                        }
                                        ?>
                                    </select>
                                    <!-- <input type="text" class="form-control mb-1" placeholder="Class" name="class"> -->
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label class="form-label">Section</label>
                                    <select name="sec_id" class="form-control" required>
                                        <option value="">-- Select Section --</option>
                                        <?php
                                        $s_query = mysqli_query($db_conn, "SELECT * FROM section");
                                        while ($sec = mysqli_fetch_object($s_query)) {
                                            echo "<option value='{$sec->id}'>{$sec->title}</option>";
                                        }
                                        ?>
                                    </select>
                                    <!-- <input type="text" class="form-control mb-1" placeholder="Section" name="section"> -->
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label class="form-label">Date of Admission</label>
                                    <input type="date" class="form-control mb-1" placeholder="Date of Admission" name="doa">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!--end Admission Details -->
                    <input type="hidden" name="type" value="<?php echo isset($_GET['user_type']) ? $_GET['user_type'] : ''; ?>">
                    <button type="submit" name="submit" class="btn btn-outline-primary">
                        Register</button>

                    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                        <script>
                            window.addEventListener('DOMContentLoaded', () => {
                                var myModal = new bootstrap.Modal(document.getElementById('successModal'));
                                myModal.show();

                                // Auto close modal after 3s and redirect
                                setTimeout(function() {
                                    window.location.href = "manage_account.php";
                                }, 1000);
                            });
                        </script>
                    <?php endif; ?>

                    <!-- Success Modal -->
                    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content shadow-lg">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="successModalLabel"><i class="bi bi-check-circle-fill"></i> Registration Successful</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ✅ Student registered successfully!
                                    You can now manage this student in the system.
                                </div>
                                <div class="modal-footer">
                                    <a href="manage_account.php" class="btn btn-primary">
                                        <i class="bi bi-people-fill"></i> Go to Manage Users
                                    </a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </main>
</body>

</html>