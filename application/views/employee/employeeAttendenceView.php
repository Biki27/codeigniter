<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESS Portal - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/employee/employeeAttendence.css') ?>">
</head>

<body>

    <!-- ATTENDANCE SECTION -->
<div class="container py-4" id="attendance-section" style="display: block;">

    <!-- HEADER -->
    <div class="mb-4 p-3 rounded-4 shadow-sm text-white"
         style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
        <h4 class="mb-1 fw-bold">
            <i class="fas fa-clock me-2"></i>Attendance Summary
        </h4>
        <small class="opacity-75">Track your daily attendance records</small>
    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body">

            <!-- TITLE -->
            <h5 class="fw-semibold mb-3">Attendance History</h5>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Login Time</th>
                            <th>Log Out Time</th>
                        </tr>
                    </thead>

                    <tbody id="attendanceTable">

                        <?php foreach ($attendence as $atdc) { ?>
                            <tr>
                                <td class="fw-medium text-dark">
                                    <i class="fa-regular fa-calendar me-1 text-primary"></i>
                                    <?= $atdc->seemp_logdate?>
                                </td>

                                <td>
                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background: rgba(34,197,94,0.1); color:#16a34a;">
                                        <i class="fas fa-sign-in-alt me-1"></i>
                                        <?= date('h:i A', strtotime($atdc->seemp_logintime)) ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background: rgba(239,68,68,0.1); color:#dc2626;">
                                        <i class="fas fa-sign-out-alt me-1"></i>
                                        <?= date('h:i A', strtotime($atdc->seemp_logouttime)) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</body>

</html>