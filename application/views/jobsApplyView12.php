<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
    <link rel="stylesheet" href="<?= base_url(); ?>css/jobsApplyView.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="row mb-4">
        <div class="col-12">
            <a href="<?= base_url('Careers/Jobs') ?>"
                class="text-decoration-none text-secondary fw-semibold back-btn d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-2"></i> Back to job View
            </a>
        </div>
    </div>
    <div class="container">

        <div class="header">
            <h1>Job Application Form</h1>
            <p>Please complete all required fields</p>
        </div>

        <?= form_open_multipart("Jobs/ApplyStatus") ?>
        <div class="form-container">

            <div class="form-row">
                <div class="form-group">
                    <label for="fullName">Full Name <span style="color: #dc3545;">*</span></label>
                    <input type="text" id="fullName" name="fullname" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address <span style="color: #dc3545;">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="position">Position Applying For <span style="color: #dc3545;">*</span></label>
                    <input type="text" id="position" name="position" required>
                </div>
            </div>

            <!-- Resume Upload Section -->
            <div class="form-group full-width">
                <div class="resume-section">
                    <h3>Resume Upload <span style="color: #dc3545;">*</span></h3>
                    <div class="upload-area" id="uploadArea">
                        <span class="upload-icon">📎</span>
                        <div>Click here or drag & drop your resume</div>
                        <div style="font-size: 0.9em; color: #6c757d; margin-top: 5px;">PDF ONLY (Max 5MB)</div>
                        <input type="file" id="resume-file" name="resume" accept=".pdf,.doc,.docx" required>
                        <div class="file-info" id="fileInfo"></div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="experience">Years of Experience (ex: 5)</label>
                    <input type="text" id="experience" name="experience">
                </div>
                <div class="form-group">
                    <label for="salary">Expected Salary (Annual) (ex: 10,000)</label>
                    <input type="text" id="salary" name="salary">
                </div>
            </div>

            <div class="form-group full-width">
                <label for="coverLetter">Cover Letter</label>
                <textarea id="coverletter" name="coverletter"
                    placeholder="Tell us why you are a great fit for this position..."></textarea>
            </div>

            <button type="submit" class="submit-btn">Submit Application</button>
        </div>
        <?= form_close() ?>
    </div>

    <script>
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('resume-file');
        const fileInfo = document.getElementById('fileInfo');
        const form = document.getElementById('jobForm');

        // Click to browse
        uploadArea.addEventListener('click', () => fileInput.click());

        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                updateFileInfo();
            }
        });

        fileInput.addEventListener('change', updateFileInfo);

        function updateFileInfo() {
            if (fileInput.files[0]) {
                const file = fileInput.files[0];
                const sizeMB = (file.size / 1024 / 1024).toFixed(1);
                fileInfo.innerHTML = `Selected: <strong>${file.name}</strong> (${sizeMB} MB)`;
            } else {
                fileInfo.textContent = '';
            }
        }
    </script>
</body>

</html>