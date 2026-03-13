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

    <!-- ✅ OVERVIEW SECTION (EXACT ORIGINAL FROM DASHBOARD) -->
    <div class="container mt-4" id="overview-section" class="section-content" style="display: block;">
        <div class="row">

            <div class="col-md-4 mb-4">
                <div class="card p-3 text-center">
                    <span class="fa-2x text-success mb-2">₹</span>
                    <h5 class="fw-semibold">Yearly Salary</h5>
                    <p id="salary" class="h4 text-success fw-bold">
                        ₹ <?= $empdetails->seempd_salary ?>
                    </p>
                    <!-- mini-chart changed to progress bar -->
                    <div class="progress mt-2" style="height: 20px; background: #e9ecef;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 100%;"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card p-3 text-center">
                    <i class="fas fa-calendar-alt fa-2x text-info mb-2"></i>
                    <h5 class="fw-semibold">Holidays Used</h5>
                    <p id="holidays" class="h4 text-info fw-bold"><?= $holidays_taken ?>/20</p>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-info" style="width: <?= $holidays_percent ?>%"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card p-3 text-left">
                    <div class="candidate-section">
                        <div class="candidate-info">

                            <h3 class="section-title" style="margin-bottom:20px;">Employee Information</h3>

                            <div class="info-row">
                                <span class="info-label">Employee ID:</span>
                                <span class="info-value"><?= $empdetails->seempd_empid ?></span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Name:</span>
                                <span class="info-value"><?= $empdetails->seempd_name ?></span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Email:</span>
                                <span class="info-value"><?= $this->session->userdata('email') ?></span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Phone No:</span>
                                <span class="info-value"><?= $empdetails->seempd_phone ?></span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Position:</span>
                                <span class="info-value"><?= $empdetails->seempd_designation ?></span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Experience:</span>
                                <span class="info-value"><?= $empdetails->seempd_experience ?> Years</span>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- <div class="col-md-4 mb-4">
                    <div class="card p-3">
                        <i class="fas fa-list fa-2x text-warning mb-2"></i>
                        <h5 class="fw-semibold">Leaves Taken</h5>
                        <input type="text" class="form-control mb-2" placeholder="Search leaves..." id="searchLeaves">
                        <ul id="leavesList" class="list-group list-group-flush" style="max-height: 200px; overflow-y: auto;">
                             Populated by JS
                        </ul>
                    </div>
                </div> -->
            </div>

            <!-- ✅ PAYSILP BUTTON (EXACT ORIGINAL)
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#payslipModal">
                        <i class="fas fa-download"></i> Download Payslip
                    </button>
                </div>
            </div> -->

        </div>

        <!-- ========== ALL MODALS (Including PAYSILP MODAL) ========== -->

        <!-- EDIT PROFILE MODAL
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold" id="editProfileLabel"><i class="fas fa-user-edit"></i> Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" id="editName" value="John Doe" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" id="editEmail" value="john.doe@supropriyo.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="tel" class="form-control" value="+91 98765 43210">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

        <!-- CHANGE PASSWORD MODAL -->
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
                        <form id="changePasswordForm">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Current Password</label>
                                <input type="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">New Password</label>
                                <input type="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Confirm New Password</label>
                                <input type="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- 
    <div class="modal fade" id="payslipModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-file-invoice-dollar me-2"></i>Select Payslip Period
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Payslip Type</label>
                            <select class="form-select" id="payslipType">
                                <option value="monthly">Monthly Payslip</option>
                                <option value="annual">Annual Payslip</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" id="monthLabel">Select Month</label>
                            <select class="form-select" id="monthSelect">
                                <option value="">Choose month...</option>
                            </select>
                        </div>
                        <div class="col-12 d-none" id="yearDiv">
                            <label class="form-label fw-semibold">Select Year</label>
                            <select class="form-select" id="yearSelect">
                                <option value="">Choose year...</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="generatePayslip">
                        <i class="fas fa-file-pdf me-2"></i> Generate & Download PDF
                    </button>
                </div> 
            </div>
        </div>
    </div> -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <div class="footer">
            © 2026 Suropriyo Enterprise. All rights reserved.
        </div>
</body>

</html>