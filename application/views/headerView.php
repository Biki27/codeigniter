<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

	<!-- NAVBAR -->
	<nav class="navbar navbar-expand-lg fixed-top">
		<div class="container">
			<a class="navbar-brand" href="<?= base_url(); ?>">
				<img href="<?= base_url(); ?>" src="<?= base_url(); ?>assets/logo.png" alt="Logo" id="logo">
				<span class="ms-2 fw-bold" style="color: #2563eb; font-size: 1.3rem;">Suropriyo Enterprise</span>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-3">
					<li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="<?= base_url() . "index.php/welcome/AboutUs"; ?>">About
							Us</a></li>
					<li class="nav-item"><a class="nav-link"
							href="<?= base_url() . "index.php/welcome/Services"; ?>">Services</a></li>
					<li class="nav-item"><a class="nav-link" href="<?= base_url() . "index.php/welcome/Careers"; ?>">Career</a>
					</li>
					<li class="nav-item"><a class="nav-link" href="<?= base_url() . "index.php/welcome/ContactUs"; ?>">Contact
							Us</a></li>
				</ul>

				<!-- Search Bar -->
				<?= form_open('Services/Searchservice') ?>
					<div class="input-group input-group-sm search-input-wrapper">
						<input type="search" name="ques" class="form-control search-input" placeholder="Search services..."
							aria-label="Search">
						<button class="input-group-text search-icon">
							<i type="submit" class="fas fa-search"></i>
						</button>
					</div>
				<?= form_close() ?>
			</div>
		</div>
	</nav>



