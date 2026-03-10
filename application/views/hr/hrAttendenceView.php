<style>
    .main-content { margin-left: 260px; padding: 40px; transition: all 0.3s ease; }
    .attendance-container {
        background: white; border-radius: 20px;
        padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .status-indicator {
        height: 10px; width: 10px; border-radius: 50%;
        display: inline-block; margin-right: 5px;
    }
    .online { background-color: #28a745; box-shadow: 0 0 8px #28a745; }
    .offline { background-color: #dc3545; }
    @media (max-width: 992px) { .main-content { margin-left: 0; padding-top: 80px; } }
</style>

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white fw-bold">Attendance Monitoring</h2>
            <div class="bg-white px-4 py-2 rounded-pill shadow-sm">
                <i class="fas fa-users text-primary me-2"></i> 
                <strong><?= count($today_logs) ?></strong> Active Sessions Today
            </div>
        </div>

        <div class="attendance-container">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Employee Name</th>
                            <th>ID & Branch</th>
                            <th>Login Time</th>
                            <th>Logout Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($today_logs)): ?>
                            <?php foreach($today_logs as $log): ?>
                            <tr>
                                <td><strong><?= $log['seemp_name'] ?></strong></td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= $log['seemp_logempid'] ?></span>
                                    <small class="text-muted ms-2"><?= $log['seemp_branch'] ?></small>
                                </td>
                                <td><?= date('h:i A', strtotime($log['seemp_logintime'])) ?></td>
                                <td>
                                    <?= ($log['seemp_logouttime'] == '0000-00-00 00:00:00') ? 
                                        '<span class="text-muted italic">Session Active</span>' : 
                                        date('h:i A', strtotime($log['seemp_logouttime'])) ?>
                                </td>
                                <td>
                                    <?php if($log['seemp_logouttime'] == '0000-00-00 00:00:00'): ?>
                                        <span class="status-indicator online"></span> <small>Online</small>
                                    <?php else: ?>
                                        <span class="status-indicator offline"></span> <small>Logged Out</small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-4 text-muted">No attendance logs found for today.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Link this to your existing sidebar toggle logic
    document.getElementById('mobileToggle').onclick = function() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('sidebarOverlay').classList.toggle('active');
    };
</script>