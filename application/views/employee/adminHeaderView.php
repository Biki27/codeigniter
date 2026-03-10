<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
    }

    /* .sidebar {
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
    } */
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

        overflow-y: auto;
        /*  ADD for Scrollbar bar */
        scrollbar-width: thin
    }

    .logo {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(70, 27, 185, 0.1);
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

    .logo h5 {
        color: #461bb9;
        font-weight: 700;
        font-size: 1.3rem;
        margin: 0;
    }

    .nav-link {
        display: flex;
        align-items: center;
        color: #6b37e4 !important;
        font-weight: 500;
        margin-bottom: 12px;
        padding: 12px 20px !important;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .nav-link i {
        margin-right: 12px;
        width: 20px;
        text-align: center;
    }

    .nav-link:hover {
        background: linear-gradient(135deg, #461bb9, #973ce0);
        color: white !important;
        transform: translateX(8px);
        box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
    }

    .nav-link.active {
        background: linear-gradient(135deg, #461bb9, #973ce0);
        color: white !important;
    }

    .footer {
        position: fixed;
        bottom: 0;
        left: 260px;
        right: 0;
        text-align: center;
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.9rem;
        padding: 15px;
        background: rgba(70, 27, 185, 0.1);
        backdrop-filter: blur(10px);

    }

    /* RESPONSIVE SIDEBAR - ADD THIS TO EXISTING CSS */
    @media (max-width: 992px) {
        .sidebar {
            width: 280px;
            transform: translateX(-100%);
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .main-content,
        .footer {
            margin-left: 0;
            transition: margin-left 0.4s ease;
        }
    }

    @media (min-width: 993px) {
        .sidebar {
            transform: translateX(0) !important;
        }
    }

    /* MOBILE OVERLAY */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
    }

    .sidebar-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* MOBILE HAMBURGER BUTTON */
    .mobile-toggle {
        position: fixed;
        top: 25px;
        left: 25px;
        z-index: 1100;
        background: rgba(255, 255, 255, 0.95);
        border: none;
        width: 55px;
        height: 55px;
        border-radius: 15px;
        color: #461bb9;
        font-size: 1.4rem;
        cursor: pointer;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(20px);
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        display: none;
    }

    .mobile-toggle:hover {
        transform: scale(1.05);
        box-shadow: 0 18px 45px rgba(70, 27, 185, 0.4);
    }

    @media (max-width: 992px) {
        .mobile-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }
    </style>
</head>

<body>
    <!-- MOBILE TOGGLE BUTTON -->
    <button class="mobile-toggle" id="mobileToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- MOBILE OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-building"></i>
            </div>
            <h5>Suropriyo Enterprise</h5>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link" href="<?= base_url() ?>index.php/Employee/Dashboard">
                <i class="fas fa-chart-line"></i> Overview
            </a>
            <a class="nav-link" href="<?= base_url() ?>index.php/Employee/viewEmployee">
                <i class="fas fa-users"></i> Employees
            </a>
            <a class="nav-link" href="<?= base_url() ?>index.php/Employee/viewAttendance">
                <i class="fas fa-calendar-alt"></i> Attendance
            </a>
            <a class="nav-link" href="<?= base_url() ?>index.php/Employee/viewJobApplicants">
                <i class="fas fa-calendar-alt"></i> JobApplicants
            </a>
            <a class="nav-link" href="<?= base_url() ?>index.php/Employee/viewProjects">
                <i class="fas fa-project-diagram"></i> Projects
            </a>
            <a class="nav-link" href="<?= base_url() ?>index.php/Employee/RegisterEmployee">
                <i class="fas fa-user-plus"></i> Add Employee
            </a>
            <a class="nav-link" href="<?= base_url() ?>index.php/Employee/addProjectPage">
                <i class="fas fa-plus"></i> Add Project
            </a>
            <a class="nav-link" href="<?= base_url() ?>index.php/Employee/Logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>
    </div>

    <div class="footer">
        © <?= date('Y') ?> Suropriyo Enterprise. All rights reserved.
    </div>
    <!-- add code for --- -->
</body>

</html>