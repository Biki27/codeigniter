<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESS Portal - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Request.css">
</head>

<body>

    <!-- TIME OFF REQUEST MODAL -->
    <div class="modal fade" id="timeOffModal" tabindex="-1" aria-labelledby="timeOffLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold" id="timeOffLabel">
                        <i class="fas fa-calendar-plus"></i> Request
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <?= form_open('Employee/EmployeeRequest') ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Start Date</label>
                        <input name="startdate" type="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">End Date</label>
                        <input name="enddate" type="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Reason</label>
                        <select name="reason" class="form-select" required>
                            <option value="">Select reason</option>
                            <option value="Medical">Medical</option>
                            <option value="Leave">Leave</option>
                            <option value="Personal">Personal</option>
                            <option value="Business">Business</option>
                        </select>
                    </div>
                    <input name="action" type="hidden" value="requestsubmit" class="form-control" required>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Summary</label>
                        <textarea name="summary" class="form-control" rows="3"
                            placeholder="Reason in details..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit Request</button>
                    <?= form_close() ?>

                </div>
            </div>
        </div>
    </div>

    <!-- TAB CONTENT -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="requests">
            <div class="container mt-4">
                <div class="section-header">
                    <h3 class="mb-0 fw-semibold text-primary">
                        <i class="fas fa-clock me-2"></i>Request Summary
                    </h3>
                    <span class="badge bg-primary fs-6 px-3 py-2">Request</span>
                </div>
                <div class="card p-3">
                    <h5 class="fw-semibold"><i class="fas fa-paper-plane"></i> Requests</h5>

                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#timeOffModal">
                        <i class="fas fa-plus"></i> Request
                    </button>

                    <div>
                        <table class="table table-hover">
                            <thead class="table-light" style="background-color: black;">
                                <tr>
                                    <th scope="col" class="fw-semibold">Request ID</th>
                                    <th scope="col" class="fw-semibold">Reason</th>
                                    <th scope="col" class="fw-semibold">Summary</th>
                                    <th scope="col" class="fw-semibold">Date Applied</th>
                                    <th scope="col" class="fw-semibold">Applied For</th>
                                    <th scope="col" class="fw-semibold">Days Count</th>
                                    <th scope="col" class="fw-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($requests as $req) { ?>
                                    <tr>
                                        <td><div><?= $req->seemrq_id ?></div></td>
                                        <td><div><?= $req->seemrq_reason ?></div></td>
                                        <td><div><?= $req->seemrq_summary ?></div></td>
                                        <td><div><?= $req->seemrq_reqdate ?></div></td>
                                        <td><div >
                                            <?= $req->seemrq_fromdate . ' to ' . $req->seemrq_todate ?>
                                        </div></td>
                                        <td><div ><?= $req->seemrq_days ?></div></td>
                                        <td><div class="badge
                                        <?php switch ($req->seemrq_status) {
                                            case 'approved':
                                                echo 'text-bg-success';
                                                break;
                                            case 'rejected':
                                                echo 'text-bg-danger';
                                                break;
                                            default:
                                                echo 'text-bg-warning';
                                                break;
                                        }
                                        ?> " style="width:90px; margin-left:30px;"><?= $req->seemrq_status ?>
                                        </div></td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>