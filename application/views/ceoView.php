<?php
// This code is Written by :
// PAPPU BISWAS 
// Suropriyo Eterprise
// Howrah

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suropriyo Das - Founder | Suropriyo Enterprise</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        /* RESET & FIXES */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }

        /* NAVBAR FIXED */
        /* NAVBAR */
        .navbar {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            padding: 15px 0;
            z-index: 1000;
        }

        #logo {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: #4a5568 !important;
            padding: 12px 20px !important;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff !important;
            /* background: linear-gradient(135deg, #4675db 0%, #5a8dee 50%, #2563eb 100%); */
            background: #2563eb;
            border-radius: 8px;
            /* Soft rounding for modern look */
            box-shadow: 0 4px 12px rgba(69, 117, 219, 0.4);
            /* Subtle glow */
        }


        .search-container {
            position: relative;
        }

        .search-input-wrapper {
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(37, 99, 235, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            max-width: 280px;
        }

        .search-input-wrapper:hover,
        .search-input-wrapper:focus-within {
            box-shadow: 0 8px 32px rgba(37, 99, 235, 0.25);
            border-color: rgba(37, 99, 235, 0.3);
            transform: translateY(-2px);
        }

        .search-input {
            border: none !important;
            background: rgba(255, 255, 255, 0.95) !important;
            color: #1e293b !important;
            font-weight: 500;
            padding: 12px 20px !important;
            font-size: 0.95rem;
            outline: none;
        }

        .search-input::placeholder {
            color: #94a3b8 !important;
            font-weight: 400;
        }

        .search-icon {
            background: linear-gradient(135deg, #2563eb, #4675db) !important;
            border: none !important;
            color: white !important;
            padding: 12px 16px !important;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .search-icon:hover {
            background: linear-gradient(135deg, #1d4ed8, #2563eb) !important;
            transform: scale(1.05);
        }

        /* Mobile Responsiveness */
        @media (max-width: 991px) {
            .search-container {
                margin-top: 1rem;
                width: 100%;
            }

            .search-input-wrapper {
                max-width: 100%;
            }

            .navbar-nav {
                text-align: center;
            }
        }



        /* HERO SECTION - CLEAN BLUE */
        .hero-ceo {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 50%, #60a5fa 100%);
            color: white;
            padding: 140px 0 120px;
            position: relative;
            overflow: hidden;
        }

        .hero-ceo::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }

        /* GREEN CONTENT CONTAINER */
        .hero-content {
            background: rgba(10, 172, 120, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 60px 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 80px rgba(5, 150, 105, 0.3);
        }

        /* CEO PHOTO */
        .ceo-photo {
            width: 100%;
            max-width: 380px;
            height: 380px;
            border-radius: 24px;
            border: 8px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.3);
            object-fit: cover;
            transition: all 0.4s ease;
        }

        .ceo-photo:hover {
            transform: translateY(-15px) scale(1.03);
            box-shadow: 0 50px 120px rgba(5, 150, 105, 0.4);
            border-color: rgba(255, 255, 255, 0.7);
        }

        /* HERO TEXT */
        .hero-ceo h1 {
            color: #e2e8f0;
            font-weight: 800;
            font-size: clamp(3rem, 8vw, 5rem);
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .hero-ceo h2 {
            color: #b7ff44;
            font-weight: 700;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
        }

        /* BUTTONS */
        .btn-ceo-primary {
            background: rgba(255, 255, 255, 0.95);
            color: #059669 !important;
            border: none;
            border-radius: 50px;
            padding: 18px 50px;
            font-size: 1.1rem;
            font-weight: 700;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(20px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-ceo-primary:hover {
            background: white;
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            color: #059669 !important;
        }

        .btn-ceo-secondary {
            background: transparent;
            color: white !important;
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 50px;
            padding: 18px 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-ceo-secondary:hover {
            background: white;
            color: #059669 !important;
            transform: translateY(-3px);
            box-shadow: 0 20px 50px rgba(5, 150, 105, 0.3);
        }

        /* STATS SECTION */
        .stats-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 100px 0;
        }

        .stat-number {
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 800;
            color: #2563eb;
            text-shadow: 0 2px 10px rgba(37, 99, 235, 0.3);
        }

        .stat-label {
            color: #475569;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* ABOUT SECTION */
        .about-section {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            padding: 120px 0;
            color: white;
        }

        .about-section h2 {
            color: #f1f5f9;
            font-weight: 800;
            font-size: clamp(2.2rem, 5vw, 3.5rem);
        }

        .about-text {
            color: #cbd5e1;
            font-size: 1.2rem;
            font-weight: 400;
            line-height: 1.8;
        }

        .about-image {
            height: 500px;
            border-radius: 24px;
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.4);
        }

        .feature-icon {
            color: #60a5fa;
            font-size: 3rem;
            width: 70px;
        }

        footer {
            margin-top: 60px !important;
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(6, 5, 82, 1) 7%, rgba(9, 9, 121, 1) 21%, rgba(4, 130, 201, 1) 56%, rgba(0, 212, 255, 1) 89%) !important;
            color: #ffffff !important;
        }

        .footer5,
        .footer2 {
            background: inherit !important;
        }

        footer * {
            color: #ffffff !important;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5) !important;
        }

        footer h6 {
            color: #ffffff !important;
            font-weight: 700 !important;
        }

        footer .text-reset {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        footer .text-reset:hover {
            color: #ffffff !important;
        }

        footer .c-name {
            color: #e6f3ff !important;
        }

        footer i,
        footer .fas,
        footer .fab {
            color: #ffffff !important;
            font-size: 1.3rem !important;
        }

        footer .me-4 {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            margin: 0 10px 10px 0;
            transition: all 0.3s ease;
        }

        footer .me-4:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
        }

        .footer2+div {
            margin-top: 0 !important;
            padding-top: 20px !important;
            padding-bottom: 0px !important;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .ceo-photo {
                max-width: 320px;
                height: 320px;
            }

            .hero-content {
                padding: 40px 20px;
                margin: 10px;
            }
        }

        @media (max-width: 768px) {
            .hero-ceo {
                padding: 100px 0 80px;
            }

            .nav-spacer {
                height: 70px;
            }

            .ceo-photo {
                max-width: 280px;
                height: 280px;
            }
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>

    <!-- NAV SPACER -->
    <div class="nav-spacer"></div>

    <!-- HERO SECTION -->
    <section class="hero-ceo">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-4 text-center">
                    <img src="<?= base_url() ?>assets/ceo.jpg" alt="Supropriyo Das" class="ceo-photo img-fluid mx-auto">
                </div>
                <div class="col-lg-8">
                    <div class="hero-content text-center text-lg-start">
                        <h1 class="mb-4">Suropriyo Das</h1>
                        <h2 class="mb-4">Founder </h2>
                        <p class="lead fs-4 mb-5 opacity-95">
                            Architect of AI-First Enterprise Solutions |
                            15+ Years Building Scalable Tech for Global Businesses
                        </p>
                        <div
                            class="d-flex flex-column flex-lg-row gap-4 justify-content-center justify-content-lg-start">
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=suropriyo@gmail.com" target="_blank"
                                class="btn btn-ceo-primary btn-lg px-5 py-3">
                                <i class="fas fa-envelope me-2"></i>Let's Connect
                            </a>
                            <a href="<?= base_url() ?>index.php/welcome/Contactus#contactform"
                                class="btn btn-ceo-secondary btn-lg px-5 py-3">
                                <i class="fas fa-comments me-2"></i>Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-number mb-2">15+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-number mb-2">500+</div>
                    <div class="stat-label">Enterprise Projects</div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-number mb-2">50+</div>
                    <div class="stat-label">AI Solutions</div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-number mb-2">99.9%</div>
                    <div class="stat-label">Client Satisfaction</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-5">Visionary Leader in AI Innovation</h2>
                    <p class="about-text mb-5 lead">
                        Suropriyo Das is the driving force behind Suropriyo Enterprise's mission to deliver
                        cutting-edge AI solutions that transform businesses. With over 15 years of experience
                        in enterprise software, he specializes in autonomous AI agents and rapid deployment
                        architectures that deliver measurable ROI within weeks.
                    </p>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-4">
                                <i class="fas fa-award feature-icon me-4"></i>
                                <div>
                                    <h5 class="fw-bold mb-2 text-white">Award-Winning Innovator</h5>
                                    <p class="mb-0 opacity-90">Recognized by TechAsia for AI Leadership</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-rocket feature-icon me-4"></i>
                                <div>
                                    <h5 class="fw-bold mb-2 text-white">Rapid Deployment Expert</h5>
                                    <p class="mb-0 opacity-90">2-week AI implementation specialist</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="<?= base_url() ?>assets/ceo.jpg" alt="Supropriyo Das" class="about-image img-fluid w-100">
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>