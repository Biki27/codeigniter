<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url(); ?>css/services.css">

</head>

<body>

    <section class="hero-banner">
        <div class="banner-row">

            <div class="banner-image">
                <img src="<?= base_url(); ?>assets/services.png" alt="Banner Image">
            </div>

            <div class="banner-content">
                <h2>Amazing Services Await</h2>
                <p>Discover premium services designed to transform your business. Expert team ready to help.</p>
                <a href="<?= base_url() ?>index.php/Services" class="cta-button">Get Started</a>
            </div>
        </div>
    </section>

    <figure class="text-center">
        <blockquote class="blockquote">
            <h1>What We Do</h1>
        </blockquote>
        <figcaption class="blockquote-footer">
            We provide comprehensive digital solutions that empower organizations to achieve sustainable growth and
            operational excellence. Our services are designed to align with business objectives, leveraging technology,
            strategy, and innovation to deliver measurable results.
            <cite title="Source Title">Source Title</cite>
        </figcaption>
    </figure>

    <br>

    <div class="services-section">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="services-grid">

                <?php foreach($allserv as $srv){ ?>

                <!-- Service 1 -->
                <div class="service-card" data-service="web">
                    <div class="service-front">
                        <div class="service-image">
                            <img src="<?= base_url(); ?>assets/web.png" alt="Web Development">
                        </div>
                        <div class="service-content">
                            <div class="content-row">
                                <h4><?= $srv->sesrv_name ?></h4>
                                <span class="subheading"><?= $srv->sesrv_type ?></span>
                            </div>
                            <p><?= $srv->sesrv_desc ?></p>
                        </div>
                    </div>
                    <div class="service-back">
                        <div class="back-content">
                            <h4><?= $srv->sesrv_name ?></h4>
                            <ul class="service-features">
                                 <?php foreach (json_decode($srv->sesrv_lines) as $item) { ?>
                                    <li><i class="fas fa-check"></i>
                                        <?= $item[0] ?>
                                    </li>
                                <?php } ?>
                            </ul>

                        </div>
                    </div>
                </div>

                <?php }?>
                
            </div>
            <div class="services-button-container">
                <a href="<?= base_url() ?>index.php/Services" class="view-all-btn">View All Services →</a>
            </div>
        </div>
    </div>

    <br>
    <section class="how-it-works">
        <div class="container">
            <h2 class="section-title">How It Works</h2>

            <div class="works-content">
                <!-- Left: Banner Image -->
                <div class="banner-side">
                    <div class="banner-image">
                        <img src="<?= base_url(); ?>assets/h.png" alt="How it works">
                    </div>
                </div>

                <!-- Right: 4 Cards (2x2 Grid) -->
                <div class="cards-side">
                    <div class="cards-grid">
                        <!-- Step 1 -->
                        <div class="step-card">
                            <div class="step-image">
                                <img src="<?= base_url(); ?>assets/consult.png" alt="Step 1">
                            </div>
                            <div class="step-content">
                                <h4>Step 1</h4>
                                <p>Consultation & Planning - We understand your goals and create a customized strategy
                                    for success.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="step-card">
                            <div class="step-image">
                                <img src="<?= base_url(); ?>assets/design.jpg" alt="Step 2">
                            </div>
                            <div class="step-content">
                                <h4>Step 2</h4>
                                <p>Design & Development - Our experts craft pixel-perfect designs and robust
                                    functionality.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="step-card">
                            <div class="step-image">
                                <img src="<?= base_url(); ?>assets/h3.png" alt="Step 3">
                            </div>
                            <div class="step-content">
                                <h4>Step 3</h4>
                                <p>Testing & Launch - Rigorous testing ensures flawless performance before going live.
                                </p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="step-card">
                            <div class="step-image">
                                <img src="<?= base_url(); ?>assets/support.jpg" alt="Step 4">
                            </div>
                            <div class="step-content">
                                <h4>Step 4</h4>
                                <p>Ongoing Support - Continuous maintenance and optimization for long-term success.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <h2 class="section-title">Our Gallery</h2>

    <div class="row">
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            <img src="<?= base_url(); ?>assets/g1.png" class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />

            <img src="<?= base_url(); ?>assets/g2.png" class="w-100 shadow-1-strong rounded mb-4" alt="Wintry Mountain Landscape" />
        </div>

        <div class="col-lg-4 mb-4 mb-lg-0">
            <img src="<?= base_url(); ?>assets/g3.png" class="w-100 shadow-1-strong rounded mb-4" alt="Mountains in the Clouds" />

            <img src="<?= base_url(); ?>assets/g4.png" class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />
        </div>

        <div class="col-lg-4 mb-4 mb-lg-0">
            <img src="<?= base_url(); ?>assets/g5.png" class="w-100 shadow-1-strong rounded mb-4" alt="Waves at Sea" />

            <img src="<?= base_url(); ?>assets/g6.png" class="w-100 shadow-1-strong rounded mb-4" alt="Yosemite National Park" />
        </div>
    </div>

    <section class="new-section">
        <div class="section-row">
            <!-- Left Side: Heading and Content -->
            <div class="left-side">
                <h2 class="section-heading">Our Mission</h2>
                <p class="section-content">
                    At SUROPRIYO ENTERPRISES, our mission is to set benchmarks in quality, reliability, and innovation
                    by
                    delivering solutions that create tangible and lasting value for our clients. We strive to be more
                    than a
                    service provider—we aim to be a trusted strategic partner in our clients’ growth journeys.

                    Driven by a disciplined, agile, and performance-focused work culture, we combine technical
                    excellence with a
                    deep understanding of business needs to deliver solutions that are efficient, scalable, and
                    future-ready. Our
                    commitment to strong ethical standards, transparency, and industry best practices guides every
                    decision we
                    make and every solution we deliver.

                    Through continuous innovation, process excellence, and a client-first approach, we empower
                    organizations to
                    adapt, evolve, and thrive in a rapidly changing digital landscape. Our ultimate goal is to build
                    enduring
                    partnerships that drive sustainable growth, operational excellence, and long-term success for our
                    clients.
                </p>
            </div>
            <!-- Right Side: 2x2 Grid of Items -->
            <div class="right-container">
                <div class="items-grid">
                    <!-- Row 1 - Item 1 -->
                    <div class="item">
                        <img src="<?= base_url(); ?>assets/innovation.png" alt="Icon 1" class="item-image">
                        <h5 class="item-heading">Innovation</h5>
                        <p class="item-text">We drive innovation to create cutting-edge solutions for our clients.</p>
                    </div>
                    <!-- Row 1 - Item 2 -->
                    <div class="item">
                        <img src="<?= base_url(); ?>assets/quality.png" alt="Icon 2" class="item-image">
                        <h5 class="item-heading">Quality</h5>
                        <p class="item-text">Commitment to quality ensures every product meets the highest standards.
                        </p>
                    </div>
                    <!-- Row 2 - Item 3 -->
                    <div class="item">
                        <img src="<?= base_url(); ?>assets/sustanibility.png" alt="Icon 3" class="item-image">
                        <h5 class="item-heading">Sustainability</h5>
                        <p class="item-text">We prioritize eco-friendly practices for a better future.</p>
                    </div>
                    <!-- Row 2 - Item 4 (Add your 4th image here) -->
                    <div class="item">
                        <img src="<?= base_url(); ?>assets/excellence.png" alt="Icon 4" class="item-image">
                        <h5 class="item-heading">Excellence</h5>
                        <p class="item-text">Delivering exceptional results through dedication and expertise.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script> -->
</body>

</html>