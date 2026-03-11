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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: radial-gradient(circle at 0% 50%, #461bb9 20%, #973ce0 50%, #6b37e4 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: #333;
        }

        /* SAME SIDEBAR - UNCHANGED */
        .sidebar {
            background: rgba(255, 255, 255, 0.97);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            padding: 25px 20px;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            z-index: 1000;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(70, 27, 185, 0.1);
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #461bb9, #973ce0);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin: 0 auto 15px;
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
        }

        .logo h5 {
            color: #461bb9;
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            color: #6b37e4 !important;
            font-weight: 500;
            margin-bottom: 12px;
            padding: 12px 20px !important;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .nav-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .nav-link:hover {
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white !important;
            transform: translateX(8px);
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white !important;
        }

        .main-content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
            background: #0f0f23;
        }

        /* ATTENDANCE PAGE CONTENT - UNCHANGED */


        .dual-containers {
            display: flex;
            gap: 25px;
            margin-bottom: 35px;
        }

        .left-container {
            flex: 1;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            height: fit-content;
        }

        /* FIXED PERFECT CALENDAR */
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(70, 27, 185, 0.1);
        }

        .calendar-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #461bb9;
            background: linear-gradient(135deg, #461bb9, #973ce0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .calendar-nav {
            display: flex;
            gap: 10px;
        }

        .nav-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .nav-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.4);
        }

        /* PERFECT CALENDAR GRID - FIXED */
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-template-rows: 45px repeat(6, 1fr);
            gap: 6px;
            height: 280px;
            width: 100%;
        }

        .calendar-weekdays {
            background: rgba(107, 55, 228, 0.1);
            color: #6b37e4;
            font-weight: 600;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            padding: 4px;
        }

        .calendar-day {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.95rem;
            color: #555;
            border: 2px solid transparent;
            height: 38px;
        }

        .calendar-day:hover {
            background: rgba(70, 27, 185, 0.1);
            transform: scale(1.05);
            color: #461bb9;
            border-color: rgba(70, 27, 185, 0.2);
        }

        .calendar-day.today {
            background: linear-gradient(135deg, #461bb9, #973ce0) !important;
            color: white !important;
            font-weight: 700 !important;
            border-color: rgba(255, 255, 255, 0.3) !important;
            box-shadow: 0 4px 12px rgba(70, 27, 185, 0.3);
            transform: scale(1.05);
        }

        .calendar-day.selected {
            background: linear-gradient(135deg, #10b981, #059669) !important;
            color: white !important;
            font-weight: 700 !important;
        }

        /* REST UNCHANGED */
        .time-section {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 2px solid rgba(70, 27, 185, 0.1);
        }

        .time-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-size: 1rem;
        }

        .time-label {
            font-weight: 600;
            color: #555;
        }

        .time-value {
            font-weight: 700;
            font-size: 1.1rem;
        }

        .login-time {
            color: #10b981;
        }

        .logout-time {
            color: #ef4444;
        }

        .view-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white;
            border: none;
            border-radius: 15px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .view-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(70, 27, 185, 0.4);
        }

        .right-container {
            flex: 1.5;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .right-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(70, 27, 185, 0.03), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .clock {
            font-size: 5rem;
            font-weight: 300;
            font-family: 'Courier New', monospace;
            background: linear-gradient(135deg, #461bb9, #973ce0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
            letter-spacing: 3px;
        }

        .date-display {
            font-size: 1.4rem;
            color: #666;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        .table-section {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }

        .table-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 35px;
            color: #333;
            background: linear-gradient(135deg, #461bb9, #973ce0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .table-custom th {
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white;
            padding: 20px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-custom td {
            padding: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .table-custom tr:hover {
            background: rgba(70, 27, 185, 0.05);
            transform: scale(1.01);
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0px;
            right: 0;
            text-align: center;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9rem;
            padding: 15px;
            background: rgba(70, 27, 185, 0.1);
            backdrop-filter: blur(10px);
        }

        @media (max-width: 992px) {
            .dual-containers {
                flex-direction: column;
            }

            .clock {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }

            .main-content,
            .footer {
                margin-left: 0;
            }
        }

        /* ANALOG CLOCK STYLES */
        /* LUXURY PROFESSIONAL CLOCK */
        .premium-clock {
            position: relative;
            width: 300px;
            height: 300px;
            margin: 85px auto 20px;
        }

        .clock-bezel {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: radial-gradient(circle at 50% 50%,
                    rgba(255, 255, 255, 0.98) 0%,
                    rgba(240, 245, 255, 0.95) 40%,
                    rgba(200, 220, 255, 0.9) 70%);
            border: 8px solid transparent;
            background-clip: padding-box;
            box-shadow:
                0 0 0 2px rgba(255, 255, 255, 0.8),
                0 25px 60px rgba(0, 0, 0, 0.35),
                inset 0 2px 0 rgba(255, 255, 255, 1),
                inset 0 -3px 20px rgba(0, 0, 0, 0.12);
        }

        /* Bezel Ring */
        .clock-bezel::before {
            content: '';
            position: absolute;
            top: -8px;
            left: -8px;
            right: -8px;
            bottom: -8px;
            border-radius: 50%;
            background: linear-gradient(135deg, #461bb9 0%, #973ce0 50%, #6b37e4 100%);
            z-index: -1;
            box-shadow: 0 0 30px rgba(70, 27, 185, 0.6);
        }

        .clock-face {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background:
                radial-gradient(circle at 50% 50%,
                    rgba(255, 255, 255, 1) 0%,
                    rgba(248, 250, 255, 0.98) 50%);
        }

        /* Professional Hour Markers */
        .marker {
            position: absolute;
            width: 4px;
            height: 24px;
            background: linear-gradient(to top, #461bb9, #ffffff);
            top: 13%;
            left: 50%;
            transform: translateX(-50%) rotate(0deg);
            transform-origin: 50% 100%;
        }

        .marker-12 {
            transform: translateX(-50%) rotate(0deg);
        }

        .marker-1 {
            transform: translateX(-50%) rotate(30deg);
        }

        .marker-2 {
            transform: translateX(-50%) rotate(60deg);
        }

        .marker-3 {
            transform: translateX(-50%) rotate(90deg);
            height: 32px;
        }

        .marker-4 {
            transform: translateX(-50%) rotate(120deg);
        }

        .marker-5 {
            transform: translateX(-50%) rotate(150deg);
        }

        .marker-6 {
            transform: translateX(-50%) rotate(180deg);
        }

        .marker-7 {
            transform: translateX(-50%) rotate(210deg);
        }

        .marker-8 {
            transform: translateX(-50%) rotate(240deg);
        }

        .marker-9 {
            transform: translateX(-50%) rotate(270deg);
            height: 32px;
        }

        .marker-10 {
            transform: translateX(-50%) rotate(300deg);
        }

        .marker-11 {
            transform: translateX(-50%) rotate(330deg);
        }

        /* Minute Track */
        .minute-track {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-image:
                radial-gradient(circle at 50% 50%, transparent 48%, rgba(70, 27, 185, 0.1) 49%, transparent 50%);
        }

        /* LUXURY HANDS */
        .hand {
            position: absolute;
            top: 50%;
            left: 50%;
            transform-origin: 100% 100%;
            transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .hand-tip {
            position: absolute;
            top: 0;
            left: 50%;
            width: 6px;
            height: 6px;
            background: #ffffff;
            border-radius: 50%;
            transform: translateX(-50%);
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.8);
        }

        .hour-hand {
            width: 6px;
            height: 65px;
            background: linear-gradient(180deg, #2d1b69 0%, #461bb9 60%, #ffffff 95%);
            margin-top: -65px;
            margin-left: -3px;
            border-radius: 4px;
            box-shadow:
                0 0 12px rgba(70, 27, 185, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            z-index: 10;
        }

        .minute-hand {
            width: 4px;
            height: 90px;
            background: linear-gradient(180deg, #6b37e4 0%, #a78bfa 70%, #ffffff 95%);
            margin-top: -90px;
            margin-left: -2px;
            border-radius: 3px;
            box-shadow:
                0 0 10px rgba(107, 55, 228, 0.7),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
            z-index: 15;
        }

        .second-hand {
            width: 2px;
            height: 105px;
            background: linear-gradient(180deg, #ef4444 0%, rgba(239, 68, 68, 0.8) 70%, #ffffff 95%);
            margin-top: -105px;
            margin-left: -1px;
            border-radius: 2px;
            box-shadow: 0 0 8px rgba(239, 68, 68, 0.6);
            z-index: 20;
        }

        .center-jewel {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 18px;
            height: 18px;
            background:
                radial-gradient(circle at 30% 30%, #ffffff 0%, transparent 50%),
                linear-gradient(135deg, #461bb9, #973ce0);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: 25;
            box-shadow:
                0 0 20px rgba(70, 27, 185, 0.8),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
        }

        /* FIXED DIGITAL OVERLAY - ABOVE JEWEL */
        .digital-overlay {
            position: absolute;
            top: 35%;

            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.9);

            color: #ffffff;
            font-family: 'Courier New', monospace;
            font-size: 1.1rem;
            font-weight: 700;
            padding: 12px 20px;

            border-radius: 20px;
            letter-spacing: 2px;
            backdrop-filter: blur(15px);
            box-shadow:
                0 12px 35px rgba(0, 0, 0, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            z-index: 30;

            min-width: 140px;
            text-align: center;
        }

        .premium-clock:hover .digital-overlay {
            opacity: 1;

            transform: translate(-50%, -50%) scale(1.05);
            margin-top: 20px;
        }

        /* Luxury Date */
        .luxury-date {
            text-align: center;
            color: #666;
            font-weight: 600;
            margin-top: 10px;
            font-size: 1rem;
        }

        .date-day {
            display: block;
            font-size: 1.3rem;
            color: #461bb9;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* RESPONSIVE PERFECTION */
        @media (max-width: 992px) {
            .premium-clock {
                width: 260px;
                height: 260px;
            }

            .hour-hand {
                height: 55px;
                margin-top: -55px;
            }

            .minute-hand {
                height: 75px;
                margin-top: -75px;
            }

            .second-hand {
                height: 85px;
                margin-top: -85px;
            }

            .marker {
                height: 20px;
            }

            .marker-3,
            .marker-9 {
                height: 26px;
            }
        }

        @media (max-width: 768px) {
            .premium-clock {
                width: 220px;
                height: 220px;
            }

            .hour-hand {
                height: 45px;
                margin-top: -45px;
                width: 5px;
                margin-left: -2.5px;
            }

            .minute-hand {
                height: 65px;
                margin-top: -65px;
                width: 3px;
                margin-left: -1.5px;
            }

            .second-hand {
                height: 70px;
                margin-top: -70px;
            }

            .digital-overlay {
                font-size: 1rem;
                padding: 6px 12px;
            }
        }



        .search-container {
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 500px;
            margin: 20px 322px;
        }

        .search-type-dropdown {
            padding: 12px 16px;
            border: 2px solid #ddd;
            border-radius: 8px 0 0 8px;
            background: white;
            font-size: 14px;
            cursor: pointer;
            min-width: 120px;
        }

        .search-bar {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #ddd;
            border-radius: 0;
            font-size: 14px;
            outline: none;
        }

        .search-bar:focus {
            border-color: #007bff;
        }

        .search-btn {
            padding: 12px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            font-size: 16px;
        }

        .search-btn:hover {
            background: #0056b3;
        }

        /* Responsive Search Container */
.search-form-wrapper {
    display: flex;
    flex-wrap: wrap;       /* Crucial: allows items to drop to next line */
    gap: 15px;             /* Space between items */
    align-items: flex-end; /* Keeps button aligned with inputs */
    margin-top: 25px;
    margin-bottom: 25px;
    width: 100%;
}

.search-group {
    flex: 1;               /* Items grow to fill space */
    min-width: 200px;      /* Prevents items from getting too tiny */
}

/* Specific fix for the button group so it doesn't look weird when stretched */
.search-group:last-child {
    flex: 0.5; 
    min-width: 150px;
}

/* Ensure inputs take full width of their container */
.search-bar {
    width: 100% !important;
    margin: 5px 0 0 0 !important; /* Reset any weird margins */
}

.search-btn {
    width: 100%;
    height: 48px; /* Matches the height of the date inputs */
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border-radius: 8px !important;
}

/* Mobile Adjustments */
@media (max-width: 576px) {
    .search-group {
        flex: 1 1 100%;    /* Forces each input to take 100% width on small phones */
    }
    
    .search-form-wrapper {
        gap: 10px;
    }
}

/* 1. Force footer to bottom of viewport */
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
    background: radial-gradient(circle at 0% 50%, #461bb9 20%, #973ce0 50%, #6b37e4 100%);
    font-family: 'Inter', sans-serif;
}

/* 2. Main content expands to push footer down */
.main-content {
    flex: 1 0 auto; /* This pushes the footer to the bottom */
    margin-left: 260px;
    padding: 30px;
    transition: all 0.3s ease;
}

/* 3. Modern Glassmorphism Footer */
.footer {
    flex-shrink: 0;
    margin-left: 0px; /* Aligns with sidebar */
    padding: 20px;
    text-align: center;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

/* 4. Responsive adjustments for Footer + Content */
@media (max-width: 992px) {
    .main-content, .footer {
        margin-left: 0 !important;
        width: 100%;
    }
    
    .footer {
        padding: 15px;
        font-size: 0.85rem;
        /* Ensure footer doesn't hide behind mobile navigation bars */
        margin-bottom: 0; 
    }
}

/* 1. Sidebar Toggle Logic */
.sidebar {
    transition: all 0.3s ease-in-out;
}

/* 2. Main Content Adjustment */
.main-content {
    margin-left: 260px;
    transition: margin-left 0.3s ease;
    width: calc(100% - 260px);
}

/* 3. The Responsive Magic */
@media (max-width: 1100px) {
    .dual-containers {
        flex-direction: column; /* Stack Clock and Calendar */
    }
    .left-container, .right-container {
        width: 100%;
        flex: none;
    }
}

@media (max-width: 992px) {
    .sidebar {
        transform: translateX(-100%); /* Hide sidebar by default */
        width: 260px;
    }
    .main-content {
        margin-left: 0;
        width: 100%;
        padding: 20px;
    }
    .sidebar.active {
        transform: translateX(0); /* Show when toggled */
    }
    .footer {
        left: 0;
    }
}

/* 4. Search Form Responsiveness */
.search-group-container {
    display: flex;
    flex-wrap: wrap; /* Allows wrapping on mobile */
    gap: 15px;
    background: rgba(255, 255, 255, 0.05);
    padding: 20px;
    border-radius: 20px;
    align-items: flex-end;
}

.search-item {
    flex: 1;
    min-width: 200px; /* Forces wrapping if space is less than 200px */
}

.search-bar {
    width: 100%;
    border-radius: 10px !important; /* Overriding the 0 radius for mobile elegance */
}

.search-btn {
    width: 100%;
    border-radius: 10px !important;
    height: 48px;
}

/* 5. Table Responsiveness */
.table-section {
    overflow-x: auto; /* Adds horizontal scroll to table only if needed */
}

.table-custom {
    min-width: 600px; /* Prevents columns from squishing too much */
}
    </style>

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

                <div class="time-section">
                    <div class="time-row">
                        <span class="time-label">Admin's : <?= $this->session->userdata("empname") ?></span>

                    </div>
                    <div class="time-row">
                        <span class="time-label"> Login Time:</span>
                        <span class="time-value login-time">
                            <?= isset($todayAttendance->seemp_logintime) ? date("h:i A", strtotime($todayAttendance->seemp_logintime)) : '--:--' ?>
                        </span>
                    </div>
                    <div class="time-row">
                        <span class="time-label"> Logout Time:</span>
                        <span class="time-value logout-time">
                            <?= isset($todayAttendance->seemp_logouttime) ? date("h:i A", strtotime($todayAttendance->seemp_logouttime)) : '--:--' ?>
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
                        <th><i class="fas fa-clock me-2"></i>Login Time</th>
                        <th><i class="fas fa-clock me-3"></i>Logout Time</th>
                    </tr>
                </thead>
                <tbody id="attendanceTable">
                    <?php foreach ($atten as $att) { ?>
                        <tr>
                            <td><?= $att->seemp_logdate ?></td>
                            <td><?= $att->seemp_logempid ?></td>
                            <td class="login-time"><?= $att->seemp_logintime ?></td>
                            <td class="logout-time"><?= $att->seemp_logouttime ?></td>
                        </tr>
                    <?php } ?>
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