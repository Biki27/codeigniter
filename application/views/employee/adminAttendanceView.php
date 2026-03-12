<?php if (isset($alert)) { ?>
    <script>
        alert("<?= $alert ?>");
    </script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance | Supropriyo Enterprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('css/admin/adminAttendanceView.css') ?>" rel="stylesheet">
</head>

<body>

    <div class="main-content">


        <div class="dual-containers">
            <!-- FIXED CALENDAR -->
            <div class="left-container">
                <div class="calendar-header">
                    <div class="calendar-title">
                        <i class="fas fa-calendar me-2"></i>
                        <span id="calendarMonth"></span>
                    </div>
                    <div class="calendar-nav">
                        <button class="nav-btn" onclick="prevMonth()"><i class="fas fa-chevron-left"></i></button>
                        <button class="nav-btn" onclick="nextMonth()"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="calendar-grid" id="calendarGrid"></div>
                <!-- daynamic -->
                <div class="time-section">
                    <div class="time-row">
                        <span class="time-label">
                            <?= ($this->session->userdata("accesslevel") == 'HR') ? "HR's" : "Admin's" ?> :
                            <?= $this->session->userdata("empname") ?>
                        </span>
                    </div>
                    <div class="time-row">
                        <span class="time-label"> Login Time:</span>
                        <span class="time-value login-time">
                            <?= (!empty($todayAttendance->seemp_logintime))
                                ? date("h:i A", strtotime($todayAttendance->seemp_logintime))
                                : '--:--' ?>
                        </span>
                    </div>
                    <div class="time-row">
                        <span class="time-label"> Logout Time:</span>
                        <span class="time-value logout-time">
                            <?= (!empty($todayAttendance->seemp_logouttime) && $todayAttendance->seemp_logouttime != '0000-00-00 00:00:00')
                                ? date("h:i A", strtotime($todayAttendance->seemp_logouttime))
                                : '--:--' ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Replace the right-container div with this -->
            <div class="right-container">
                <div class="premium-clock">
                    <div class="clock-bezel">
                        <div class="clock-face">
                            <!-- Luxury Number Markers -->
                            <div class="marker marker-12"></div>
                            <div class="marker marker-1"></div>
                            <div class="marker marker-2"></div>
                            <div class="marker marker-3"></div>
                            <div class="marker marker-4"></div>
                            <div class="marker marker-5"></div>
                            <div class="marker marker-6"></div>
                            <div class="marker marker-7"></div>
                            <div class="marker marker-8"></div>
                            <div class="marker marker-9"></div>
                            <div class="marker marker-10"></div>
                            <div class="marker marker-11"></div>

                            <!-- Luminous Center Jewel -->
                            <div class="center-jewel"></div>

                            <!-- Minute Track -->
                            <div class="minute-track"></div>
                        </div>
                    </div>

                    <!-- Precision Hands -->
                    <div class="hand hour-hand" id="hourHand">
                        <div class="hand-tip"></div>
                    </div>
                    <div class="hand minute-hand" id="minuteHand">
                        <div class="hand-tip"></div>
                    </div>
                    <div class="hand second-hand" id="secondHand">
                        <div class="hand-tip"></div>
                    </div>

                    <!-- Digital Time Overlay -->
                    <div class="digital-overlay" id="digitalTime">14:57</div>
                </div>

                <div class="luxury-date" id="luxuryDate">
                    <!-- <span class="date-day">Saturday</span> -->
                    <span class="date-details" id="todayDate"></span>
                </div>


            </div>

        </div>

        <?= form_open('Employee/viewAttendance') ?>

        <div class="search-form-wrapper">
            <div class="search-group">
                <label for="searchempid" class="text-white"><b>Employee ID</b></label>
                <input type="text" name="searchempid" class="search-bar" placeholder="Enter ID">
            </div>

            <div class="search-group">
                <label for="startdate" class="text-white"><b>Start Date</b></label>
                <input type="date" name="startdate" class="search-bar">
            </div>

            <div class="search-group">
                <label for="enddate" class="text-white"><b>End Date</b></label>
                <input type="date" name="enddate" class="search-bar">
            </div>

            <div class="search-group">
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>

        <?= form_close() ?>


        <div class="table-section">
            <h2 class="table-title">Today's Attendance Records</h2>
            <table class="table-custom">
                <thead>
                    <tr>
                        <th><i class="fas fa-calendar-day me-2"></i>Date</th>
                        <th><i class="fas fa-id-badge me-2"></i>Employee ID</th>
                        <th><i class="fas fa-user me-2"></i>Employee Name</th>
                        <th><i class="fas fa-clock me-2"></i>Login Time</th>
                        <th><i class="fas fa-clock me-3"></i>Logout Time</th>
                    </tr>
                </thead>
                <tbody id="attendanceTable">
                    <?php if (!empty($atten)): ?>
                        <?php foreach ($atten as $att): ?>
                            <tr>
                                <td><?= date("d-M-Y", strtotime($att->seemp_logdate)) ?></td>
                                <td><span class="emp-id"><?= $att->seemp_logempid ?></span></td>
                                <td><strong><?= $att->seempd_name ?? 'Unknown Employee' ?></strong></td>
                                <td class="login-time">
                                    <i class="fas fa-sign-in-alt me-1"></i>
                                    <?= date("h:i A", strtotime($att->seemp_logintime)) ?>
                                </td>
                                <td class="logout-time">
                                    <i class="fas fa-sign-out-alt me-1"></i>
                                    <?= ($att->seemp_logouttime && $att->seemp_logouttime != '0000-00-00 00:00:00')
                                        ? date("h:i A", strtotime($att->seemp_logouttime))
                                        : '<span class="text-muted">Not Logged Out</span>' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center p-4">No attendance records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        © 2026 Suropriyo Enterprise. All rights reserved.
    </div>


    <script>
        // ULTRA-PROFESSIONAL CLOCK + FULL FUNCTIONALITY
        function updateLuxuryClock() {
            const now = new Date();

            const seconds = now.getSeconds();
            const minutes = now.getMinutes();
            const hours = now.getHours();

            // Precision calculations (+90deg for 12 o'clock alignment)
            const secondsDeg = seconds * 6;
            const minutesDeg = minutes * 6 + (seconds * 6 / 60);
            const hoursDeg = (hours % 12) * 30 + (minutes * 30 / 60);

            // Smooth, realistic hand movement
            document.getElementById('secondHand').style.transform = `rotate(${secondsDeg}deg)`;
            document.getElementById('minuteHand').style.transform = `rotate(${minutesDeg}deg)`;
            document.getElementById('hourHand').style.transform = `rotate(${hoursDeg}deg)`;

            // Digital overlay
            const digitalTime = now.toLocaleTimeString('en-US', {
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('digitalTime').textContent = digitalTime;

            // Luxury date display
            const date = now.toLocaleDateString('en-US', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            document.getElementById('luxuryDate').querySelector('.date-details').textContent = date;
        }

        function showTodayDate() {

            const now = new Date();

            const options = {
                weekday: "long",
                day: "numeric",
                month: "long",
                year: "numeric"
            };

            const todayText = now.toLocaleDateString("en-US", options);

            document.getElementById("todayDate").innerText = todayText;
        }

        // Search functionality
        document.querySelector('[name="searchempid"]').addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#attendanceTable tr');
            rows.forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
        });

        // Navigation
        function showSection(sectionId) {
            document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
            event.target.closest('.nav-link').classList.add('active');
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) window.location.href = 'index.html';
        }

        function prevMonth() { alert('Previous month functionality'); }
        function nextMonth() { alert('Next month functionality'); }


        // Initialize luxury clock
        showTodayDate();
        updateLuxuryClock();
        setInterval(updateLuxuryClock, 1000);
    </script>

    <script>let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();

        function renderCalendar() {

            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            document.getElementById("calendarMonth").innerText =
                monthNames[currentMonth] + " " + currentYear;

            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

            const today = new Date();

            let html = "";

            const weekdays = ["S", "M", "T", "W", "T", "F", "S"];

            weekdays.forEach(day => {
                html += `<div class="calendar-weekdays">${day}</div>`;
            });

            for (let i = 0; i < firstDay; i++) {
                html += `<div class="calendar-day other-month"></div>`;
            }

            for (let day = 1; day <= daysInMonth; day++) {

                let isToday =
                    day === today.getDate() &&
                    currentMonth === today.getMonth() &&
                    currentYear === today.getFullYear();

                html += `<div class="calendar-day ${isToday ? "today" : ""}">
                    ${day}
                </div>`;
            }

            document.getElementById("calendarGrid").innerHTML = html;
        }

        function prevMonth() {
            currentMonth--;

            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }

            renderCalendar();
        }

        function nextMonth() {
            currentMonth++;

            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }

            renderCalendar();
        }

        renderCalendar();

    </script>

</body>

</html>