<?php include('../includes/config.php') ?>
<?php include('../includes/functions.php') ?>




<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<main class="app-main">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Manage Student Fees Detail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Admin</a></li>
                        <li class="breadcrumb-item active">Section Student Fees Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if (isset($_GET['action']) && $_GET['action'] == 'view') {
                $std_id = isset($_GET['std_id']) ? $_GET['std_id'] : '';
                $usermeta = get_user_metadata($std_id);
            ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Student details
                        </h3>
                    </div>
                    <div class="card-body">
                        <strong>Name:
                        </strong> <?php echo get_users(array('id' => $std_id))[0]->name ?></br>
                        <strong>Class:</strong>
                        <?php echo $usermeta['class']; ?></br>


                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            School Fees
                        </h3>
                        <div class="card-body"></div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>Sr.No</th>
                                <th>Months</th>
                                <th>Fee Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php

                                $months = array(
                                    'January',
                                    'February',
                                    'March',
                                    'April',
                                    'May',
                                    'June',
                                    'July',
                                    'August',
                                    'September',
                                    'October',
                                    'November',
                                    'December'
                                );
                                //$currentMonth = date('F');
                                foreach ($months as $key => $value) {
                                    $highlight = '';
                                    $highlight = (date('F') == ucwords($value)) ? 'class="table-success text-black"' : '';
                                ?>
                                    <tr>
                                        <td><?php echo ++$key ?></td>
                                        <td <?php echo $highlight ?>><?php echo ucwords($value) ?></td>
                                        <td></td>
                                        <td>
                                            <a href="?action=pay&month=<?php echo $value; ?>&std_id=<?php echo $std_id; ?>"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> view
                                            </a>
                                            <a href="?action=pay&month=<?php echo $value; ?>&std_id=<?php echo $std_id; ?>"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-wallet"></i> Pay Now
                                            </a>
                                            <a href="?action=pay&month=<?php echo $value; ?>&std_id=<?php echo $std_id; ?>"
                                                class="btn btn-sm btn-dark">
                                                <i class="fa-solid fa-envelope "></i> Send Message
                                            </a>
                                            <a href="?action=pay&month=<?php echo $value; ?>&std_id=<?php echo $std_id; ?>"
                                                class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash "></i> Delete
                                            </a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            <?php } else { ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Student Name</th>
                            <th>Last Payment</th>
                            <th>Due Payment</th>
                            <th>Fees Status</th>
                            <th>Action</th>

                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        $students = get_users(array('user_Type' => 'student'));
                        foreach ($students as $key => $student) { ?>

                            <tr>
                                <td><?php echo ++$key ?></td>
                                <td><?php echo $student->name ?></td>
                                <td></td>
                                <td></td>
                                <td>4/12</td>
                                <td>
                                    <a href="?action=view&std_id=<?php echo $student->id; ?>"
                                        class="btn btn-sm btn-info">
                                        <i class="fa fa-eye fa-fw"></i> View</a>
                                </td>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
            <!-- Info boxes -->
        </div>
    </section>

    <!-- /.content -->
</main>


<?php include('footer.php'); ?>