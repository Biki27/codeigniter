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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at 0% 50%, #461bb9 20%, #973ce0 50%, #6b37e4 100%);
            min-height: 100vh;
            color: #333;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Sidebar - FIXED */
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
            color: #6b37e4;
            font-weight: 500;
            margin-bottom: 12px;
            padding: 12px 20px;
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

        /* Main Content - OFFSET BY SIDEBAR */
        .main-content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
            padding-bottom: 120px;
        }

        .page-container {
            max-width: 1600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .main-heading {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .main-heading h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        /* PERFECT 2-COLUMN LAYOUT */
        .dual-layout {
            display: block;
            gap: 30px;
            padding: 40px;
            min-height: 80vh;
        }

        /* LEFT SIDE - Applicants List */
        .applicants-section {
            flex: 1;
            background: rgba(250, 251, 252, 0.8);
            border-radius: 20px;
            padding: 30px;
        }

        /* RIGHT SIDE - LIGHT BLUE CONTAINER */
        .candidate-section {
            flex: 1;
            margin-top: 30px;
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(14, 165, 233, 0.2);
            box-shadow: 0 10px 30px rgba(14, 165, 233, 0.15);
        }

        .section-title {
            font-size: 1.4rem;
            color: #461bb9;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(70, 27, 185, 0.1);
            font-weight: 700;
        }

        /* Search Bar Styles */
        .search-container {
            margin-bottom: 30px;
        }

        form.search-container {
            position: relative;
            display: flex;
            max-width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 2px solid rgba(70, 27, 185, 0.2);
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        form.search-container:focus-within {
            box-shadow: 0 12px 35px rgba(70, 27, 185, 0.25);
            border-color: #461bb9;
            transform: translateY(-2px);
        }

        .search-bar {
            flex: 1;
            padding: 18px 20px;
            border: none;
            outline: none;
            font-size: 16px;
            font-family: inherit;
            background: transparent;
            color: #1e293b;
        }

        .search-bar::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        .search-btn {
            padding: 18px 24px;
            background: linear-gradient(135deg, #461bb9, #973ce0);
            border: none;
            cursor: pointer;
            color: white;
            font-size: 18px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 70px;
        }

        .search-btn:hover {
            background: linear-gradient(135deg, #3a1499, #7f2ed0);
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.4);
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 18px 15px;
            text-align: left;
            border-bottom: 1px solid rgba(225, 229, 233, 0.5);
        }

        th {
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: rgba(70, 27, 185, 0.05);
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        .view-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .view-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        /* Candidate Info */
        .candidate-info {
            background: rgba(248, 250, 252, 0.9);
            padding: 30px;
            border-radius: 20px;
            border: 2px solid rgba(226, 232, 240, 0.5);
            backdrop-filter: blur(10px);
            flex: 1;
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            margin-bottom: 20px;
            align-items: center;
        }

        .info-row.full-width {
            align-items: flex-start;
        }

        .info-label {
            font-weight: 700;
            color: #461bb9;
            min-width: 160px;
            margin-right: 20px;
            font-size: 0.95rem;
        }

        .info-value {
            color: #1f2937;
            flex: 1;
            font-weight: 500;
        }

        /* Review & Status */
        .status-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            border: 2px solid rgba(226, 232, 240, 0.5);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            flex: 1;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-weight: 700;
            color: #461bb9;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        select,
        textarea {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid rgba(209, 213, 219, 0.5);
            border-radius: 12px;
            font-size: 1rem;
            font-family: inherit;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        select:focus,
        textarea:focus {
            outline: none;
            border-color: #461bb9;
            box-shadow: 0 0 0 3px rgba(70, 27, 185, 0.1);
            transform: translateY(-2px);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .submit-btn,
        .invite-btn {
            width: 100%;
            padding: 16px 25px;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
        }

        .invite-btn {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .invite-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 260px;
            right: 0;
            text-align: center;
            color: rgba(255, 255, 255, 0.95);
            font-size: 0.95rem;
            padding: 20px;
            background: rgba(70, 27, 185, 0.2);
            backdrop-filter: blur(15px);
            z-index: 999;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .dual-layout {
                flex-direction: column;
                gap: 25px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content,
            .footer {
                margin-left: 0 !important;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-label {
                min-width: auto;
                margin-bottom: 8px;
            }
        }

        /* Interview Section */
        .interview-section {
            background: linear-gradient(135deg, #e0f2fe, #f8fafc);
            border: 1px solid rgba(14, 165, 233, 0.3);
        }

        /* grid layout */
        .interview-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* input wrapper */
        .input-wrapper {
            position: relative;
        }

        /* input style */
        .input-wrapper input {
            width: 100%;
            padding: 14px 18px;
            border-radius: 10px;
            border: 2px solid rgba(203, 213, 225, 0.6);
            font-size: 15px;
            background: white;
            transition: all 0.3s ease;
        }

        .input-wrapper input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        /* invite button */
        .invite-btn {
            margin-top: 20px;
            width: 100%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border-radius: 12px;
            padding: 16px;
            font-weight: 700;
            letter-spacing: 0.5px;
            border: none;
            transition: all 0.3s ease;
        }

        .invite-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        }
    </style>
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

                // Handle resume display
                if (resume && resume !== '') {
                    // Add base URL and resume folder for proper download
                    const baseUrl = '<?= base_url(); ?>';
                    const fullResumePath = baseUrl + 'resume/' + resume;
                    document.getElementById("app_resume").innerHTML = 
                        "<a href='" + fullResumePath + "' target='_blank' download style='color: #4f46e5; text-decoration: none; padding: 8px 15px; background: #f0f9ff; border-radius: 4px; display: inline-block;'> Download Resume</a>";
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