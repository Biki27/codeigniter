<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Portal | Suropriyo Enterprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>css/hr/hrHeaderView.css">
</head>

<body>
    <button class="mobile-toggle d-lg-none" id="mobileToggle"><i class="fas fa-bars"></i></button>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar" id="sidebar">

        <nav class="nav flex-column">
            <div class="sidebar" id="sidebar">
                <div class="logo text-center border-bottom mb-4 pb-3">
                    <div class="logo-icon"><i class="fas fa-user-tie"></i></div>
                    <h5 class="fw-bold text-primary">HR Portal</h5>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?= base_url('index.php/Employee/Dashboard') ?>">
                        <i class="fas fa-th-large me-2"></i> Overview
                    </a>
                    <a class="nav-link" href="<?= base_url('index.php/Employee/viewEmployee') ?>">
                        <i class="fas fa-users-cog me-2"></i> Employees
                    </a>
                    <a class="nav-link" href="<?= base_url('index.php/Employee/hrAttendance') ?>">
                        <i class="fas fa-calendar-check me-2"></i> Attendance
                    </a>
                    <a class="nav-link" href="<?= base_url('index.php/Employee/viewJobApplicants') ?>">
                        <i class="fas fa-briefcase me-2"></i> Recruitment
                    </a>
                    <a class="nav-link" href="<?= base_url('index.php/Employee/RegisterEmployee') ?>">
                        <i class="fas fa-user-plus me-2"></i> Add Employee
                    </a>
                    <a class="nav-link" href="<?= base_url('index.php/Employee/logout') ?>">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </nav>
            </div>
        </nav>
    </div>


</body>

</html>