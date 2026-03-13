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
  <link rel="stylesheet" href="<?= base_url() ?>css/admin/adminDashboardView.css">
</head>

<body>
  <!-- MOBILE TOGGLE BUTTON -->
  <button class="mobile-toggle" id="mobileToggle">
    <i class="fas fa-bars"></i>
  </button>

  <!-- MOBILE OVERLAY -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="welcome">
      <h1>Welcome, <?= $this->session->userdata("empname") ?>!</h1>
      <p>Manage your enterprise efficiently with real-time insights</p>
    </div>

    <!-- Overview Section -->
    <div id="overview" class="section active">
      <h2 class="text-white mb-4">Dashboard Overview</h2>

      <div class="row g-4 mb-5">
        <!-- Running Projects -->
        <div class="col-lg-3 col-md-6">
          <div class="card metric-card">
            <div class="card-body">
              <i class="fas fa-running metric-icon"></i>
              <h5 class="card-title">Running Projects</h5>
              <div class="metric-number"><?= $projrunning ?></div>
              <button class="btn btn-view btn-sm"
                onclick="window.location.href='<?= base_url('index.php/Employee/viewProjects?status=running') ?>'">
                View Details
              </button>

            </div>
          </div>
        </div>

        <!-- Existing Projects -->
        <div class="col-lg-3 col-md-6">
          <div class="card metric-card">
            <div class="card-body">
              <i class="fas fa-building metric-icon"></i>
              <h5 class="card-title">Pending Projects</h5>
              <div class="metric-number"><?= $projpending ?></div>
              <button class="btn btn-view btn-sm"
                onclick="window.location.href='<?= base_url('index.php/Employee/viewProjects?status=pending') ?>'">
                View Details
              </button>

            </div>
          </div>
        </div>

        <!-- Project Completion -->
        <div class="col-lg-3 col-md-6">
          <div class="card metric-card">
            <div class="card-body">
              <i class="fas fa-check-double metric-icon"></i>
              <h5 class="card-title">Projects Completed</h5>
              <div class="metric-number"><?= $projcompleted ?></div>
              <button class="btn btn-view btn-sm"
                onclick="window.location.href='<?= base_url('index.php/Employee/viewProjects?status=completed') ?>'">
                View Details
              </button>

            </div>
          </div>
        </div>

        
      </div>

       

      <div class="footer">
        © 2026 Suropriyo Enterprise. All rights reserved.
      </div>

</body>

</html>