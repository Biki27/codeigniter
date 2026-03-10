<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>css/Career.css">
</head>

<body>

    <!-- Professional Hero Banner -->
    <section class="hero-banner">
        <!-- Optimized Video Background -->
        <video class="video-background" autoplay muted loop playsinline preload="auto">
            <source src="<?= base_url(); ?>videos/carere.mp4" type="video/mp4">
            <img src="career-fallback-image.jpg" alt="Career Banner" style="width:100%;height:100%;object-fit:cover;">
        </video>

        <!-- Enhanced Gradient Overlay -->
        <div class="video-overlay"></div>

        <!-- Perfectly Aligned Content -->
        <div class="content-left">
            <h1 class="hero-title">CAREERS</h1>
            <p class="hero-subtitle">
                Seize the future.
            </p>
            <!-- <a href="#careers" class="cta-btn">
                <i class="fas "></i>
                Apply now
            </a> -->
            <div class="cta-container">
                <a href="<?= base_url() ?>index.php/welcome/Jobs" class="cta-btn">Explore Opportunities</a>
                <div >
                    <a href="<?= base_url() ?>index.php/welcome/Jobs"
                    class="fas  arrow-btn fa-arrow-right"> 
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Career Section -->
    <section id="careers" class="py-5">
        <div class="container">
            <h2 class="section-title mb-5">Career Opportunities</h2>
            <div class="row">

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-lg">
                        <div class="card-body text-center p-5">
                            <i class="fas fa-code display-4 text-primary mb-3"></i>
                            <h4 class="card-title fw-bold">Database Engineer</h4>
                            <p class="card-text">Build High speed database Api.</p>
                        </div>
                    </div>
                </div>
            
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-lg">
                        <div class="card-body text-center p-5">
                            <i class="fas fa-code display-4 text-primary mb-3"></i>
                            <h4 class="card-title fw-bold">Software Developer</h4>
                            <p class="card-text">Build innovative solutions with modern tech stacks.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-lg">
                        <div class="card-body text-center p-5">
                            <i class="fas fa-code display-4 text-primary mb-3"></i>
                            <h4 class="card-title fw-bold">AI/ML Engineer</h4>
                            <p class="card-text">Build innovative AI/ML solutions with morden solutions.</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- Career Opportunities Section - Add after Why Us section -->
    <section id="careers-opportunities" class="py-5 bg-white">
        <div class="container">
            <!-- Suropriyo Enterprise Title -->
            <div class="row mb-5">
                <div class="col-lg-8">
                    <h3 class="fw-bold text-primary mb-0" style="font-size: 1.5rem; letter-spacing: 1px;">
                        Why SUROPRIYO ENTERPRISE?
                    </h3>
                </div>
            </div>

            <div class="row">
                <!-- Left Sidebar - 4 Career Tabs -->
                <div class="col-lg-3">
                    <div class="career-tabs " style="top: 100px;">
                        <div class="tab-item active" data-tab="software">Software Development</div>
                        <div class="tab-item" data-tab="data">App Development</div>
                        <div class="tab-item" data-tab="cloud">Secure Maintenance & Support</div>
                        <div class="tab-item" data-tab="cyber">Hosting & Infrastructure Management</div>
                    </div>
                </div>

                <!-- Right Content Area -->
                <div class="col-lg-9">
                    <!-- Software Development Card (Default Active) -->
                    <div class="career-detail active" id="software">
                        <div class="row align-items-center g-5">
                            <!-- Left Banner Image -->
                            <div class="col-md-5">
                                <div class="career-banner">
                                    <img src="<?= base_url(); ?>assets/software.png" alt="Software Development"
                                        class="img-fluid rounded-4 shadow-lg" style="height: 400px; object-fit: cover;">
                                </div>
                            </div>
                            <!-- Right Content -->
                            <div class="col-md-7">
                                <h4 class="fw-bold mb-4 text-dark" style="font-size: 2rem;">Software Development</h4>
                                <p class="lead mb-4 text-muted fs-5">
                                    Build next-generation applications using cutting-edge technologies and modern
                                    development practices.
                                </p>
                                <div class="row g-4 mb-5">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="icon-circle me-3">
                                                <i class="fas fa-check text-success"></i>
                                            </div>
                                            <span>Full Stack Development</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="icon-circle me-3">
                                                <i class="fas fa-check text-success"></i>
                                            </div>
                                            <span>React, Node.js, Python</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="icon-circle me-3">
                                                <i class="fas fa-check text-success"></i>
                                            </div>
                                            <span>DevOps & CI/CD</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-circle me-3">
                                                <i class="fas fa-check text-success"></i>
                                            </div>
                                            <span>Agile Methodologies</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="#apply" class="cta-btn">Apply Now →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Data Science Card -->
                    <div class="career-detail" id="data">
                        <div class="row align-items-center g-5">
                            <div class="col-md-5">
                                <div class="career-banner">
                                    <img src="<?= base_url(); ?>assets/appdevlopent.png" alt="Data Science"
                                        class="img-fluid rounded-4 shadow-lg" style="height: 400px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <h4 class="fw-bold mb-4 text-dark" style="font-size: 2rem;">App Development</h4>
                                <p class="lead mb-4 text-muted fs-5">
                                    Design and develop user-centric mobile and web applications with a strong focus on
                                    performance and usability.
                                </p>
                                <!-- Similar content structure -->
                                <a href="#apply" class="cta-btn">Apply Now →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Cloud Engineering Card -->
                    <div class="career-detail" id="cloud">
                        <div class="row align-items-center g-5">
                            <div class="col-md-5">
                                <img src="<?= base_url(); ?>assets/secure.png" alt="Cloud Engineering"
                                    class="img-fluid rounded-4 shadow-lg" style="height: 400px; object-fit: cover;">
                            </div>
                            <div class="col-md-7">
                                <h4 class="fw-bold mb-4 text-dark" style="font-size: 2rem;">Secure Maintenance & Support
                                </h4>
                                <p class="lead mb-4 text-muted fs-5">
                                    Gain hands-on experience in maintaining, securing, and optimizing live production
                                    systems.
                                </p>
                                <a href="#apply" class="cta-btn">Apply Now →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Cybersecurity Card -->
                    <div class="career-detail" id="cyber">
                        <div class="row align-items-center g-5">
                            <div class="col-md-5">
                                <img src="<?= base_url(); ?>assets/hosting.png" alt="Cybersecurity"
                                    class="img-fluid rounded-4 shadow-lg" style="height: 400px; object-fit: cover;">
                            </div>
                            <div class="col-md-7">
                                <h4 class="fw-bold mb-4 text-dark" style="font-size: 2rem;">Hosting & Infrastructure
                                    Management</h4>
                                <p class="lead mb-4 text-muted fs-5">
                                    Work with modern hosting and infrastructure technologies to ensure high availability
                                    and system reliability.
                                </p>
                                <a href="#apply" class="cta-btn">Apply Now →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="ceo-vision" class="py-5 bg-gradient-to-b from-slate-50 to-white">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Compact Quote -->
                <div class="col-lg-9 col-xl-8 text-center mb-4">
                    <div class="quote-container position-relative px-4 py-3">
                        <blockquote class="quote-text mb-0"
                            style="color: #1f2937; font-style: italic; line-height: 1.6; font-size: 1.3rem;">
                            "At Suropriyo Enterprise, we don't just build technology - we build futures. Join us to
                            create transformative solutions that redefine industries."
                        </blockquote>
                        <div class="quote-mark"
                            style="font-size: 2.5rem; color: #9ca3af; position: absolute; top: -15px; left: 20px; opacity: 0.6;">
                            „
                        </div>
                    </div>
                </div>
            </div>

            <!-- Compact CEO Profile -->
            <div class="row justify-content-center">
                <div class="col-lg-3 col-xl-2 text-center">
                    <!-- Smaller CEO Photo -->
                    <div class="ceo-photo mx-auto mb-3 position-relative overflow-hidden"
                        style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: 4px solid rgba(255,255,255,0.9); box-shadow: 0 12px 35px rgba(59,130,246,0.3);">
                        <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center p-3">
                            <i class="fas fa-user-tie text-white"
                                style="font-size: 2.5rem; text-shadow: 0 2px 8px rgba(0,0,0,0.3);"><img src="./g3.png"
                                    alt=""></i>
                        </div>
                    </div>

                    <!-- Compact CEO Details -->
                    <div class="ceo-details">
                        <h5 class="fw-bold mb-1" style="font-size: 1.1rem; color: #111827; letter-spacing: 0.5px;">
                            Mr. Surajit Das</h5>
                        <p class="mb-2 small fw-medium" style="color: #6b7280; font-size: 0.85rem;">Founder</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.tab-item').forEach(tab => {
            tab.addEventListener('click', function () {
                // Remove active class from all
                document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.career-detail').forEach(c => c.classList.remove('active'));

                // Add active to clicked
                this.classList.add('active');
                document.getElementById(this.dataset.tab).classList.add('active');
            });
        });

    </script>
</body>

</html>