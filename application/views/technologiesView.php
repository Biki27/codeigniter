<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Design Technologies | Suropriyo Enterprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        /* NAVBAR & FOOTER - IDENTICAL TO YOUR LEAD DEVELOPER PAGE */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }

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

        /* WEB DESIGN PAGE */
        :root {
            --primary-gradient: linear-gradient(135deg, #4675db 0%, #5a8dee 50%, #2563eb 100%);
            --dark-bg: #0f0f23;
            --card-bg: #1e1e3a;
            --text-light: #e9ecef;
            --border-light: #2d3b5e;
        }

        .nav-spacer {
            height: 90px;

            @media (max-width: 768px) {
                height: 70px;
            }
        }

        html {
            scroll-behavior: smooth;
        }

        .hero-section {
            background: var(--primary-gradient);
            color: white;
            padding: 120px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .hero-section>* {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-weight: 800;
            font-size: clamp(2.5rem, 5vw, 4rem);
            background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .tech-stack-card {
            background: white;
            border: 1px solid var(--border-light);
            border-radius: 16px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
        }

        .tech-stack-card:hover {
            border-color: transparent;
            /* background: linear-gradient(135deg, rgba(70, 117, 219, 0.15) 0%, rgba(90, 142, 238, 0.15) 50%, rgba(37, 99, 235, 0.15) 100%); */
            box-shadow: 0 20px 40px rgba(70, 117, 219, 0.3);
            transform: translateY(-8px);
        }

        .tech-icon {
            font-size: 3.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
        }

        .tech-list {
            list-style: none;
            padding: 0;
        }

        .tech-list li {
            padding: 0.75rem 0;
            position: relative;
            padding-left: 2rem;
            font-weight: 400;
        }

        .tech-list li::before {
            content: '▸';
            color: #5a8dee;
            position: absolute;
            left: 0;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .accuracy-badge {
            background: var(--primary-gradient);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 1.5rem;
            box-shadow: 0 4px 15px rgba(70, 117, 219, 0.4);
        }

        /* FOOTER - IDENTICAL */
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
    </style>
</head>

<body>
    <div class="nav-spacer"></div>

    <!-- HERO -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <h1>Technologies</h1>
                    <p class="lead fs-4 opacity-95 mt-4">Enterprise-grade precision using cutting-edge tools for
                        responsive, high-performance interfaces.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TECH STACK -->
    <section class="py-5" style="background: linear-gradient(135deg, #0f0f23 0%, #1a1a32 100%);">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="tech-stack-card h-100">
                        <i class="fab fa-html5 tech-icon"></i>
                        <h4 class="fw-bold mb-4">Core Technologies</h4>
                        <ul class="tech-list">
                            <li>HTML5 Semantic Markup</li>
                            <li>CSS3 Grid & Flexbox</li>
                            <li>JavaScript ES2025+</li>
                        </ul>
                        <span class="accuracy-badge">99.9% Cross-Browser</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="tech-stack-card h-100">
                        <i class="fab fa-react tech-icon"></i>
                        <h4 class="fw-bold mb-4">Modern Frameworks</h4>
                        <ul class="tech-list">
                            <li>React 19 & Next.js 15</li>
                            <li>Tailwind CSS 4.0</li>
                            <li>Bootstrap 5.4</li>
                        </ul>
                        <span class="accuracy-badge">Mobile-First Design</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="tech-stack-card h-100">
                        <i class="fas fa-chart-line tech-icon"></i>
                        <h4 class="fw-bold mb-4">Performance Stack</h4>
                        <ul class="tech-list">
                            <li>GSAP Motion UI</li>
                            <li>Core Web Vitals</li>
                            <li>PWA Architecture</li>
                        </ul>
                        <span class="accuracy-badge">Sub-1.5s Load Time</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
