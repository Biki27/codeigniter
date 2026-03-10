<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Suropriyo Enterprise</title>

    <!-- BOOTSTRAP 5 REQUIRED -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
    <style>
        /* FIXED NAVBAR - YOUR EXACT STYLES */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            padding-top: 85px;
            /* FIXED: Prevents overlap */
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


        .standalone-search {
            display: flex;
            max-width: 600px;
            margin: 45px auto;
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
        }

        .search-input {
            flex: 1;
            padding: 15px 25px;
            border: none;
            background: rgba(255, 255, 255, 0.95);
            font-size: 16px;
            outline: none;
        }

        .search-btn {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: none;
            padding: 15px 25px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .search-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
            transform: scale(1.05);
        }

        /* SERVICES SECTION - YOUR ORIGINAL */
        .services-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            text-align: center;
            margin-bottom: 50px;
            margin-top: -50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        /* ALL OTHER SERVICES STYLES - UNCHANGED */
        .service-card {
            background: white;
            border-radius: 20px;
            overflow: visible;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            min-height: 420px;
            display: flex;
            flex-direction: column;
        }

        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 35px 80px rgba(0, 0, 0, 0.15);
        }

        .service-content {
            padding: 30px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

        }

        .content-row {
            display: flex;
            align-items: baseline;
            gap: 12px;
            margin-bottom: 15px;
        }

        .content-row h4 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .subheading {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .service-description {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 25px;
            flex-grow: 1;
        }

        .service-features {
            list-style: none;
        }

        .service-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            color: #475569;
            font-weight: 500;
            border-bottom: 1px solid #f1f5f9;
        }

        .service-features li:last-child {
            border-bottom: none;
        }

        .service-features i {
            color: #10b981;
            width: 18px;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .services-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .service-card {
                height: auto;
                min-height: 420px;
            }
        }

        .service-btn {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
            margin-top: auto;
        }

        .service-btn:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
            text-decoration: none;
        }

        /* FOOTER - FIXED */
        .footer-section {
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(6, 5, 82, 1) 7%, rgba(9, 9, 121, 1) 21%, rgba(4, 130, 201, 1) 56%, rgba(0, 212, 255, 1) 89%);
            border-top: 1px solid rgba(0, 0, 0, 0.08);
            padding: 25px 0;
            margin-top: 80px;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-content {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            text-align: center;
        }

        .copyright-text {
            color: #ffffff;
            font-size: 1.10rem;
            font-weight: 500;
            line-height: 1.5;
        }

        .brand-link {
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .ai-badge {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
        }
    </style>
</head>

<body>
    <div class="search-btn-container">
        <?= form_open('Services/Searchservice') ?>
        <div class="standalone-search">
            <input type="text" name="ques" class="search-input" placeholder="Search services...">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <?= form_close() ?>
    </div>
    <!-- YOUR SERVICES CONTENT -->
    <div class="services-section">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="services-grid">

                <?php foreach ($allserv as $serv) { ?>

                    <div class="service-card">
                        <div class="service-content">
                            <div class="content-row">
                                <h4><?= $serv->sesrv_name ?></h4>
                                <span class="subheading"><?= $serv->sesrv_type ?></span>
                            </div>
                            <p class="service-description"><?= $serv->sesrv_desc ?></p>
                            <ul class="service-features">
                                <?php foreach (json_decode($serv->sesrv_lines) as $item) { ?>
                                    <li><i class="fas fa-check"></i>
                                        <?= $item[0] ?>
                                    </li>
                                <?php } ?>
                            </ul>

                            <?= form_open('Services/ServiceDescription')?>
                            <input type="hidden" name="serv_id" value="<?= $serv->sesrv_id ?>"/>
                            <button type="submit" class="service-btn mt-3">
                                <i class="fas fa-arrow-right me-2"></i>Learn More
                            </button>
                            <?= form_close() ?>
                            
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
    <!-- BOOTSTRAP JS REQUIRED -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FOOTER -->
    <footer class="footer-section">
        <div class="footer-container">
            <div class="footer-content">
                <span class="copyright-text">
                    © 2026 Copyright:
                    <a href="#" class="brand-link">Suropriyo Enterprise</a>
                    | All Rights Reserved
                </span>
                <span class="ai-badge">🤖 AI Powered</span>
            </div>
        </div>
    </footer>
</body>

</html>