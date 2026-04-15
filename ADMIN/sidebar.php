<!-- Sidebar -->
<div class="sidebar p-3">
    <h4 class=" mb-4">Menu</h4>
    <ul class="nav flex-column">

        <!-- Start Manage account -->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#accountMenu" role="button">
                <span><i class="bi bi-person-gear me-2"></i> Manage Account</span>
                <i class="bi bi-chevron-left"></i>
            </a>
            <div class="collapse" id="accountMenu">
                <ul class="nav flex-column ms-3">
                    <li><a class="nav-link" href="manage_account.php">All Users</a></li>
                    <li><a class="nav-link" href="manage_account.php?filter=Student">Students</a></li>
                    <li><a class="nav-link" href="manage_account.php?filter=Teacher">Teachers</a></li>

                </ul>
            </div>
        </li>
        <!-- End Manage account -->

        <!--Start Manage Classes-->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#classesMenu" role="button">
                <span><i class="bi bi-easel-fill me-2 me-2"></i> Manage Classes</span>
                <i class="bi bi-chevron-left"></i>
            </a>
            <div class="collapse" id="classesMenu">
                <ul class="nav flex-column ms-3">
                    <li><a class="nav-link" href="classes.php">Classes</a></li>
                    <li><a class="nav-link" href="section.php">Section</a></li>
                    <li><a class="nav-link" href="subject.php">Subject</a></li>
                    
                </ul>
            </div>
        </li>
        <!--End Manage Classes-->

        <!--Start Manage Class Routine-->
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#classMenu" role="button">
                <span><i class="bi bi-easel-fill me-2 me-2"></i> Manage Class Routine</span>
                <i class="bi bi-chevron-left"></i>
            </a>
            <div class="collapse" id="classMenu">
                <ul class="nav flex-column ms-3">
                    <li><a class="nav-link" href="period.php">Period</a></li>
                    <li><a class="nav-link" href="timetable.php">Time-Table</a></li>
                </ul>
            </div>
        </li>
        <!--End Manage Class Routine-->
    </ul>
</div>