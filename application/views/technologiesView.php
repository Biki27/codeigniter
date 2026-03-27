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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/technologies.css'); ?>">
    </head>

<body>
    <section class="premium-tech-hero">
        <div class="container position-relative z-2">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-9 col-xl-8">
                    <span class="premium-hero-badge mb-3">Our Stack</span>
                    <h1 class="premium-hero-title">Technologies</h1>
                    <p class="premium-hero-subtitle mt-4">
                        Enterprise-grade precision using cutting-edge tools for responsive, high-performance interfaces.
                    </p>
                </div>
            </div>
        </div>
        <div class="hero-glow"></div>
    </section>

    <section class="py-5 bg-light-soft stack-section">
        <div class="container py-4">
            <div class="row g-4 justify-content-center">
                
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="premium-tech-card w-100 h-100 d-flex flex-column p-4 p-xl-5">
                        <div class="tech-icon-wrapper mb-4">
                            <i class="fab fa-html5"></i>
                        </div>
                        <h4 class="tech-card-title">Core Technologies</h4>
                        <ul class="premium-tech-list flex-grow-1">
                            <li><i class="fas fa-check"></i> HTML5 Semantic Markup</li>
                            <li><i class="fas fa-check"></i> CSS3 Grid & Flexbox</li>
                            <li><i class="fas fa-check"></i> JavaScript ES2025+</li>
                        </ul>
                        <div class="mt-4 pt-4 border-top">
                            <span class="premium-tech-badge">
                                <i class="fas fa-shield-alt me-1"></i> 99.9% Cross-Browser
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="premium-tech-card w-100 h-100 d-flex flex-column p-4 p-xl-5">
                        <div class="tech-icon-wrapper mb-4">
                            <i class="fab fa-react"></i>
                        </div>
                        <h4 class="tech-card-title">Modern Frameworks</h4>
                        <ul class="premium-tech-list flex-grow-1">
                            <li><i class="fas fa-check"></i> React 19 & Next.js 15</li>
                            <li><i class="fas fa-check"></i> Tailwind CSS 4.0</li>
                            <li><i class="fas fa-check"></i> Bootstrap 5.4</li>
                        </ul>
                        <div class="mt-4 pt-4 border-top">
                            <span class="premium-tech-badge">
                                <i class="fas fa-mobile-alt me-1"></i> Mobile-First Design
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="premium-tech-card w-100 h-100 d-flex flex-column p-4 p-xl-5">
                        <div class="tech-icon-wrapper mb-4">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4 class="tech-card-title">Performance Stack</h4>
                        <ul class="premium-tech-list flex-grow-1">
                            <li><i class="fas fa-check"></i> GSAP Motion UI</li>
                            <li><i class="fas fa-check"></i> Core Web Vitals</li>
                            <li><i class="fas fa-check"></i> PWA Architecture</li>
                        </ul>
                        <div class="mt-4 pt-4 border-top">
                            <span class="premium-tech-badge">
                                <i class="fas fa-tachometer-alt me-1"></i> Sub-1.5s Load Time
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>