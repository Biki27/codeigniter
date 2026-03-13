<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ESS Portal - Login | Supropriyo Enterprise</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>css/login.css">

</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="card p-4">
          <div class="text-center mb-4">
            <div class="logo"><i class="fas fa-building"></i></div>
            <h2 class="mt-3 text-dark">Suropriyo Enterprise</h2>
            <p class="text-muted">Employee / Admin Login</p>
          </div>

         <?= form_open('Employee/Login') ?>
            <div class="mb-3">
              <label for="username" class="form-label fw-semibold"><i class="fas fa-user"></i> Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="e.g., user@supropriyo.com" required aria-describedby="usernameHelp">
              <div id="usernameHelp" class="form-text">Enter your username.</div>
            </div>
            <div class="mb-3">
  <label for="password" class="form-label fw-semibold"><i class="fas fa-lock"></i> Password</label>
  
  <div class="input-group">
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
      <i class="fas fa-eye" id="eyeIcon"></i>
    </button>
  </div>

  <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
</div>
            <div class="mb-3 text-end">
              <a href="#" class="text-decoration-none" onclick="alert('Forgot Password? Contact IT support at support@supropriyo.com')">Forgot Password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100" id="loginBtn">
              <i class="fas fa-sign-in-alt"></i> Login
            </button>   
          <?=  form_close() ?>

          <?php if(isset($error)){ ?>
              <div id="errorMessage" class="alert alert-danger mt-3" role="alert"><?= $error ?></div>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    &copy; <?= date('Y') ?> Suropriyo Enterprise. All rights reserved.
  </div>

  <script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');
  const eyeIcon = document.querySelector('#eyeIcon');

  togglePassword.addEventListener('click', function (e) {
    // Toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    
    // Toggle the eye / eye-slash icon
    eyeIcon.classList.toggle('fa-eye');
    eyeIcon.classList.toggle('fa-eye-slash');
  });
</script>
</body>

</html>