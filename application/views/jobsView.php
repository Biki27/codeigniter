<?
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job search</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        .job-search-section {
            padding: 4rem 0;
        }

        .search-bar-main {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border-radius: 16px;
            overflow: hidden;
            background: white;
            backdrop-filter: blur(20px);
        }

        .search-main {
            font-weight: 500;
            border-left: none !important;
        }

        .search-main:focus {
            box-shadow: none;
            border-color: #2563eb !important;
        }

        .search-btn-main {
            white-space: nowrap;
            font-size: 1.1rem;
            padding: 1.25rem 3rem !important;
            transition: all 0.3s ease;
        }

        .search-btn-main:hover {
            background: #1d4ed8 !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
        }

        /* Filter Groups */
        .filter-group {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            height: 100%;
        }

        .filter-group:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .filter-input {
            border: 1px solid rgba(37, 99, 235, 0.2) !important;
            border-radius: 8px !important;
            padding: 0.75rem 1rem !important;
            font-size: 0.9rem;
            background: #fafbff;
        }

        .filter-input:focus {
            border-color: #2563eb !important;
            background: white;
            box-shadow: 0 0 0 0.15rem rgba(37, 99, 235, 0.15);
        }

        .filter-btn {
            border-radius: 8px !important;
            border: 2px solid #2563eb !important;
            padding: 0.875rem 1.25rem !important;
            font-weight: 600 !important;
            font-size: 0.9rem;
            color: #2563eb !important;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            background: #2563eb !important;
            color: white !important;
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-bar-main .input-group {
                flex-direction: column;
            }

            .search-btn-main {
                border-radius: 0 0 16px 16px !important;
                margin-top: 0.5rem;
            }

            .filter-group {
                margin-bottom: 1rem;
            }
        }

        .jobs-list-section {
            padding: 5rem 0;
            min-height: 100vh;
        }

        .job-card-dynamic {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            height: 100%;
        }

        .job-card-dynamic:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.15);
        }

        .job-header {
            background: linear-gradient(135deg, #f8fafc 0%, white 100%);
        }

        .job-title {
            color: #1e293b !important;
            font-weight: 700 !important;
            font-size: 1.3rem !important;
            line-height: 1.4;
        }

        .job-company {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .job-location {
            color: #64748b;
            font-size: 0.9rem;
        }

        .job-tags .badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .job-description {
            color: #64748b;
            line-height: 1.7;
            font-size: 0.95rem;
        }

        .job-meta small {
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8) !important;
            border: none !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4) !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .job-title {
                font-size: 1.2rem !important;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start !important;
            }
        }

        .resume-searches-section {
            padding: 3rem 0;
        }

        .resume-card,
        .searches-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }

        .resume-card:hover,
        .searches-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .search-item {
            color: #374151;
            border-radius: 8px !important;
        }

        .search-item:hover {
            background: #e5e7eb !important;
            color: #1e293b !important;
            transform: translateX(4px);
        }

        .search-item i.fa-times {
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .search-item:hover i.fa-times {
            opacity: 1;
        }

        #resumeUpload {
            border: 1px solid rgba(37, 99, 235, 0.2) !important;
            border-radius: 8px !important;
        }

        #resumeUpload:focus {
            border-color: #2563eb !important;
            box-shadow: 0 0 0 0.15rem rgba(37, 99, 235, 0.15) !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .resume-searches-section {
                padding: 2rem 0;
            }

            .resume-card,
            .searches-card {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- PERFECT TCS-STYLE JOB SEARCH SECTION -->
    <section class="job-search-section py-5" style="background: linear-gradient(135deg, #f8fafc 0%, white 100%);">
        <div class="container">
            <!-- LONG SIMPLE SEARCH BAR (TCS Style) -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10 col-xl-8">
                    <?= form_open("Jobs/SearchJob") ?>
                    <div class="search-bar-main position-relative">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white border-end-0"
                                style="border-radius: 16px 0 0 16px; padding: 1.25rem 1.5rem;">
                                <i class="fas fa-search fa-lg text-muted"></i>
                            </span>

                            <input type="text" class="form-control border-start-0 search-main"
                                placeholder="Search by Job Title, Skills, Keywords..." name="search" id="search"
                                style="border-radius: 0 16px 16px 0; padding: 1.25rem 2rem; font-size: 1.1rem; border: 2px solid rgba(37,99,235,0.1);">

                            <button class="btn btn-primary search-btn-main" type="submit"
                                style="border-radius: 0 16px 16px 0; padding: 1.25rem 2.5rem; font-weight: 600; background: #2563eb; border: none;">
                                Search Jobs
                            </button>

                        </div>
                    </div>
                    <?= form_close() ?>

                </div>
            </div>

            <?= form_open("Jobs/FilterJob") ?>
            <!-- 5 SMALL FILTERS BELOW (TCS Style Layout) -->
            <div class="row g-3 justify-content-center">
                <!-- 1. JOB TITLE -->
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="filter-group">
                        <label class="form-label fw-semibold text-muted small mb-2 d-block">Job Title</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-briefcase text-muted"></i>
                            </span>
                            <input id="jtitle" name="jtitle" type="text" class="form-control filter-input"
                                placeholder="Any Job Title">
                        </div>
                    </div>
                </div>

                <!-- 2. LOCATION -->
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="filter-group">
                        <label class="form-label fw-semibold text-muted small mb-2 d-block">Location</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-map-marker-alt text-muted"></i>
                            </span>
                            <select name="jlocation" id="jlocation" class="form-select filter-input">
                                <option value="">All Locations</option>
                                <option value="mumbai">Mumbai</option>
                                <option value="Bengaluru">Bengaluru</option>
                                <option value="Delhi NCR">Delhi NCR</option>
                                <option value="Hyderabad">Hyderabad</option>
                                <option value="Pune">Pune</option>
                                <option value="Chennai">Chennai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 3. FUNCTION -->
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="filter-group">
                        <label class="form-label fw-semibold text-muted small mb-2 d-block">Skills</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-layer-group text-muted"></i>
                            </span>
                            <select id="jskills" name="jskills" class="form-select filter-input">
                                <option value="">Skills</option>
                                <option value="python">Python</option>
                                <option value="java">Java</option>
                                <option value="html">HTML</option>
                                <option value="c">C and C++</option>
                                <option value="rust">Rust</option>
                                <option value="php">PHP</option>
                                <option value="react">React</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 4. EXPERIENCE -->
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="filter-group">
                        <label class="form-label fw-semibold text-muted small mb-2 d-block">Experience</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-clock text-muted"></i>
                            </span>
                            <select id="jexp" name="jexp" class="form-select filter-input">
                                <option value="">All Experience</option>
                                <option value="1">Fresher (0-1 Year)</option>
                                <option value="3">Less then 3 Years</option>
                                <option value="7">Less then 7 Years</option>
                                <option value="7plus">7+ Years</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 5. FILTER BUTTON -->
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="filter-group h-100 d-flex align-items-end">
                        <button class="btn btn-outline-primary w-100 filter-btn h-100" type="submit">
                            <i class="fas fa-sliders-h me-2"></i>
                            Filter Jobs
                        </button>
                    </div>
                </div>

                 <!-- <div class="col-lg-4 text-lg-end">
                    <select class="form-select d-inline-block w-auto" style="max-width: 200px; margin-top:40px; margin-left 50px;">
                        <option>Sort by: Relevance</option>
                        <option>Date Posted</option>
                        <option>Salary (High to Low)</option>
                        <option>Experience</option>
                    </select>
                </div> -->

            </div>

            <?= form_close() ?>

        </div>
    </section>


    <!-- DYNAMIC JOBS LIST - Add AFTER the search section -->
    <section class="jobs-list-section py-5" style="background: #f8fafc;">
        <div class="container">
            <!-- Jobs Header -->
            <div class="row mb-5">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center gap-3">
                        <h3 class="mb-0 fw-bold" style="color: #1e293b; font-size: 2rem;">
                            <i class="fas fa-briefcase me-3 text-primary"></i>
                            <?= count($res) ?> Jobs Found
                        </h3>
                        <span class="badge bg-primary px-3 py-2" style="font-size: 0.9rem;">New</span>
                    </div>
                </div>


                <!-- <div class="col-lg-4 text-lg-end">
                    <select class="form-select d-inline-block w-auto" style="max-width: 200px;">
                        <option>Sort by: Relevance</option>
                        <option>Date Posted</option>
                        <option>Salary (High to Low)</option>
                        <option>Experience</option>
                    </select>
                </div> -->


            </div>


            <!-- DYNAMIC JOB CARDS GRID -->
            <div class="row g-4" id="jobsContainer">

                <?php foreach ($res as $job) { ?>
                    <!-- Job 1 -->
                    <div class="col-lg-6 col-xl-4">
                        <div class="job-card-dynamic h-100">
                            <div class="job-header p-4 border-bottom">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h4 class="job-title mb-2"><?= $job->sejob_jobtitle ?></h4>
                                        <div class="job-company text-muted mb-1">Suropriyo Enterprise</div>
                                        <div class="job-location">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <?= $job->sejob_address ?>
                                        </div>
                                    </div>
                                    <span class="badge <?php
                                    if ($job->sejob_urgency == 'new') {
                                        echo "text-bg-success";
                                    }
                                    if ($job->sejob_urgency == 'hot') {
                                        echo "text-bg-warning";
                                    }
                                    if ($job->sejob_urgency == 'urgent') {
                                        echo "text-bg-danger";
                                    }
                                    ?>"><?= $job->sejob_urgency ?></span>

                                </div>
                            </div>
                            <div class="job-body p-4">
                                <div class="job-tags mb-3">
                                    <span class="badge bg-light text-dark border"><?= $job->sejob_workinghours ?></span>
                                    <span class="badge bg-light text-dark border"><?= $job->sejob_skills ?></span>
                                    <span class="badge bg-light text-dark border">$<?= $job->sejob_salary ?></span>
                                    <span class="badge bg-light text-dark border"
                                        style="margin-top:5px"><?= trim($job->sejob_experience) != 0 ? $job->sejob_experience : 'Fresher' ?></span>
                                </div>
                                <p class="job-description mb-4">
                                    <?= $job->sejob_desc ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="job-meta">
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>Posted on <?= $job->sejob_dateofpost ?>
                                        </small>
                                    </div>
                                    <a href="<?=base_url()?>index.php/Jobs/Apply" class="btn btn-primary px-4 py-2">
                                        Apply Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                <!-- Load More Button
                <div class="text-center mt-5">
                    <button class="btn btn-outline-primary px-5 py-3"
                        style="border-radius: 50px; font-size: 1.1rem; font-weight: 600;">
                        <i class="fas fa-plus me-2"></i>
                        Load More Jobs
                    </button>
                </div> -->

            </div>
    </section>

    <script>

    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>