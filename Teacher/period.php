<?php
session_start();
include('../includes/config.php');
include('header.php');
include('sidebar.php');



$teacher_id = $_SESSION['user_id']; // ✅ logged-in teacher ID

// ✅ Fetch only this teacher’s timetable
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
WHERE t.teacher_id = '$teacher_id'
ORDER BY c.id, t.id
";
$result = mysqli_query($db_conn, $query);
?>

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i>
                <?= htmlspecialchars($_SESSION['user_name']) ?>'s Timetable
            </h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Subject</th>
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
                                    <td><?= htmlspecialchars($row['day']) ?></td>
                                    <td><?= htmlspecialchars($row['time_slot']) ?></td>
                                </tr>
                            <?php } ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-muted">No timetable data found for you.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>