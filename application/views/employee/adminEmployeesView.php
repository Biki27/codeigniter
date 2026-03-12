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
      margin-bottom: 30px;
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

    .employees-table {
      background: rgba(255, 255, 255, 0.97);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
      backdrop-filter: blur(15px);
    }

    .table {
      margin: 0;
      font-size: 0.95rem;
    }

    .table thead th {
      background: linear-gradient(135deg, #461bb9, #973ce0);
      color: white;
      font-weight: 600;
      border: none;
      padding: 20px 15px;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .table tbody tr {
      background: rgba(255, 255, 255, 0.95);
      transition: all 0.3s ease;
      border-bottom: 1px solid rgba(70, 27, 185, 0.1);
    }

    .table tbody tr:hover {
      background: white;
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(70, 27, 185, 0.1);
    }

    .table tbody td {
      padding: 20px 15px;
      vertical-align: middle;
      border: none;
    }

    .emp-id {
      font-weight: 700;
      color: #461bb9;
      font-size: 1.1rem;
    }

    .status-badge {
      padding: 6px 16px;
      border-radius: 25px;
      font-size: 0.8rem;
      font-weight: 600;
      text-transform: uppercase;
    }

    .status-active {
      background: linear-gradient(135deg, #10b981, #059669);
      color: white;
    }

    .status-inactive {
      background: linear-gradient(135deg, #ef4444, #dc2626);
      color: white;
    }

    .btn-action {
      padding: 8px 16px;
      border-radius: 10px;
      font-weight: 500;
      font-size: 0.85rem;
      transition: all 0.3s ease;
      border: none;
      margin: 0 2px;
    }

    .btn-view {
      background: linear-gradient(135deg, #10b981, #059669);
      color: white;
    }

    .btn-view:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
      color: white !important;
    }

    .btn-edit {
      background: linear-gradient(135deg, #461bb9, #973ce0);
      color: white;
    }

    .btn-edit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(70, 27, 185, 0.4);
      color: white !important;
    }

    .search-box {
      background: rgba(255, 255, 255, 0.97);
      border-radius: 15px;
      padding: 20px;
      margin-bottom: 25px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
    }

    .form-control {
      border: 2px solid rgba(70, 27, 185, 0.2);
      border-radius: 12px;
      padding: 12px 20px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #461bb9;
      box-shadow: 0 0 0 0.2rem rgba(70, 27, 185, 0.25);
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
        transform: translateX(-100%);
      }

      .main-content {
        margin-left: 0;
      }

      .footer {
        left: 0;
      }

      .table-responsive {
        font-size: 0.85rem;
      }
    }
  </style>
</head>

<body>
  <?php if ($this->session->flashdata('msg')): ?>
        <script>
            alert("<?= $this->session->flashdata('msg') ?>");
        </script>
    <?php endif; ?>
  <!-- Main Content -->
  <div class="main-content">
    <!-- Employees Section -->
    <div id="employees" class="section active">
      <h2 class="text-white mb-4">Employee Management</h2>

      <!-- Search Box -->
      <?= form_open('Employee/viewEmployee') ?>
      <div class="search-box">
        <div class="row align-items-center">
          <div class="col-md-6">
            <input name="query" type="text" class="form-control" id="searchInput"
              placeholder="Search employees by name, ID, or designation...">
          </div>
          <div class="col-md-3">
            <select name="status" class="form-control" id="statusFilter">
              <option value="">All Status</option>
              <option value="active" <?= ($this->input->post('status') == 'active') ? 'selected' : '' ?>>Active</option>
              <option value="inactive" <?= ($this->input->post('status') == 'inactive') ? 'selected' : '' ?>>Inactive
              </option>
            </select>
          </div>
          <div class="col-md-3">
            <button class="btn btn-view w-100" type="submit">
              <i></i>Search
            </button>
          </div>
        </div>
      </div>

      <?= form_close() ?>

      <!-- Employees Table -->
      <div class="table-responsive">
        <table class="table employees-table">
          <thead>
            <tr>
              <th>Emp ID</th>
              <th>Employee Name</th>
              <th>Designation</th>
              <th>Email</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="employeesTableBody">

            <?php foreach ($employees as $emp) { ?>

              <tr>
                <td><span class="emp-id"><?= $emp->seemp_id ?></span></td>
                <td>
                  <div>
                    <strong><?= $emp->seempd_name ?></strong><br>
                  </div>
                </td>
                <td><strong><?= $emp->seempd_designation ?></strong></td>
                <td><?= $emp->seemp_email ?></td>
                <td><span
                    class="status-badge <?= $emp->seemp_status == 'active' ? 'text-bg-primary' : 'text-bg-warning' ?>"><?= $emp->seemp_status ?></span>
                </td>
                <td style="display:flex">

                  <?= form_open('Employee/viewEmployeeDetails') ?>
                  <input type="hidden" name="empid" value="<?= $emp->seemp_id ?>" />

                  <button type='submit' class="btn btn-view btn-action btn-sm">
                    <i class="fas fa-eye"></i>
                  </button>
                  <?= form_close() ?>

                  <?= form_open('Employee/RegisterEmployee') ?>
                  <input type="hidden" name="empid" value="<?= $emp->seemp_id ?>">
                  <button type="submit" class="btn btn-edit btn-action btn-sm">
                    <i class="fas fa-edit"></i>
                  </button>
                  <?= form_close() ?>
                </td>
              </tr>

            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>

    <div class="footer">
      © 2026 Suropriyo Enterprise. All rights reserved.
    </div>
</body>

</html>