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
    <link href="<?= base_url('css/admin/adminProjectsView.css') ?>" rel="stylesheet">
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
                                <th>Head</th>
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

                                        <td><code><?= $proj->seproj_headid ?></code></td>

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

        <!-- <div class="modal fade" id="addProjectModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Add New Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="post" action="<?= base_url('index.php/Employee/viewProject') ?>">

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Project Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="desc" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Start Date</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Deadline</label>
                                <input type="date" name="deadline" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Client ID</label>
                                <input type="text" name="clientid" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Project Head</label>
                                <input type="text" name="headid" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Price</label>
                                <input type="text" name="price" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="pending">Pending</option>
                                    <option value="running">Running</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save Project</button>
                        </div>
                    </form>

                </div>
            </div>
        </div> -->
</body>

</html>