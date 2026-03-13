<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Management | Supropriyo Enterprise</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>css/admin/adminJobApplicationsView.css"> 
</head>

<body>
    <?php if ($this->session->flashdata('msg')) { ?>

        <script>
            alert("<?= $this->session->flashdata('msg') ?>");
        </script>

    <?php } ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-container">
            <header class="main-heading">
                <h1>Applicant Management Dashboard</h1>
                <p>Review and manage job applications efficiently</p>
            </header>

            <!-- PERFECT 2-COLUMN LAYOUT -->
            <div class="dual-layout">
                <!-- LEFT: Applicants List -->
                <div class="applicants-section">
                    <h2 class="section-title">Applicants List</h2>

                    <!-- Search Bar -->
                    <form class="search-container">
                        <input type="text" class="search-bar" placeholder="Search by ID, Name, Email, Position..."
                            id="searchInput">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <table id="applicantsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($applicants as $app) { ?>

                                <tr>
                                    <td>APP<?= str_pad($app->sejoba_id, 1, '0', STR_PAD_LEFT) ?></td>

                                    <td><?= date('Y-m-d', strtotime($app->sejoba_atime)) ?></td>

                                    <td><?= $app->sejoba_name ?></td>

                                    <td><?= $app->sejoba_email ?></td>

                                    <td><?= $app->sejoba_position ?></td>

                                    <td>
                                        <button class="view-btn" data-id="<?= $app->sejoba_id ?>"
                                            data-name="<?= $app->sejoba_name ?>" data-email="<?= $app->sejoba_email ?>"
                                            data-phone="<?= $app->sejoba_phone ?>"
                                            data-position="<?= $app->sejoba_position ?>"
                                            data-salary="<?= $app->sejoba_exp_salary ?>"
                                            data-status="<?= $app->sejoba_state ?>"
                                            data-exp="<?= $app->sejoba_experience ?>"
                                            data-resume="<?= $app->sejoba_resume ?>">
                                            View
                                        </button>
                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>

                <!-- RIGHT: LIGHT BLUE CONTAINER -->
                <div class="candidate-section">
                    <!-- Candidate Information -->
                    <div class="candidate-info">
                        <h2 class="section-title">Candidate Information</h2>
                        <div class="info-row">
                            <span class="info-label">Applicant ID:</span>
                            <span class="info-value" id="app_id"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Name:</span>
                            <span class="info-value" id="app_name"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email:</span>
                            <span class="info-value" id="app_email"></span>

                        </div>
                        <div class="info-row">
                            <span class="info-label">Phone No:</span>
                            <span class="info-value" id="app_phone"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Applied Position:</span>
                            <span class="info-value" id="app_position"></span>

                        </div>
                        <div class="info-row">
                            <span class="info-label">Expected Salary:</span>
                            <span class="info-value" id="app_salary"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span class="info-value" id="app_status"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Experience:</span>
                            <span class="info-value" id="app_experience"></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Resume:</span>
                            <span class="info-value" id="app_resume">
                                <!-- <a href="#" style="color: #4f46e5; text-decoration: none;">Download Resume.pdf</a> -->
                            </span>
                        </div>
                    </div>

                    <!-- Review & Status -->
                    <div class="status-section">
                        <h2 class="section-title">Review & Statusview-btn</h2>

                        <?= form_open('Employee/viewJobApplicants') ?>

                        <input type="hidden" name="applicant_id" id="applicant_id">

                        <div class="form-group">
                            <label>Status</label>

                            <select name="status">
                                <option value="">Select Status</option>
                                <option value="pending">Pending</option>
                                <option value="selected">Selected</option>
                                <option value="rejected">Rejected</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Comment</label>
                            <textarea name="comment" placeholder="Add your comments about the candidate..."></textarea>

                        </div>

                        <button type="submit" class="submit-btn">

                            Submit Review

                        </button>

                        <!-- <?= form_close() ?>
                        <a href="https://your-interview-link.com/invite?applicant=APP001" class="invite-btn"
                            target="_blank" rel="noopener noreferrer">
                            Send Interview Invite
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        © 2026 Supropriyo Enterprise. All rights reserved.
    </div>

    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            event.target.closest('.nav-link').classList.add('active');
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'index.html';
            }
        }

        // Search functionality
        function filterApplicants(searchTerm) {
            const rows = document.querySelectorAll('#applicantsTable tbody tr');
            const normalizedTerm = searchTerm.toLowerCase().trim();

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(normalizedTerm) ? '' : 'none';
            });
        }

        // Live search + button search
        document.getElementById('searchInput').addEventListener('input', function (e) {
            filterApplicants(e.target.value);
        });

        document.querySelector('form.search-container').addEventListener('submit', function (e) {
            e.preventDefault();
            const searchInput = document.getElementById('searchInput');
            filterApplicants(searchInput.value);
        });

        // View button functionality
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function () {
                // 1. Fill the text details
                document.getElementById('app_id').innerText = "APP" + this.dataset.id;
                document.getElementById('app_name').innerText = this.dataset.name;
                document.getElementById('app_email').innerText = this.dataset.email;
                document.getElementById('app_phone').innerText = this.dataset.phone;
                document.getElementById('app_position').innerText = this.dataset.position;
                document.getElementById('app_salary').innerText = this.dataset.salary;
                document.getElementById('app_status').innerText = this.dataset.status;
                document.getElementById('app_experience').innerText = this.dataset.exp;

                // Hidden input for the form submission
                document.getElementById('applicant_id').value = this.dataset.id;

                // 2. Handle the Resume Download
                const rawPath = this.dataset.resume; // e.g., "./resume/filename.pdf"
                const resumeElement = document.getElementById("app_resume");

                if (rawPath && rawPath !== "") {
                    // Clean the path: remove './' if it exists at the start
                    const cleanPath = rawPath.replace(/^\.\//, '');

                    // Construct the final URL using CodeIgniter's base_url
                    const fileUrl = "<?= base_url() ?>" + cleanPath+'.pdf';

                    resumeElement.innerHTML = `
                <a href="${fileUrl}" target="_blank" style="color: #461bb9; font-weight: 600; text-decoration: none;">
                    <i class="fas fa-file-download me-2"></i>Download Resume
                </a>
            `;
                } else {
                    resumeElement.innerText = "No Resume Uploaded";
                }
                //scroll to the candidate info section
                document.querySelector('.candidate-section').scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
</body>

</html>