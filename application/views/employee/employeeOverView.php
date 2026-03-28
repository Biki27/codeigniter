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

     <link href="<?= base_url('css/employee/employeeOverView.css') ?>" rel="stylesheet">
</head>

<body>

<div class="container py-4" id="overview-section" style="display: block;">

    <!-- HEADER -->
    <div class="mb-4 p-3 rounded-4 shadow-sm text-white"
         style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
        <h4 class="fw-bold mb-1">
            <i class="fas fa-chart-line me-2"></i>Overview Dashboard
        </h4>
        <small class="opacity-75">Your performance & personal details</small>
    </div>

    <div class="row g-4">

        <!-- SALARY CARD -->
        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 text-center p-4 h-100">
                <div class="mb-3">
                    <i class="fas fa-wallet fa-2x text-success"></i>
                </div>
                <h6 class="text-muted">Monthly Salary</h6>
                <h3 class="fw-bold text-success">
                    ₹ <?= $empdetails->seempd_salary ?>
                </h3>

                <div class="progress mt-3" style="height: 8px;">
                    <div class="progress-bar bg-success" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <!-- HOLIDAY CARD -->
        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 text-center p-4 h-100">
                <div class="mb-3">
                    <i class="fas fa-calendar-check fa-2x text-info"></i>
                </div>
                <h6 class="text-muted">Holidays Used</h6>
                <h3 class="fw-bold text-info">
                    <?= $holidays_taken ?>/20
                </h3>

                <div class="progress mt-3" style="height: 8px;">
                    <div class="progress-bar bg-info"
                         style="width: <?= $holidays_percent ?>%">
                    </div>
                </div>
            </div>
        </div>

        <!-- EMPLOYEE INFO CARD -->
        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 p-4 h-100">

                <h5 class="fw-bold mb-3 text-primary">
                    <i class="fas fa-id-badge me-2"></i>Employee Info
                </h5>

                <div class="d-flex flex-column gap-2 small">

                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Employee ID</span>
                        <span class="fw-semibold"><?= $empdetails->seempd_empid ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Name</span>
                        <span class="fw-semibold"><?= $empdetails->seempd_name ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Email</span>
                        <span class="fw-semibold"><?= $this->session->userdata('email') ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Phone</span>
                        <span class="fw-semibold"><?= $empdetails->seempd_phone ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Position</span>
                        <span class="fw-semibold"><?= $empdetails->seempd_designation ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Experience</span>
                        <span class="fw-semibold"><?= $empdetails->seempd_experience ?> Years</span>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <!-- <div class="footer">
            © 2026 Suropriyo Enterprise. All rights reserved.
        </div> -->
</body>

</html>