<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f8f9fa;
            padding: 20px 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: #2c3e50;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 1.8em;
            margin-bottom: 5px;
            font-weight: 400;
        }

        .header p {
            font-size: 1em;
            opacity: 0.9;
        }

        .form-container {
            padding: 40px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #495057;
            font-size: 0.95em;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.2s ease;
            background: white;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Resume Upload Section - Professional Style */
        .resume-section {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 30px;
            margin: 30px 0;
        }

        .resume-section h3 {
            font-size: 1.2em;
            margin-bottom: 15px;
            color: #2c3e50;
            font-weight: 500;
        }

        .upload-area {
            border: 2px dashed #adb5bd;
            border-radius: 4px;
            padding: 30px;
            text-align: center;
            background: white;
            cursor: pointer;
            transition: border-color 0.2s ease;
            position: relative;
        }

        .upload-area:hover {
            border-color: #007bff;
        }

        .upload-area.dragover {
            border-color: #007bff;
            background: #f8f9ff;
        }

        .upload-icon {
            font-size: 2.5em;
            margin-bottom: 15px;
            display: block;
            color: #6c757d;
        }

        .file-info {
            margin-top: 12px;
            font-size: 0.9em;
            color: #28a745;
            min-height: 20px;
        }

        #resume-file {
            display: none;
        }

        .submit-btn {
            background: #007bff;
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s ease;
        }

        .submit-btn:hover:not(:disabled) {
            background: #0056b3;
        }

        .submit-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .form-container {
                padding: 30px 20px;
            }

            .header {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>
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