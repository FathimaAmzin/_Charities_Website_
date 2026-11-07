<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f5f9;
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif;
            color: #1e293b;
            line-height: 1.6;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f1f5f9;
            padding: 40px 15px;
        }
        .email-card {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(18, 52, 90, 0.1), 0 8px 10px -6px rgba(18, 52, 90, 0.05);
            border: 1px solid #e2e8f0;
        }
        .email-header {
            background: linear-gradient(135deg, #070B12 0%, #12345A 60%, #245A91 100%);
            padding: 32px;
            text-align: center;
            color: #ffffff;
        }
        .org-title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0;
            color: #ffffff;
        }
        .org-tagline {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #93c5fd;
            margin-top: 4px;
            font-weight: 600;
        }
        .email-body {
            padding: 36px 32px;
        }
        .greeting {
            font-size: 17px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 14px;
        }
        .body-text {
            font-size: 15px;
            color: #334155;
            margin-bottom: 24px;
            line-height: 1.7;
        }
        .btn-wrapper {
            text-align: center;
            margin: 30px 0;
        }
        .reset-btn {
            display: inline-block;
            background: linear-gradient(135deg, #0059FF 0%, #0B2568 100%);
            color: #ffffff !important;
            padding: 14px 34px;
            border-radius: 9999px;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.02em;
            box-shadow: 0 6px 18px rgba(0, 89, 255, 0.35);
        }
        .security-notice {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
            border-radius: 0 8px 8px 0;
            padding: 14px 18px;
            margin: 24px 0;
            font-size: 13px;
            color: #92400e;
        }
        .direct-link-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
            font-size: 12px;
            color: #64748b;
            word-break: break-all;
            margin-top: 20px;
        }
        .email-footer {
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 22px 32px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }
        .email-footer p {
            margin: 4px 0;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-card">
            
            <!-- Header -->
            <div class="email-header">
                <h1 class="org-title">Social Development Council (SDC)</h1>
                <div class="org-tagline">Security & Member Account Access</div>
            </div>

            <!-- Body -->
            <div class="email-body">
                <div class="greeting">Hello {{ $user->name }},</div>

                <div class="body-text">
                    We received a request to reset the password for your account associated with <strong>{{ $user->email }}</strong>.
                    <br><br>
                    To select a new password and securely access your portal, please click the button below:
                </div>

                <div class="btn-wrapper">
                    <a href="{{ $resetUrl }}" class="reset-btn">Reset My Password</a>
                </div>

                <div class="security-notice">
                    <strong>⚠️ Security Note:</strong> This password reset link will expire in <strong>60 minutes</strong>. If you did not make this request, you can safely ignore this email—your account password remains completely unchanged.
                </div>

                <div class="body-text" style="font-size: 13px; color: #64748b; margin-bottom: 8px;">
                    If the button above does not work, copy and paste the following URL into your web browser:
                </div>
                <div class="direct-link-box">
                    <a href="{{ $resetUrl }}" style="color: #0059FF;">{{ $resetUrl }}</a>
                </div>

                <p style="font-size: 14px; color: #64748b; margin-top: 28px;">
                    Best regards,<br>
                    <strong>SDC Information & Security Desk</strong><br>
                    Social Development Council Sri Lanka
                </p>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <p><strong>Social Development Council (SDC)</strong></p>
                <p>Phone: +94 (0) 67 222 9180 | Email: info@sdcsrilanka.org</p>
                <p>Karaitivu / Kalmunai, Eastern Province, Sri Lanka</p>
            </div>

        </div>
    </div>
</body>
</html>

