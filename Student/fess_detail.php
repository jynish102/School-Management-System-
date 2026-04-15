<main class="app-main p-4" style="flex:1; min-height:100vh;">
    <h2 class="fw-bold mb-4">Student Dashboard</h2>

    <!-- Dashboard Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">My Classes</h5>
                    <p class="display-6 text-primary">6</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Attendance</h5>
                    <p class="display-6 text-success">92%</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Assignments Pending</h5>
                    <p class="display-6 text-warning">3</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Exams</h5>
                    <p class="display-6 text-danger">2</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Class Timetable -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-calendar-week"></i> Today's Timetable
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">09:00 AM - Mathematics</li>
                <li class="list-group-item">10:30 AM - English</li>
                <li class="list-group-item">12:00 PM - Science</li>
                <li class="list-group-item">02:00 PM - History</li>
            </ul>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-lightning-fill"></i> Quick Actions
        </div>
        <div class="card-body d-flex gap-3 flex-wrap">
            <a href="view_assignments.php" class="btn btn-outline-success">
                <i class="bi bi-journal-text"></i> View Assignments
            </a>
            <a href="submit_homework.php" class="btn btn-outline-info">
                <i class="bi bi-upload"></i> Submit Homework
            </a>
            <a href="exam_schedule.php" class="btn btn-outline-warning">
                <i class="bi bi-pencil-square"></i> Check Exam Schedule
            </a>
            <a href="study_materials.php" class="btn btn-outline-secondary">
                <i class="bi bi-book"></i> Study Materials
            </a>
        </div>
    </div>

    <!-- Recent Notices -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <i class="bi bi-megaphone"></i> Recent Notices
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">📢 Sports Day practice starts next Monday.</li>
                <li class="list-group-item">📢 Submit Science project by Friday.</li>
                <li class="list-group-item">📢 Fee payment due date: 25th Sept.</li>
            </ul>
        </div>
    </div>
</main>