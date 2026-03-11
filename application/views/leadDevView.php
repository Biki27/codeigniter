<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lead Web Developer | Suropriyo Enterprise</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        /* NAVBAR & FOOTER - IDENTICAL TO ORIGINAL */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }

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
            background: #2563eb;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(69, 117, 219, 0.4);
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

        /* LEADER PAGE */
        .leader-hero {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: white;
            padding: 120px 0 80px;
            position: relative;
        }

        .leader-photo {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 5px solid #2563eb;
            box-shadow: 0 20px 60px rgba(37, 99, 235, 0.3);
        }

        .skill-tag {
            background: rgba(37, 99, 235, 0.2);
            color: #2563eb;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin: 5px;
        }

        .experience-section {
            background: #f8fafc;
            padding: 80px 0;
        }

        .exp-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            height: 100%;
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

        @media (max-width: 768px) {
            .nav-spacer {
                height: 70px;
            }
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <div class="nav-spacer"></div>

    <!-- LEAD WEB DEVELOPER HERO -->
    <section class="leader-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-md-4 text-center">
                    <img src="<?= base_url() ?>assets/ceo.jpg" alt="Lead Web Developer" class="leader-photo img-fluid mx-auto">
                </div>
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-4">Lead Web Developer</h1>
                    <p class="lead fs-3 mb-4 opacity-95">
                        15+ Years Building Enterprise Web Solutions
                    </p>
                    <div class="d-flex flex-wrap gap-2 mb-5">
                        <span class="skill-tag">React</span>
                        <span class="skill-tag">Next.js</span>
                        <span class="skill-tag">Node.js</span>
                        <span class="skill-tag">TypeScript</span>
                        <span class="skill-tag">AWS</span>
                    </div>
                    <a href="<?= base_url() ?>index.php/welcome/Contactus#contactform" class="btn btn-light btn-lg px-5 py-3 fw-bold">
                        <i class="fas fa-code me-2"></i>Hire Expert
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- EXPERIENCE SECTION -->
    <section class="experience-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="exp-card">
                        <h4 class="fw-bold mb-3 text-dark"><i class="fas fa-briefcase text-primary me-2"></i>Senior Web
                            Developer</h4>
                        <p class="text-muted mb-2"><strong>Suropriyo Enterprise</strong> • 2018 - Present</p>
                        <ul class="mb-0">
                            <li>Lead 50+ enterprise web projects</li>
                            <li>React/Next.js architecture specialist</li>
                            <li>Performance optimization expert</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="exp-card">
                        <h4 class="fw-bold mb-3 text-dark"><i class="fas fa-trophy text-warning me-2"></i>Key
                            Achievements</h4>
                        <ul class="mb-0">
                            <li>500K+ users served globally</li>
                            <li>99.9% uptime across platforms</li>
                            <li>Reduced load times by 70%</li>
                            <li>AI-integrated web solutions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>