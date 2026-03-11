<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contect Us</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Font Awesome 6 - FREE icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?= base_url(); ?>css/Contect.css">
</head>

<body>
    <div >
        <img  id="banner" style="border-radius:0px" src="<?= base_url();?>assets/banner_technologices.png" alt="technologices images">
    </div>

    <div class="container-fluid py-5">
        <h1>Technologies</h1>
        <section class="card-container" style="color: aliceblue; " !important>
            <div class="card" style="width: 18rem;">
                <img src="<?= base_url(); ?>assets/s1.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Web Design</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card’s
                        content.</p>
                    <a href="<?= base_url(); ?>index.php/Services/Technologies" class="btn btn-primary">Explore</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="<?= base_url(); ?>assets/s2.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Devlopement</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card’s
                        content.</p>
                    <a href="<?= base_url(); ?>index.php/Services/Technologies" class="btn btn-primary">Explore</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="<?= base_url(); ?>assets/s3.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">SEO</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card’s
                        content.</p>
                    <a href="<?= base_url(); ?>index.php/Services/Technologies" class="btn btn-primary">Explore</a>
                </div>
            </div>
        </section>
    </div>

    <hr>

    <div class="container-fluid py-5">
        <h1>Team Members</h1>
        <section class="card-container1">
            <div class="card" style="width: 18rem;">
                <img src="<?= base_url(); ?>assets/t1.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Founder </h5>
                    <p class="card-text">Leads AI Innovation Suite delivery with 10+ years enterprise experience,
                        specializing in
                        autonomous agents and rapid deployment from Howrah.</p>
                    <a href="<?= base_url() ?>index.php/Contactus/Ceo" class="btn btn-primary">View Profile</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="<?= base_url(); ?>assets/t2.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Lead Web Developer</h5>
                    <p class="card-text">Builds responsive enterprise web solutions integrated with AI agents, ensuring
                        2-week
                        deployments for operational excellence.</p>
                    <a href="<?= base_url() ?>index.php/Contactus/LeadDev" class="btn btn-primary">View Profile</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="<?= base_url(); ?>assets/t3.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">DevOps Engineer</h5>
                    <p class="card-text">Manages CI/CD for 2-week AI deployments, ensuring zero-downtime updates and
                        enterprise-grade security compliance.
                    </p>
                    <a href="<?= base_url() ?>index.php/Contactus/LeadDev" class="btn btn-primary">View Profile</a>
                </div>
            </div>
        </section>
    </div>

    <hr>

    <section class="contact-section">
        <div class="container" id="contactform">
            <div class="contact-content contact-500"> <!-- add contact-500 -->

                <!-- Left: Contact Form -->
                <div class="contact-form-side">
                    <div class="contect-form">
                        <h2>Contact us</h2>
                         <!-- <form id="Contactus" name="Contactus" method="post" action="<?= ""//base_url()?>index.php/ContactUs"> -->
                            <?= form_open("ContactUs") ?>
                            <div data-mdb-input-init class="form-outline mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-3">
                                <label class="form-label" for="email">Email address</label>
                                <input type="email" id="email" name="email" class="form-control" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-3">
                                <label class="form-label" for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-3">
                                <label class="form-label" for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                            </div>

                            <button data-mdb-button-init id="submit-form" type="submit" data-mdb-ripple-init
                                class="btn btn-primary btn-block">
                                Send Message
                            </button>
                        </form>

                    </div>
                </div>

                <!-- Right: Map + Address Card -->
                <div class="map-side map-500">
                    <div class="map-container map-500-top"
                        style="position: relative; height: 480px; overflow: hidden; border-radius: 12px;">
                        <iframe
                            src="https://www.google.com/maps/d/u/0/embed?mid=1BL83g7JqpQ8UZ-OyKSzE8Sw2dX-rkFY&ehbc=2E312F"
                            width="640" height="530px"
                            style="position: absolute; top: -50px; left: 0; width: 100%; height: 100%; border: 0;"
                            allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>


                    <div class="address-content">
                        <div class="address-row">
                            <!-- Address 1 -->
                            <div class="single-address">
                                <h5>Office Address </h5>
                                <p>Kolkata <br>West Bengal, India </p>
                                <div class="contact-details">
                                    <div class="contact-item">
                                        <i class="fas fa-phone"></i>
                                        <span>+91 89811 74517</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>suropriyo@gmail.com</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Mon - Fri: 10AM - 7PM</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Address 2 -->
                            <!-- <div class="single-address">
                                <h5>Branch Office</h5>
                                <p>Salt Lake, Sector V<br>Kolkata, India - 700091</p>
                                <div class="contact-details">
                                    <div class="contact-item">
                                        <i class="fas fa-phone"></i>
                                        <span>+91 98765 43210</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>branch@company.com</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Mon - Sat: 10AM - 7PM</span>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>

                </div> <!-- /.map-side -->
            </div> <!-- /.contact-content -->
        </div> <!-- /.container -->
    </section>

    <section>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-xl-8 text-center">
                <h3 class="mb-4 ">Testimonials</h3>
                <p class="mb-4 pb-2 mb-md-5 pb-md-0">
                    At SUROPRIYO ENTERPRISES, client satisfaction is at the core of everything we do. We take pride in
                    delivering
                    innovative, reliable, and scalable digital solutions that drive real business value. Here’s what our
                    clients
                    have to say about their experience working with us.
                </p>
            </div>
        </div>

        <div class="row text-center">    
            <?php foreach($tsm_d as $tsm){ ?>
                <div class="col-md-4 mb-5 mb-md-0">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="<?= base_url(); ?>assets/<?= $tsm->setsm_img ?>"
                            class="rounded-circle shadow-1-strong" width="150" height="150" />
                    </div>
                    <h5 class="mb-3"><?= $tsm->setsm_name ?></h5>
                    <h6 class="text-primary mb-3 web"><?= $tsm->setsm_designation ?></h6>
                    <p class="px-xl-3">
                        <i class="fas fa-quote-left pe-2"></i><?= $tsm->setsm_quote ?>
                    </p>
                    
                    <ul class="list-unstyled d-flex justify-content-center mb-0">
                    <?php for($i = 0 ; $i < $tsm->setsm_rating; $i ++){?>
                        <li>
                            <i class="fas fa-star fa-sm text-warning"></i>
                        </li>
                    <?php }?>
                    </ul>
                </div>

            <?php }  ?>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>