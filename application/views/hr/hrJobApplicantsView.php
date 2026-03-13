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
    <link rel="stylesheet" href="<?= base_url() ?>css/hr/hrJobApplicantsView.css">
   
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
                        <h2 class="section-title">Review & Status</h2>

                        <?= form_open('Employee/viewJobApplicants') ?>

                        <input type="hidden" name="applicant_id" id="review_applicant_id">

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

                        <?= form_close() ?>

                    </div>


                    <div class="status-section interview-section">

                        <h2 class="section-title">
                            <i class="fas fa-calendar-check"></i> Schedule Interview
                        </h2>

                        <?= form_open('Employee/sendInterviewInvite', ['id' => 'interviewForm']) ?>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>"
                            value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" name="applicant_id" id="invite_applicant_id">
                        <input type="hidden" name="email" id="invite_email">
                        <input type="hidden" name="name" id="invite_name">
                        <input type="hidden" name="position" id="invite_position">
                        <input type="hidden" name="phone" id="invite_phone">

                        <div class="interview-grid">

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-calendar-alt"></i> Interview Date
                                </label>
                                <div class="input-wrapper">
                                    <input type="date" name="interview_date" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i class="fas fa-clock"></i> Interview Time
                                </label>
                                <div class="input-wrapper">
                                    <input type="time" name="interview_time" required>
                                </div>
                            </div>

                        </div>

                        <!-- NEW LOCATION FIELD -->

                        <div class="form-group">
                            <label>
                                <i class="fas fa-map-marker-alt"></i> Interview Location
                            </label>

                            <div class="input-wrapper">
                                <input type="text" name="location" placeholder="Interview Office Address" required>
                            </div>
                        </div>

                        <button type="submit" class="invite-btn">
                            <i class="fas fa-paper-plane"></i> Send Interview Invitation
                        </button>

                        <?= form_close() ?>

                    </div>
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

                let id = this.dataset.id;
                let name = this.dataset.name;
                let email = this.dataset.email;
                let phone = this.dataset.phone;
                let position = this.dataset.position;
                let salary = this.dataset.salary;
                let status = this.dataset.status;
                let experience = this.dataset.exp;
                let resume = this.dataset.resume;

                // Fill Candidate Info section
                document.getElementById("app_id").innerText = "APP" + id;
                document.getElementById("app_name").innerText = name;
                document.getElementById("app_email").innerText = email;
                document.getElementById("app_phone").innerText = phone;
                document.getElementById("app_position").innerText = position;
                document.getElementById("app_salary").innerText = salary || 'Not specified';
                document.getElementById("app_status").innerText = status || 'Not specified';
                document.getElementById("app_experience").innerText = experience || 'Not specified';

                // Handle resume link
                if (resume && resume !== '') {
                
                    const baseUrl = '<?= base_url(); ?>';

                    // 2. Clean the path: remove './' if it exists at the start of the string
                    const cleanPath = resume.replace(/^\.\//, '');

                    // 3. Construct the final URL. 
                    let fullResumePath;
                    if (cleanPath.startsWith('resume/')) {
                        fullResumePath = baseUrl + cleanPath+'.pdf';
                    } else {
                        fullResumePath = baseUrl + 'resume/' + cleanPath+'.pdf';
                    }

                    document.getElementById("app_resume").innerHTML =
                        "<a href='" + fullResumePath + "' target='_blank' download style='color: #4f46e5; text-decoration: none; padding: 10px 20px; background: #f0f9ff; border: 1px solid #3b82f6; border-radius: 8px; display: inline-block; font-weight: 600;'> <i class='fas fa-file-download'></i> Download Resume</a>";
                } else {
                    document.getElementById("app_resume").innerHTML =
                        "<span style='color: #6b7280; font-style: italic;'>No resume uploaded</span>";
                }
                // Fill hidden interview form fields
                document.getElementById("invite_applicant_id").value = id;
                document.getElementById("invite_email").value = email;
                document.getElementById("invite_name").value = name;
                document.getElementById("invite_position").value = position;
                document.getElementById("invite_phone").value = phone;

                // Also fill review form
                document.getElementById("review_applicant_id").value = id;

                // Scroll down to candidate information section
                document.querySelector('.candidate-info').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

            });

        });

        // Form validation before submission
        document.getElementById('interviewForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Always prevent default first

            // Check if applicant is selected
            const applicantId = document.getElementById("invite_applicant_id").value;
            const applicantName = document.getElementById("invite_name").value;

            if (!applicantId || applicantId === '' || !applicantName || applicantName === '') {
                alert('Please first select an applicant by clicking the "View" button before scheduling an interview.');
                return false;
            }

            // Check if interview date is filled
            const interviewDate = document.querySelector('input[name="interview_date"]').value;
            if (!interviewDate) {
                alert('Please enter interview date');
                document.querySelector('input[name="interview_date"]').focus();
                return false;
            }

            // Check if interview time is filled
            const interviewTime = document.querySelector('input[name="interview_time"]').value;
            if (!interviewTime) {
                alert('Please enter interview time');
                document.querySelector('input[name="interview_time"]').focus();
                return false;
            }

            // Check if interview location is filled
            const interviewLocation = document.querySelector('input[name="location"]').value;
            if (!interviewLocation || interviewLocation.trim() === '') {
                alert('Please enter interview location');
                document.querySelector('input[name="location"]').focus();
                return false;
            }

            // Confirm before sending
            const confirmSend = confirm('Are you sure you want to send the interview invitation?\n\n' +
                'Applicant: ' + applicantName + '\n' +
                'Date: ' + interviewDate + '\n' +
                'Time: ' + interviewTime + '\n' +
                'Location: ' + interviewLocation + '\n\n' +
                'Click OK to send or Cancel to go back.');

            if (!confirmSend) {
                return false;
            }

            // If all validations pass, submit the form
            this.submit();
        });
    </script>
</body>

</html>