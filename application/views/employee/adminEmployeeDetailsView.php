<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Information | Supropriyo Enterprise</title>
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

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: var(--primary-gradient);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

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

        .logo h5 { color: #461bb9; font-weight: 700; font-size: 1.3rem; margin: 0; }

        .nav-link {
            display: flex; align-items: center; color: #6b37e4 !important;
            font-weight: 500; margin-bottom: 12px; padding: 12px 20px !important;
            border-radius: 12px; text-decoration: none; transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .nav-link i { margin-right: 12px; width: 20px; text-align: center; }

        .nav-link:hover {
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white !important; transform: translateX(8px);
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white !important;
        }

        .main-content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
            background: #0f0f23;
        }

        .welcome {
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }

        .welcome h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #fff, rgba(255, 255, 255, 0.8));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .employee-container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-light);
            overflow: hidden;
        }

        .emp-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2.5rem 3rem;
            text-align: center;
        }

        .emp-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .emp-subtitle {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .emp-details {
            display: flex;
            gap: 0;
            min-height: 800px;
        }

        .info-section {
            flex: 1;
            padding: 3rem;
        }

        .photo-section {
            flex: 0 0 280px;
            background: linear-gradient(135deg, rgba(70, 27, 185, 0.1), rgba(151, 60, 224, 0.1));
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
        }

        .emp-photo {
            width: 180px;
            height: 180px;
            border-radius: 20px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }

        .emp-photo:hover {
            transform: scale(1.05);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-weight: 600;
            color: #374151;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 500;
            color: #1f2937;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 12px;
            border-left: 4px solid var(--primary);
            word-break: break-word;
        }

        /* Cover letter text styling */
        .cover-letter-text {
            font-size: 0.9rem;
            line-height: 1.6;
            color: #374151;
            white-space: pre-line;
            max-height: 120px;
            overflow-y: auto;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            border-left: 4px solid var(--secondary);
        }

        /* Resume file link */
        .file-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .file-link i { font-size: 1.1rem; }

        .file-link:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        .edit-btn {
            width: 100%;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: auto;
        }

        .edit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(70, 27, 185, 0.4);
        }

        @media (max-width: 992px) {
            .emp-details { flex-direction: column; }
            .photo-section {
                order: -1;
                border-left: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            }
        }

        @media (max-width: 768px) {
            .sidebar { width: 100%; transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .info-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Main Content -->
    <div class="main-content">
       
        <div class="employee-container">
            <!-- Header -->
            <div class="emp-header">
                <h1 class="emp-title">
                    <i class="fas fa-user me-3"></i>
                    Profile Details
                </h1>
                <p class="emp-subtitle">Complete employee information overview</p>
            </div>

            <!-- Employee Details Layout -->
            <div class="emp-details">
                <!-- Left: Information Grid -->
                <div class="info-section">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Employee ID</div>
                            <div class="info-value"><?= $info->seemp_id?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Name</div>
                            <div class="info-value"><?= $info->seempd_name ?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value"><?= $info->seemp_email?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Phone</div>
                            <div class="info-value"><?= $info->seempd_phone ?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Position</div>
                            <div class="info-value"><?= $info->seempd_designation ?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Experience</div>
                            <div class="info-value"><?= $info->seempd_experience ?> Years</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Salary</div>
                            <div class="info-value">₹ <?= $info->seempd_salary ?> LPA</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Increment</div>
                            <div class="info-value"><?= $info->seempd_increment ?>%</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Date of Birth</div>
                            <div class="info-value"><?= $info->seempd_dob ?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Joining Date</div>
                            <div class="info-value"><?= $info->seempd_joiningdate ?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Branch</div>
                            <div class="info-value"><?= $info->seemp_branch ?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Status</div>
                            <div class="info-value"><?= $info->seemp_status ?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Last Login</div>
                            <div class="info-value"><?= $info->seemp_lastlogin	 ?></div>
                        </div>

                        <!--  COVER LETTER AS TEXT -->
                        <div class="info-item" style="grid-column: 1 / -1;">
                            <div class="info-label">Cover Letter</div>
                            <div class="info-value">
                                <div class="cover-letter-text">
                                    <?= $info->sejoba_coverletter	 ?>
                                </div>
                            </div>
                        </div>

                        <!-- Resume file link (kept as link)
                        <div class="info-item" style="grid-column: 1 / -1;">
                            <div class="info-label">Resume</div>
                            <div class="info-value">
                                <a href="#" class="file-link" onclick="downloadFile('resume')">
                                    <i class="fas fa-file-pdf"></i>
                                    resume-rahul-sharma.pdf
                                </a>
                            </div>
                        </div> -->

                        <div class="info-item" style="grid-column: 1 / -1;">
                            <div class="info-label">Permanent Address</div>
                            <div class="info-value"><?= $info->seempd_address_permanent	 ?></div>
                        </div>

                        <div class="info-item" style="grid-column: 1 / -1;">
                            <div class="info-label">Current Address</div>
                            <div class="info-value"><?= $info->seempd_address_current	 ?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Aadhar No</div>
                            <div class="info-value"><?= $info->	seempd_aadhar ?></div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">PAN No</div>
                            <div class="info-value"><?= $info->seempd_pan	?></div>
                        </div>
                    </div>
                </div>

                <!-- Right: Photo Section -->
                <div class="photo-section">
                    <?php 
                        $profile_pic = (!empty($info->seempd_img)) 
                                       ? base_url('uploads/' . $info->seempd_img) 
                                       : 'https://via.placeholder.com/180x180/461bb9/ffffff?text=👤';
                    ?>
                    <img src="<?= $profile_pic ?>" alt="Employee Photo" class="emp-photo">

                    <?= form_open('Employee/RegisterEmployee') ?>
                        <input type="hidden" name="empid" value="<?= $info->seemp_id ?>" />
                        <button type="submit" class="edit-btn">
                            <i class="fas fa-user-edit me-2"></i>Edit Profile
                        </button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

   
</body>
</html>
