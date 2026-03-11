<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management | Supropriyo Enterprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: radial-gradient(circle at 0% 50%, #461bb9 20%, #973ce0 50%, #6b37e4 100%);
            --primary: #461bb9;
            --secondary: #973ce0;
            --accent: #6b37e4;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.25);
            --shadow-light: 0 10px 40px rgba(0, 0, 0, 0.15);
            --shadow-hover: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--primary-gradient);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .employee-container {
            max-width: 900px;
            margin: 0 auto;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-light);
            overflow: hidden;
            /* margin-left: 500px; */
            margin-bottom: 30px;
        }

        /* NEW: Applicant ID Section */
        .applicant-id-section {
            background: rgba(255, 255, 255, 0.98);
            padding: 1.5rem 3rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            width: 678px;
            margin-bottom: 20px;
        }

        .applicant-id-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex: 1;
            min-width: 280px;
        }

        .applicant-id-input {
            flex: 1;
            height: 44px;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background: white;
        }

        .applicant-id-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(70, 27, 185, 0.1);
            outline: none;
        }

        .fetch-btn {
            height: 44px;
            padding: 0 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .fetch-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem 3rem;
            text-align: center;
        }

        .form-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .form-body {
            padding: 3rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .required {
            color: #ef4444;
        }

        .form-control,
        .form-select {
            height: 48px;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(70, 27, 185, 0.1);
            transform: translateY(-1px);
        }

        .form-control-textarea {
            min-height: 80px;
            resize: vertical;
            padding: 1rem;
        }

        /* Compact Photo Section - Top Right */
        .photo-section {
            position: absolute;
            top: 2.5rem;
            right: 2.5rem;
            width: 100px;
            height: 100px;
            border-radius: 16px;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: var(--shadow-hover);
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .photo-preview {
            width: 100%;
            height: 80%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
            border-radius: 12px;
        }

        .photo-preview:hover {
            transform: scale(1.05);
        }

        /* NEW: Small button under image */
        .photo-btn {
            width: 100%;
            height: 20%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 0 0 12px 12px;
            font-size: 0.7rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .photo-btn:hover {
            background: linear-gradient(135deg, var(--secondary), var(--accent));
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(70, 27, 185, 0.3);
        }

        /* Status Toggle */
        .status-group {
            display: flex;
            gap: 0.75rem;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
        }

        .status-badge {
            padding: 0.5rem 1.25rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
            text-align: center;
        }

        .status-active {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
        }

        .status-inactive {
            background: transparent;
            color: #6b7280;
            border: 2px solid transparent;
        }

        /* CV Upload */
        .cv-upload {
            padding: 1rem;
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            text-align: center;
            background: #f8fafc;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .cv-upload:hover {
            border-color: var(--primary);
            background: rgba(70, 27, 185, 0.05);
        }

        /* Action Buttons */
        /* Center the action buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            /* This centers the items horizontally */
            align-items: center;
            flex-wrap: wrap;
            margin-top: 2.5rem;
            padding-top: 2rem;
            margin-bottom: 20px;
            border-top: 1px solid #e5e7eb;
            width: 100%;
            /* Ensure it spans the full width of the form */
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
            min-width: 160px;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(70, 27, 185, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            min-width: 160px;
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: #6b7280;
            border: 2px solid #e5e7eb;
        }

        .btn-secondary:hover {
            background: #eb5012;
            transform: translateY(-2px);
            color: white;
            border-color: #eb5012;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .employee-container {
                margin: 1rem;
                border-radius: 16px;
            }

            .form-body {
                padding: 2rem 1.5rem;
            }

            .photo-section {
                position: static;
                width: 80px;
                height: 90px;
                margin: 0 auto 2rem;
                flex-direction: column;
            }

            .photo-preview {
                height: 70%;
            }

            .photo-btn {
                height: 30%;
                font-size: 0.65rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .applicant-id-section {
                padding: 1.5rem 1.5rem;
                flex-direction: column;
                gap: 1rem;
            }

            .applicant-id-group {
                width: 100%;
                min-width: unset;
            }
        }

        .optional::after {
            content: "(Optional)";
            font-size: 0.8rem;
            color: #9ca3af;
            font-weight: 400;
            margin-left: 0.5rem;
        }

        /* Responsive for Applicant ID Section */
        @media (max-width: 768px) {
            .applicant-id-section {
                padding: 1.25rem 1rem;
                gap: 0.75rem;
                margin: 0 0.5rem 0 -2rem;
                max-width: 400px;
            }

            .applicant-id-group {
                width: 100%;
                min-width: unset;
                flex-direction: row;
                align-items: center;
            }

            .applicant-id-input {
                flex: 1;
                min-width: 0;
            }

            .fetch-btn {
                width: 100%;
                max-width: 200px;
                align-self: center;
            }
        }

        @media (max-width: 480px) {
            .applicant-id-section {
                padding: 1.25rem 1rem;
                gap: 0.75rem;
                margin: 0 0.5rem 0 -2rem;
                max-width: 400px;
            }

            .applicant-id-group {
                flex-direction: column;
                align-items: stretch;
                gap: 0.5rem;
            }

            .applicant-id-input {
                width: 100%;
            }

            .fetch-btn {
                width: 100%;
                max-width: none;
            }
        }
    </style>
</head>

<body>
    <div class="employee-container">
        <div class="form-header">
            <h1 class="form-title">
                <i class="fas fa-user-plus me-3"></i>
                Employee Profile
            </h1>
            <p class="form-subtitle">Complete professional details for new employee onboarding</p>
        </div>

        <form id="employeeForm" method="POST"
            action="<?= isset($emp) ? site_url('Employee/updateEmployee/' . $emp->seemp_id) : site_url('Employee/addEmployee') ?>"
            enctype="multipart/form-data">

            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">

            <div class="form-body" style="position: relative;">
                <!-- Applicant ID Section -->
                <div class="applicant-id-section">
                    <div class="applicant-id-group">
                        <label
                            style="font-weight: 600; color: #374151; font-size: 0.9rem; white-space: nowrap;">Applicant
                            ID:</label>
                        <input type="text" class="applicant-id-input" id="applicantIdSearch" placeholder="Example: 44">
                    </div>
                    <button type="button" class="fetch-btn" onclick="fetchApplicant()">
                        <i class="fas fa-search me-2"></i> Fetch
                    </button>
                </div>
                <!-- Photo Section -->
                <div class="photo-section">
                    <?php
                    $img_url = (isset($emp) && !empty($emp->seempd_img))
                        ? base_url('uploads/' . $emp->seempd_img)
                        : 'https://via.placeholder.com/100x80/461bb9/ffffff?text=👤';
                    ?>
                    <img src="<?= $img_url ?>" alt="Photo" class="photo-preview" id="photoPreview"
                        onclick="document.getElementById('photoInput').click()">
                    <button type="button" class="photo-btn" onclick="document.getElementById('photoInput').click()">
                        <i class="fas fa-camera"></i> Photo
                    </button>
                    <input type="file" id="photoInput" name="photo" accept="image/*" style="display: none;">
                </div>
                <!-- Form Grid -->
                <div class="form-grid">
                    <!-- Employee Name -->
                    <div class="form-group">
                        <label class="form-label">Employee Name <span class="required">*</span></label>
                        <input type="text" class="form-control" id="empName" name="empName"
                            value="<?= isset($emp) ? $emp->seempd_name : '' ?>" required>
                    </div>
                    <!-- Employee ID -->

                    <div class="form-group">
                        <label class="form-label">Employee ID <span class="required">*</span></label>
                        <input type="text" class="form-control" id="empid" name="empid" placeholder="SE26KOL01"
                            value="<?= isset($emp) ? $emp->seemp_id : '' ?>" <?= isset($emp) ? 'readonly style="background-color: #f3f4f6;"' : '' ?> required>
                    </div>

                    <!-- Branch -->
                    <div class="form-group">
                        <label class="form-label">Branch <span class="required">*</span></label>
                        <select class="form-select" id="branch" name="branch" required>
                            <option value="KOLKATA" <?= (isset($emp) && $emp->seemp_branch == 'KOLKATA') ? 'selected' : '' ?>>Kolkata</option>
                            <option value="HOWRAH" <?= (isset($emp) && $emp->seemp_branch == 'HOWRAH') ? 'selected' : '' ?>>Howrah</option>
                        </select>
                    </div>
                    <!-- Designation -->
                    <div class="form-group">
                        <label class="form-label">Designation <span class="required">*</span></label>
                        <input type="text" class="form-control" id="designation" name="designation"
                            value="<?= isset($emp) ? $emp->seempd_designation : '' ?>" required>
                    </div>
                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label">Email <span class="required">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= isset($emp) ? $emp->seemp_email : '' ?>" required>
                    </div>
                    <!-- Phone -->

                    <div class="form-group">
                        <label class="form-label">Phone <span class="required">*</span></label>
                        <input type="tel" class="form-control" id="phone" name="phone"
                            value="<?= isset($emp) ? $emp->seempd_phone : '' ?>" required>
                    </div>
                    <!-- Salary -->
                    <div class="form-group">
                        <label class="form-label">Salary (₹) <span class="required">*</span></label>
                        <input type="number" class="form-control" id="salary" name="salary"
                            value="<?= isset($emp) ? $emp->seempd_salary : '' ?>" required>
                    </div>
                    <!-- Experience -->
                    <div class="form-group">
                        <label class="form-label">Experience (Years) <span class="required">*</span></label>
                        <input type="number" class="form-control" id="experience" name="experience"
                            value="<?= isset($emp) ? $emp->seempd_experience : '' ?>" required>
                    </div>
                    <!-- Date of Birth -->
                    <div class="form-group">
                        <label class="form-label">Date of Birth <span class="required">*</span></label>
                        <input type="date" class="form-control" id="dob" name="dob"
                            value="<?= isset($emp) ? $emp->seempd_dob : '1990-01-01' ?>" required>
                    </div>
                    <!-- Joining Date -->
                    <div class="form-group">
                        <label class="form-label">Joining Date <span class="required">*</span></label>
                        <input type="date" class="form-control" id="joiningDate" name="joiningDate"
                            value="<?= isset($emp) ? $emp->seempd_joiningdate : date('Y-m-d') ?>" required>
                    </div>
                    <!-- access level -->
                    <div class="form-group">
                        <label class="form-label">Access Level <span class="required">*</span></label>
                        <select name="accessLevel" id="accessLevel" class="form-select">
                            <option value="EMPL" <?= (isset($emp) && $emp->seemp_acesslevel == 'EMPL') ? 'selected' : '' ?>>Employee</option>
                            <option value="HR" <?= (isset($emp) && $emp->seemp_acesslevel == 'HR') ? 'selected' : '' ?>>HR
                            </option>
                            <option value="MANAGER" <?= (isset($emp) && $emp->seemp_acesslevel == 'MANAGER') ? 'selected' : '' ?>>Manager</option>
                            <option value="ADMIN" <?= (isset($emp) && $emp->seemp_acesslevel == 'ADMIN') ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                    <!-- Status -->
                    <div class="form-group">
                        <label class="form-label">Status <span class="required">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active" <?= (isset($emp) && $emp->seemp_status == 'active') ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= (isset($emp) && $emp->seemp_status == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>
                <!-- Addresses   -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Permanent Address <span class="required">*</span></label>
                        <textarea class="form-control" name="permAddress" id="permAddress" rows="3"
                            required><?= isset($emp) ? $emp->seempd_address_permanent : '' ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Current Address <span class="required">*</span></label>
                        <textarea class="form-control" name="currentAddress" id="currentAddress" rows="3"
                            required><?= isset($emp) ? $emp->seempd_address_current : '' ?></textarea>
                    </div>
                </div>
                <!-- Additional Information -->
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Aadhar Number <span class="required">*</span></label>
                        <input type="text" class="form-control" id="aadhar" name="aadhar"
                            value="<?= isset($emp) ? $emp->seempd_aadhar : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label optional">PAN Number</label>
                        <input type="text" class="form-control" id="pan" name="pan"
                            value="<?= isset($emp) ? $emp->seempd_pan : '' ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Increment (%)</label>
                        <input type="number" step="0.01" class="form-control" id="increment" name="increment"
                            value="<?= isset($emp) ? $emp->seempd_increment : '' ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Project</label>
                        <input type="text" class="form-control" id="project" name="project"
                            value="<?= isset($emp) ? $emp->seempd_project : '' ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Login Password
                            <?= isset($emp) ? '(Leave blank to keep same)' : '<span class="required">*</span>' ?></label>
                        <input type="password" class="form-control" name="password" <?= isset($emp) ? '' : 'required' ?>>
                    </div>
                </div>
                <!-- CV Upload -->
                <div class="form-group mt-4">
                    <label class="form-label">CV Upload
                        <?= isset($emp) && !empty($emp->seempd_cv) ? '<span class="badge bg-success">CV Exists</span>' : '<span class="required">*</span>' ?></label>
                    <div class="cv-upload" onclick="document.getElementById('cvInput').click()">
                        <i class="fas fa-file-pdf fa-2x mb-2" style="color: #ef4444;"></i>
                        <div id="cvStatusText">
                            <?= (isset($emp) && !empty($emp->seempd_cv)) ? 'Click to replace current CV' : 'Click to upload CV (PDF, DOC)' ?>
                        </div>
                        <small class="text-muted">Max 5MB</small>
                        <input type="file" id="cvInput" name="cv" accept=".pdf,.doc,.docx" style="display: none;">
                    </div>
                </div>
                <!-- Action Buttons  -->
                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> <?= isset($emp) ? 'Update Employee' : 'Add Employee' ?>
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">
                        <i class="fas fa-undo me-2"></i> Reset
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Photo preview logic
        document.getElementById('photoInput').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('photoPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // CV Status logic
        document.getElementById('cvInput').addEventListener('change', function (e) {
            const fileName = e.target.files[0].name;
            document.getElementById('cvStatusText').innerText = "Selected: " + fileName;
        });

        function resetForm() {
            document.getElementById('employeeForm').reset();
            document.getElementById('photoPreview').src = 'https://via.placeholder.com/100x80/461bb9/ffffff?text=👤';
        }

        // Optimized AJAX Fetch Applicant logic
        //trim APP ID and validate before sending request
        async function fetchApplicant() {
            let appId = document.getElementById('applicantIdSearch').value.trim();
            //remove APP from the beginning of the ID if user entered it
            if (appId.toUpperCase().startsWith('APP')) {
                appId = appId.substring(3);
            }

            if (!appId) {
                alert('⚠️ Please enter an Applicant ID');
                return;
            }

            try {
                const response = await fetch('<?= site_url("Employee/getApplicantDetails/") ?>' + appId);
                const result = await response.json();

                if (result.success) {
                    const data = result.data;

                    // Mapping database columns to Form IDs
                    document.getElementById('empName').value = data.sejoba_name || '';
                    document.getElementById('email').value = data.sejoba_email || '';
                    document.getElementById('phone').value = data.sejoba_phone || '';
                    document.getElementById('designation').value = data.sejoba_position || '';
                    document.getElementById('experience').value = data.sejoba_experience || '';
                    document.getElementById('salary').value = data.sejoba_exp_salary || '';

                    // Optional: Map address if available in applicant table
                    if (data.sejoba_address) {
                        document.getElementById('currentAddress').value = data.sejoba_address;
                        document.getElementById('permAddress').value = data.sejoba_address;
                    }

                    alert('✅ Selected Applicant data loaded successfully!');
                } else {
                    // This will trigger if applicant state is 'applied' or 'rejected' instead of 'selected'
                    alert('❌ ' + result.message);
                }
            } catch (error) {
                console.error('Fetch error:', error);
                alert('❌ Error connecting to server');
            }
        }
   
   </script>
</body>

</html>