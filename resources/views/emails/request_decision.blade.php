<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Notification</title>
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
            max-width: 640px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(18, 52, 90, 0.1), 0 8px 10px -6px rgba(18, 52, 90, 0.05);
            border: 1px solid #e2e8f0;
        }
        .email-header {
            background: linear-gradient(135deg, #070B12 0%, #12345A 60%, #245A91 100%);
            padding: 36px 32px;
            text-align: center;
            color: #ffffff;
        }
        .email-header img {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            margin-bottom: 12px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        .org-title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0;
            color: #ffffff;
        }
        .org-tagline {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #93c5fd;
            margin-top: 4px;
            font-weight: 600;
        }
        .status-hero {
            padding: 24px 32px;
            text-align: center;
        }
        .status-hero.approved {
            background-color: #ecfdf5;
            border-bottom: 2px solid #a7f3d0;
        }
        .status-hero.rejected {
            background-color: #fef2f2;
            border-bottom: 2px solid #fecaca;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .status-badge.approved {
            background-color: #10b981;
            color: #ffffff;
        }
        .status-badge.rejected {
            background-color: #ef4444;
            color: #ffffff;
        }
        .status-heading {
            font-size: 22px;
            font-weight: 800;
            margin: 12px 0 4px 0;
        }
        .status-heading.approved {
            color: #065f46;
        }
        .status-heading.rejected {
            color: #991b1b;
        }
        .email-body {
            padding: 36px 32px;
        }
        .greeting {
            font-size: 17px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 16px;
        }
        .body-text {
            font-size: 15px;
            color: #334155;
            margin-bottom: 24px;
            line-height: 1.7;
        }
        .info-table-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 28px;
        }
        .info-table-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #1e3a8a;
            margin: 0 0 14px 0;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 14px;
            border-bottom: 1px dashed #e2e8f0;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            color: #64748b;
            font-weight: 500;
        }
        .info-val {
            color: #0f172a;
            font-weight: 600;
            text-align: right;
        }
        .coordinator-notes-box {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            border-radius: 0 10px 10px 0;
            padding: 16px 20px;
            margin-bottom: 28px;
        }
        .coordinator-notes-title {
            font-size: 13px;
            font-weight: 700;
            color: #1e40af;
            text-transform: uppercase;
            margin: 0 0 6px 0;
        }
        .coordinator-notes-text {
            font-size: 14px;
            color: #1e3a8a;
            margin: 0;
            white-space: pre-wrap;
        }
        .contact-box {
            background: linear-gradient(135deg, #12345A 0%, #1e40af 100%);
            color: #ffffff;
            border-radius: 12px;
            padding: 22px;
            text-align: center;
            margin-bottom: 28px;
        }
        .contact-box h4 {
            margin: 0 0 8px 0;
            font-size: 16px;
            font-weight: 700;
        }
        .contact-box p {
            font-size: 13px;
            color: #bfdbfe;
            margin: 0 0 14px 0;
        }
        .cta-btn {
            display: inline-block;
            background-color: #38bdf8;
            color: #0f172a !important;
            padding: 10px 24px;
            border-radius: 9999px;
            font-weight: 700;
            text-decoration: none;
            font-size: 13px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .email-footer {
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 24px 32px;
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
            
            <!-- Organization Header -->
            <div class="email-header">
                <h1 class="org-title">Social Development Council (SDC)</h1>
                <div class="org-tagline">Humanitarian Relief & Community Development • Sri Lanka</div>
            </div>

            <!-- Decision Hero Banner -->
            <div class="status-hero {{ $decision }}">
                @if($decision === 'approved')
                    <span class="status-badge approved">Official Approval</span>
                    <h2 class="status-heading approved">🎉 Congratulations! Your Application is Approved</h2>
                    <p style="margin: 0; font-size: 14px; color: #047857;">You have been accepted into the program.</p>
                @else
                    <span class="status-badge rejected">Application Update</span>
                    <h2 class="status-heading rejected">Application Status Notice</h2>
                    <p style="margin: 0; font-size: 14px; color: #b91c1c;">Status update regarding your admission request.</p>
                @endif
            </div>

            <!-- Email Body -->
            <div class="email-body">
                <div class="greeting">Dear {{ $courseRequest->full_name }},</div>

                <div class="body-text">
                    @if($decision === 'approved')
                        We are delighted to notify you that your enrollment application for <strong>{{ $courseRequest->course_title }}</strong> has been officially reviewed and <strong style="color: #059669;">APPROVED</strong> by the Social Development Council (SDC).
                        <br><br>
                        Our academic and program coordinators are preparing the batch schedule. Below are your verified admission details. Please keep your contact phone and WhatsApp accessible so our field coordinators can reach you for the orientation session and kit distribution.
                    @else
                        Thank you for your interest and for submitting your application for <strong>{{ $courseRequest->course_title }}</strong> with the Social Development Council (SDC).
                        <br><br>
                        After thorough evaluation by our program selection board, we regret to inform you that we are unable to accommodate your application for the current cycle due to high applicant volume and limited classroom/session capacity.
                        <br><br>
                        Your profile has been placed on our priority waitlist for the subsequent batch. We sincerely appreciate your initiative and encourage you to explore our upcoming educational seminars and community welfare tracks.
                    @endif
                </div>

                <!-- Coordinator Notes if available -->
                @if(!empty($adminNotes))
                    <div class="coordinator-notes-box">
                        <div class="coordinator-notes-title">📌 Coordinator Note / Instructions:</div>
                        <p class="coordinator-notes-text">{{ $adminNotes }}</p>
                    </div>
                @endif

                <!-- Application Record Summary Table -->
                <div class="info-table-box">
                    <div class="info-table-title">Application Summary & Record</div>
                    
                    <div class="info-row">
                        <span class="info-label">Application Ref</span>
                        <span class="info-val">#SDC-REQ-{{ str_pad($courseRequest->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Program / Course</span>
                        <span class="info-val">{{ $courseRequest->course_title }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Category</span>
                        <span class="info-val">{{ ucfirst($courseRequest->type) }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Candidate Name</span>
                        <span class="info-val">{{ $courseRequest->full_name }}</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Contact Phone</span>
                        <span class="info-val">{{ $courseRequest->phone }}</span>
                    </div>

                    @if($courseRequest->district)
                    <div class="info-row">
                        <span class="info-label">District / Location</span>
                        <span class="info-val">{{ $courseRequest->district }} {{ $courseRequest->city ? '• ' . $courseRequest->city : '' }}</span>
                    </div>
                    @endif

                    @if($courseRequest->preferred_schedule)
                    <div class="info-row">
                        <span class="info-label">Preferred Timing</span>
                        <span class="info-val">{{ $courseRequest->preferred_schedule }}</span>
                    </div>
                    @endif

                    <div class="info-row">
                        <span class="info-label">Current Status</span>
                        <span class="info-val" style="color: {{ $decision === 'approved' ? '#059669' : '#dc2626' }};">
                            {{ $decision === 'approved' ? 'Approved & Admitted' : 'Application Not Approved' }}
                        </span>
                    </div>
                </div>

                <!-- Help & Contact Box -->
                <div class="contact-box">
                    <h4>Need Questions Answered or Special Assistance?</h4>
                    <p>Our dedicated community helpdesk is available to assist you Monday through Saturday.</p>
                    <a href="{{ route('contact') }}" class="cta-btn">Contact Admissions Desk</a>
                </div>

                <p style="font-size: 14px; color: #64748b; margin-top: 24px;">
                    Warm regards,<br>
                    <strong>Directorate of Education & Community Services</strong><br>
                    Social Development Council (SDC) Sri Lanka
                </p>
            </div>

            <!-- Email Footer -->
            <div class="email-footer">
                <p><strong>Social Development Council (SDC)</strong> • Non-Governmental Humanitarian Organization</p>
                <p>Phone: +94 (0) 67 222 9180 | Email: info@sdcsrilanka.org</p>
                <p>Main Secretariat: Karaitivu / Kalmunai, Eastern Province, Sri Lanka</p>
                <p style="font-size: 11px; color: #94a3b8; margin-top: 10px;">This is an automated official correspondence from the SDC Management Information System.</p>
            </div>

        </div>
    </div>
</body>
</html>

