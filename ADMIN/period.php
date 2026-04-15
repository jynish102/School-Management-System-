<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Fetch full details using JOINs
$query = "
SELECT 
    t.id,
    c.class AS class_name,
    s.title AS section_name,
    sub.subject_name,
    a.name AS teacher_name,
    t.day,
    t.time_slot
FROM timetable t
LEFT JOIN classes c ON t.class_id = c.id
LEFT JOIN section s ON t.section_id = s.id
LEFT JOIN subject sub ON t.subject_id = sub.id
LEFT JOIN account a ON t.teacher_id = a.id
ORDER BY c.id, t.id
";
$result = mysqli_query($db_conn, $query);
?>

<main class="app-main p-4" style="flex:1; min-height:100vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Periods</h2>
        
    </div>

    <div class="container mt-4">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-clock me-2"></i>Period For Teacher</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Day</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $count = 1;
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= htmlspecialchars($row['class_name']) ?></td>
                                        <td><?= htmlspecialchars($row['section_name']) ?></td>
                                        <td><?= htmlspecialchars($row['subject_name']) ?></td>
                                        <td><?= htmlspecialchars($row['teacher_name']) ?></td>
                                        <td><?= htmlspecialchars($row['day']) ?></td>
                                        <td><?= htmlspecialchars($row['time_slot']) ?></td>
                                    </tr>
                                <?php } ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-muted">No timetable data found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>    

<?php include('footer.php'); ?>