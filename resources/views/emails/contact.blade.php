<!DOCTYPE html>
<html>

<head>
    <title>New Contact Message</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #4a6cf7;
            color: #fff;
            padding: 15px;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 5px 5px;
            border: 1px solid #eee;
        }

        .field {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            color: #4a6cf7;
        }

        .message-content {
            background-color: #fff;
            padding: 15px;
            border-left: 3px solid #4a6cf7;
            margin-top: 5px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>New Contact Form Submission</h2>
    </div>

    <div class="content">
        <div class="field">
            <span class="label">From:</span>
            <div>{{ $name }} ({{ $email }})</div>
        </div>

        <div class="field">
            <span class="label">Subject:</span>
            <div>{{ $subject }}</div>
        </div>

        @if (isset($phone) && $phone)
            <div class="field">
                <span class="label">Phone:</span>
                <div>{{ $phone }}</div>
            </div>
        @endif

        <div class="field">
            <span class="label">Message:</span>
            <div class="message-content">
                {{ $messageContent }}
            </div>
        </div>
    </div>

    <div class="footer">
        <p>This is an automated email. Please do not reply directly to this email.</p>
        <p>© {{ date('Y') }} {{ $siteSettings->site_name }} - All rights reserved</p>
    </div>
</body>

</html>
