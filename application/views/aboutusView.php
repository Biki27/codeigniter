<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Font Awesome 6 - FREE icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?= base_url(); ?>css/About.css">
</head>

<body>

    <div id="carouselExampleIndicators" class="carousel slide" **data-bs-ride="carousel" data-bs-interval="1500" **>
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url() ?>assets/banner1.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url() ?>assets/banner2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url() ?>assets/banner3.jpeg" class="d-block w-100" alt="...">
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="about">
        <h1>About Us</h1>
        <p>Suropriyo Enterprise delivers 2025 AI Leadership Suite—enterprise-grade AI agents, RAG systems, and
            full-stack
            web solutions built for rapid deployment.we specialize in autonomous workflow automation, secure enterprise
            search
            across proprietary data, computer vision analytics, and responsive web applications including career portals
            and
            admin systems.
    </div>

    <section class="container-fluid">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 card-container">

            <?php foreach($products as $product){?>

            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="<?= base_url(); ?>assets/<?= $product->seprod_img ?>" class="card-img-top" alt="Product 1">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $product->seprod_name ?></h5>
                        <p class="card-text flex-grow-1"><?= $product->seprod_inf ?>
                        </p>
                        <button 
                        onclick="window.open('https://<?= $product->seprod_link ?>', '_blank')"
                        target="_blank" class="btn btn-primary mt-auto">View More</button>
                    </div>
                </div>
            </div>

            <?php } ?>
            
        </div>
    </section>



    <br>
    <div class="para">
        <p> Suropriyo Enterprise pioneers 2025 AI transformation with our Innovation Suite—autonomous AI agents, secure
            RAG
            systems, and computer vision solutions that deploy in just 2 weeks. We craft responsive enterprise web
            applications including career portals, attendance tracking systems, and admin dashboards alongside
            cutting-edge AI
            that powers workflow automation, intelligent document search, and real-time visual analytics. Every solution
            delivers immediate ROI with 95% accuracy and enterprise-grade security. From modern React/Node.js full-stack
            development to production-ready AI deployments, we eliminate technical complexity so businesses focus on
            growth.
            Our Howrah headquarters drives innovation serving enterprises across healthcare, finance, manufacturing, and
            beyond.</p>
    </div>

    <!-- Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script> -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myCarousel = document.querySelector('#carouselExampleIndicators');
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 1500,  // 1.5 seconds (FAST)
                ride: 'carousel' // Auto-start
            });
        });
    </script>

</body>

</html>