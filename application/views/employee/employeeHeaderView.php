<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>css/employeeHeader.css">

</head>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="fas fa-building"></i> Supropriyo Enterprise - ESS
            Portal</a>
        <a href="<?= base_url() ?>index.php/Employee/Logout" class="btn btn-outline-light ms-auto"><i
                class="fas fa-sign-out-alt"></i>
            Logout</a>
    </div>
</nav>
<div class="container mt-4">

    <!-- HEADER -->
    <div class="row">
        <div class="col-12">
            <h1 id="employeeName" class="mb-4 text-primary"><i class="fas fa-user-tie"></i> Welcome <?= $this->session->userdata('empname'); ?>,</h1>
            <div class="d-flex justify-content-between mb-5 flex-wrap">
                <a  href="<?= base_url() ?>index.php/Employee/ChangePassword" class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                    <i class="fas fa-key"></i> Change Password
                </a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold" id="changePasswordLabel"><i class="fas fa-key"></i> Change
                        Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                   <?= form_open('Employee/ChangePassword') ?>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Current Password</label>
                            <input name="oldpass" type="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">New Password</label>
                            <input name="newpass" type="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Confirm New Password</label>
                            <input name="confirmpass" type="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Password</button>
                    <?= form_close() ?>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- NAVIGATION BUTTONS -->
    <div class="row mb-4">

        <div class="col-12">
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="<?= base_url() ?>index.php/Employee/EmployeeOverview" class="nav-section-btn"
                    id="overview-btn">
                    <i class="fas fa-home me-2"></i>Overview
                </a>
                <a href="<?= base_url() ?>index.php/Employee/EmployeeAttendence" class="nav-section-btn"
                    id="attendance-btn">
                    <i class="fas fa-clock me-2"></i>Attendance
                </a>
                <a href="<?= base_url() ?>index.php/Employee/EmployeeRequest" class="nav-section-btn" id="requests-btn">
                    <i class="fas fa-paper-plane me-2"></i>Requests
                </a>
            </div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>