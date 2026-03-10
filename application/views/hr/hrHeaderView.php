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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: radial-gradient(circle at 0% 50%, #461bb9 20%, #973ce0 50%, #6b37e4 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: #333;
            overflow-x: hidden;
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.97);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            padding: 25px 20px;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #461bb9, #973ce0);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin: 0 auto 15px;
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
        }

        .nav-link {
            display: flex;
            align-items: center;
            color: #6b37e4 !important;
            font-weight: 500;
            margin-bottom: 12px;
            padding: 12px 20px !important;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white !important;
            transform: translateX(5px);
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
        }

        .mobile-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            background: white;
            border: none;
            padding: 12px;
            border-radius: 12px;
            color: #461bb9;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-overlay.active {
                display: block;
            }
        }
    </style>
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