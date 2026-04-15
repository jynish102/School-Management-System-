<main class="app-main p-4" style="flex:1; min-height:100vh;">
    <h2 class="fw-bold text-primary mb-4">Teacher Dashboard</h2>

    <!-- Dashboard Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Classes Assigned</h5>
                    <p class="display-6 text-primary">5</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">My Students</h5>
                    <p class="display-6 text-success">120</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Assignments to Grade</h5>
                    <p class="display-6 text-warning">8</p>
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

    <!-- Today's Schedule -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-calendar-event"></i> Today's Schedule
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">09:00 AM - Class 10 Science</li>
                <li class="list-group-item">11:00 AM - Class 9 Mathematics</li>
                <li class="list-group-item">02:00 PM - Class 11 Physics</li>
            </ul>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-lightning-fill"></i> Quick Actions
        </div>
        <div class="card-body d-flex gap-3 flex-wrap">
            <a href="attendance.php" class="btn btn-outline-primary">
                <i class="bi bi-check-square"></i> Mark Attendance
            </a>
            <a href="period.php" class="btn btn-outline-warning">
                <i class="bi bi-pencil-square"></i> View Periods
            </a>
            <a href="study_material.php" class="btn btn-outline-info">
                <i class="bi bi-journal-bookmark"></i> Upload Study Material
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
                <li class="list-group-item">📢 Parent-Teacher Meeting on Friday at 4 PM.</li>
                <li class="list-group-item">📢 Exam schedules will be uploaded next week.</li>
                <li class="list-group-item">📢 Submit student progress reports by Monday.</li>
            </ul>
        </div>
    </div>
</main>