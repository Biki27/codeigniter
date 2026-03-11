<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Interview Invitation</title>
</head>

<body style="margin:0;padding:0;background:#f4f7fa;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 20px;background:#f4f7fa;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:10px;overflow:hidden;">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="background:#1e3a8a;color:#ffffff;padding:30px;">
                            <h1 style="margin:0;font-size:26px;">SUROPRIYO ENTERPRISE</h1>
                            <p style="margin:5px 0 0 0;">Interview Invitation</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:40px;">

                            <h2 style="margin-top:0;">Dear <?= htmlspecialchars($name) ?>,</h2>

                            <p>
                                Thank you for applying for the position of
                                <strong><?= htmlspecialchars($position) ?></strong>
                                at <strong>Suropriyo Enterprise</strong>.
                            </p>

                            <p>
                                We are pleased to invite you for an interview. Please find the interview details below:
                            </p>

                            <!-- Interview Details -->
                            <table width="100%"
                                style="background:#f1f5f9;border-radius:8px;padding:20px;margin:25px 0;">
                                <tr>
                                    <td>

                                        <p><strong>📅 Interview Date:</strong> <?= htmlspecialchars($date) ?></p>

                                        <p><strong>⏰ Interview Time:</strong> <?= htmlspecialchars($time) ?></p>

                                        <p><strong>📍 Interview Location:</strong> <?= htmlspecialchars($location) ?>
                                        </p>

                                        <p><strong>👤 Interviewer:</strong> <?= htmlspecialchars($hr_name) ?></p>

                                    </td>
                                </tr>
                            </table>

                            <p>
                                Please arrive at least <strong>10 minutes before</strong> the scheduled time.
                            </p>

                            <p>
                                If you have any questions or need to reschedule, feel free to contact us.
                            </p>

                            <p>
                                Best Regards,<br>
                                <strong>HR Team</strong><br>
                                Suropriyo Enterprise
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background:#1f2937;color:#9ca3af;padding:25px;">
                            <p style="margin:0;">
                                Suropriyo Enterprise<br>
                                Howrah, West Bengal
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>