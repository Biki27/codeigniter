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
    <link rel="stylesheet" href="<?= base_url('css/admin/adminEmployeeRegistrationView.css') ?>">
</head>
<body>
    <?php if ($this->session->flashdata('msg')): ?>
        <script>
            // This will pop up the message sent from the controller
            alert(<?= json_encode($this->session->flashdata('msg')) ?>);
        </script>
    <?php endif; ?>
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
            document.getElementById('cvStatusText').innerText = "Click to upload CV (PDF, DOC)";
        }

        // Optimized AJAX Fetch Applicant logic
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
                    alert('❌ ' + result.message);
                }
            } catch (error) {
                console.error('Fetch error:', error);
                alert('❌ Error connecting to server');
            }
        }
        
        // Form validation logic
    
      document.getElementById('employeeForm').addEventListener('submit', function (e) {
            
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const aadhar = document.getElementById('aadhar').value.trim();
            const password = document.querySelector('input[name="password"]').value;
            const cvInput = document.getElementById('cvInput').files.length;
            
            // Check if we are adding new or updating
            const isUpdate = <?= isset($emp) ? 'true' : 'false' ?>;

            let errors = [];
            
            // Email Format Validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                errors.push("- Please enter a valid email format.");
            }

            // Phone Validation (10 digits)
            const phoneRegex = /^\d{10}$/;
            if (!phoneRegex.test(phone.replace(/\D/g,''))) {
                errors.push("- Phone number must be exactly 10 digits.");
            }
            
            // Aadhar Validation (12 digits)
            const aadharRegex = /^\d{12}$/;
            if (!aadharRegex.test(aadhar.replace(/\s/g,''))) {
                errors.push("- Aadhar number must be exactly 12 digits.");
            }

            // Password Check (Required only for new employees)
            if (!isUpdate && password.length < 6) {
                errors.push("- Password is required and must be at least 6 characters.");
            }

            // CV Check (Required only for new employees)
            if (!isUpdate && cvInput === 0) {
                errors.push("- You must upload a CV document for new employees.");
            }

            // If there are errors, stop submission and show alert
            if (errors.length > 0) {
                e.preventDefault(); // Prevents form from going to server
                alert("⚠️ Please fix the following errors before submitting:\n\n" + errors.join("\n"));
            } else {
                // Confirm before sending using standard browser confirm
                if(!confirm("Proceed with saving this employee profile?")) {
                    e.preventDefault();
                }
            }
        });  
    </script>
</body>

</html>