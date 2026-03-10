<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Description - Suropriyo Enterprise</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
	<link rel="stylesheet" href="<?= base_url(); ?>css/Home.css">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.7;
            color: #333;
            background: #f8fafc;
        }

         /* YOUR EXACT NAVBAR STYLES - FIXED */
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

        .brand-text {
            color: #2563eb !important;
            font-size: 1.3rem;
            font-weight: 700 !important;
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

        /* Mobile fixes */
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

            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                margin-top: 15px;
                border-radius: 16px;
                padding: 20px;
                box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
            }
        }


        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* HERO SECTION */
        .hero-section {
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(6, 5, 82, 1) 7%, rgba(9, 9, 121, 1) 21%, rgba(4, 130, 201, 1) 56%, rgba(0, 212, 255, 1) 89%);
            color: white;
            padding: 100px 0 80px;
            text-align: center;
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
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .service-badge {
            display: inline-flex;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 2rem;
        }

        .hero-title {
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.3rem;
            max-width: 700px;
            margin: 0 auto 3rem;
            opacity: 0.95;
        }

        /* MAIN CONTENT */
        .content-section {
            padding: 80px 0;
            background: white;
        }

        .section-title {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            text-align: center;
            margin-bottom: 50px;
            font-weight: 700;
            color: #1e293b;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-radius: 2px;
        }

        /* FEATURES */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .feature-card {
            padding: 40px 30px;
            background: #f8fafc;
            border-radius: 20px;
            border-left: 5px solid #2563eb;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-left-color: #1d4ed8;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 1.4rem;
            color: white;
        }

        .feature-card h3 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 15px;
        }

        .feature-card p {
            color: #64748b;
            line-height: 1.7;
        }

        /* PROCESS */
        .process-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 24px;
            padding: 60px 40px;
            margin: 60px 0;
        }

        .process-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .process-step {
            text-align: center;
            position: relative;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0 auto 25px;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }

        .process-step h4 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 15px;
        }

        /* BENEFITS */
        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin: 60px 0;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 25px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .benefit-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .benefit-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            flex-shrink: 0;
            margin-top: 3px;
        }

        .benefit-content h5 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }

        /* CTA */
        .cta-section {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            text-align: center;
            padding: 80px 0;
            border-radius: 24px;
            margin: 80px 0;
        }

        .cta-title {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            margin-bottom: 20px;
        }

        .cta-description {
            font-size: 1.2rem;
            opacity: 0.95;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-3px);
            color: white;
            text-decoration: none;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }
            
            .hero-section {
                padding: 60px 0 50px;
            }
            
            .content-section {
                padding: 60px 0;
            }
            
            .process-container {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="service-badge">
                    <i class="fas fa-code"></i>
                    <?= $serv[0]->sesrv_name ?>
                </div>
                <h1 class="hero-title">Transform Your Vision<br>Into Digital Reality</h1>
                <p class="hero-description">We craft modern, responsive applications using cutting-edge technologies and best practices for optimal performance across all devices.</p>
            </div>
        </div>
    </div>

    <div class="content-section">
        <div class="container">
            <h2 class="section-title">Comprehensive <?= $serv[0]->sesrv_name ?> Solutions</h2>
            <p style="font-size: 1.2rem; color: #64748b; text-align: center; max-width: 800px; margin: 0 auto 60px;">
                <?= $serv[0]->sesrv_desc ?>
            </p>
            <div class="features-grid">

                <?php  foreach(json_decode($serv[0]->sesrv_majdesc)  as $item){ ?>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fab fa-react"></i>
                    </div>
                    <h3><?= $item[1]?></h3>
                    <p><?= $item[2] ?></p>
                </div>
                
                 <?php }?>

            </div>
            <h2 class="section-title">Why Choose Us</h2>
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="benefit-content">
                        <h5>Lightning Fast Delivery</h5>
                        <p>Agile methodology ensures rapid development cycles without compromising quality.</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="benefit-content">
                        <h5>Enterprise Grade Security</h5>
                        <p>OWASP Top 10 compliance, encryption, secure authentication, and regular security audits.</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-infinity"></i>
                    </div>
                    <div class="benefit-content">
                        <h5>Scalable Architecture</h5>
                        <p>Built to handle millions of users with microservices, load balancing, and cloud-native design.</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="benefit-content">
                        <h5>24/7 Expert Support</h5>
                        <p>Dedicated support team with SLA-backed response times and proactive monitoring.</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="benefit-content">
                        <h5>Performance Optimized</h5>
                        <p>Lighthouse scores 95+, Core Web Vitals compliant, CDN integration, and image optimization.</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div class="benefit-content">
                        <h5>Future Ready</h5>
                        <p>Latest frameworks, Web3 ready, AI integration capable, and continuous improvement roadmap.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <div class="container">
            <h2 class="cta-title">Ready to Build Something Amazing?</h2>
            <p class="cta-description">Let's discuss your web development project and create a custom solution that drives your business forward.</p>
            <a href="<?= base_url() ?>index.php/Contactus#contactform" class="cta-button">
                <i class="fas fa-arrow-right"></i>
                Start Your Project
            </a>
        </div>
    </div>

     <!-- BOOTSTRAP JS REQUIRED -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>