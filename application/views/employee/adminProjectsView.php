<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Supropriyo Enterprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: radial-gradient(circle at 0% 50%, #461bb9 20%, #973ce0 50%, #6b37e4 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: #333;
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

        .logo h5 {
            color: #461bb9;
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            color: #6b37e4 !important;
            font-weight: 500;
            margin-bottom: 12px;
            padding: 12px 20px !important;
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

        .welcome p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        h2.text-white {
            color: white !important;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #fff, rgba(255, 255, 255, 0.8));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card {
            border: none;
            background: rgba(255, 255, 255, 0.97);
            margin-bottom: 25px;
            backdrop-filter: blur(15px);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 25px;
        }

        .metric-card {
            text-align: center;
            height: 250px;
        }

        .metric-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .metric-card .fa-running {
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .metric-card .fa-building {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .metric-card .fa-check-double {
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .metric-card .fa-rupee-sign {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .metric-card .fa-users-slash {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .metric-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: #461bb9;
            margin: 10px 0;
        }

        .btn-view {
            background: linear-gradient(135deg, #461bb9, #973ce0);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.4);
            color: white !important;
        }

        .details-panel {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            border-left: 4px solid #461bb9;
        }

        .details-panel.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .project-search {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .project-table {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .project-table th {
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white;
            font-weight: 600;
            border: none;
            padding: 18px 15px;
            font-size: 0.9rem;
        }

        .project-table td {
            padding: 18px 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            vertical-align: middle;
        }

        .project-table tbody tr:hover {
            background: rgba(70, 27, 185, 0.05);
            transform: scale(1.01);
            transition: all 0.2s ease;
        }

        .status-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-running {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .status-completed {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .status-existing {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        .project-id {
            font-weight: 600;
            color: #461bb9;
            font-family: 'monospace';
        }

        .deadline {
            font-weight: 500;
            color: #6b7280;
        }

        .price {
            font-weight: 700;
            color: #ef4444;
            font-size: 1.1rem;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 260px;
            right: 0;
            text-align: center;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9rem;
            padding: 15px;
            background: rgba(70, 27, 185, 0.1);
            backdrop-filter: blur(10px);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                /* transform: translateX(-100%); */
            }

            .main-content {
                margin-left: 0;
            }

            .footer {
                left: 0;
            }
        }

        .project-search input,
        .project-search select {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(70, 27, 185, 0.2);
        }

        .project-search input:focus,
        .project-search select:focus {
            border-color: #461bb9;
            box-shadow: 0 0 0 0.2rem rgba(70, 27, 185, 0.15);
        }

        .btn-disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Static badges for visual appeal */
        .all-badge {
            background: linear-gradient(135deg, #6b7280, #9ca3af);
            color: white;
        }

        .running-badge {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .existing-badge {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        .completed-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        /* Visual stats below search */
        .project-stats {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px 20px;
            border-radius: 12px;
            color: white;
            backdrop-filter: blur(10px);
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
        <div class="welcome">
            <h1>Welcome, <?= $this->session->userdata("empname") ?>!</h1>
            <p>Projects Management Dashboard</p>
        </div>

        <!-- Projects Section - ACTIVE BY DEFAULT (no JS needed) -->
        <div id="projects" class="section active">
            <h2 class="text-white mb-4">Projects Management</h2>

            <!-- Static Project Search & Filter (Visual Only) -->
            <div class="project-search">
                <form class="row align-items-center g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" id="projectSearch" class="form-control"
                                placeholder="Search by project name, client or ID...">
                        </div>
                    </div>
                    <!-- This section contains the status filter -->
                    <div class="col-md-3">
                        <select name="status" class="form-select border-0 shadow-sm"
                            onchange="window.location.href='<?= base_url('index.php/Employee/viewProjects') ?>?status='+this.value">
                            <option value="">All Projects (<?= $total ?> Total)</option>
                            <option value="running" <?= ($this->input->get('status') == 'running') ? 'selected' : '' ?>>
                                Running Projects (<?= $running ?> Active)</option>
                            <option value="pending" <?= ($this->input->get('status') == 'pending') ? 'selected' : '' ?>>
                                Pending Projects (<?= $pending ?> Active)</option>
                            <option value="completed" <?= ($this->input->get('status') == 'completed') ? 'selected' : '' ?>>Completed Projects (<?= $completed ?> Done)</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-2">
                        <button type="button" class="btn btn-outline-primary w-100 btn-disabled">
                            <i class="fas fa-search me-1"></i>Search
                        </button>
                    </div> -->
                    <div class="col-md-2">
                        <a href="<?= base_url('index.php/Employee/addProjectPage') ?>" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-1"></i>New Project
                        </a>
                    </div>
                </form>

                <!-- Static Project Stats -->
            </div>

            <!-- Projects Table (Perfect Styling) -->
            <div class="card project-table">
                <div class="table-responsive">
                    <table id="projectsTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag me-1"></i>ID</th>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th>Start</th>
                                <th>Deadline</th>
                                <th>Client</th>
                                <th>Assign Project Head</th>
                                <!-- <th>Emp ID</th> -->
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <!-- Added code for the fetching data from MYSQL Database -->
                        <tbody>

                            <?php if (!empty($projects)) {
                                foreach ($projects as $proj) { ?>
                                    <tr>
                                        <td>
                                            <span class="project-id">
                                                PJ<?= str_pad($proj->seproj_id, 2, '0', STR_PAD_LEFT) ?>
                                            </span>
                                        </td>

                                        <td><strong><?= $proj->seproj_name ?></strong></td>

                                        <td><?= $proj->seproj_desc ?></td>

                                        <td><?= $proj->seproj_date ?></td>

                                        <td class="deadline"><?= $proj->seproj_deadline ?></td>

                                        <td><?= $proj->seproj_clientid ?></td>

                                        <td><?= $proj->seproj_headid ?></td>

                                        <!-- <td><code><?= $proj->seproj_headid ?></code></td> -->

                                        <td class="price">₹<?= $proj->seproj_price ?></td>

                                        <td>
                                            <?php if ($proj->seproj_status == 'running') { ?>

                                                <span class="status-badge status-running">Running</span>

                                            <?php } elseif ($proj->seproj_status == 'completed') { ?>

                                                <span class="status-badge status-completed">Completed</span>

                                            <?php } else { ?>

                                                <span class="status-badge status-existing">Pending</span>

                                            <?php } ?>

                                        </td>
                                    </tr>

                                <?php }
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>

            document.getElementById("projectSearch").addEventListener("keyup", function () {

                let searchValue = this.value.toLowerCase();

                let rows = document.querySelectorAll("#projectsTable tbody tr");

                rows.forEach(function (row) {

                    let projectID = row.cells[0].innerText.toLowerCase();
                    let projectName = row.cells[1].innerText.toLowerCase();
                    let clientName = row.cells[5].innerText.toLowerCase();

                    if (
                        projectID.includes(searchValue) ||
                        projectName.includes(searchValue) ||
                        clientName.includes(searchValue)
                    ) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }

                });

            });
        </script>
</body>

</html>