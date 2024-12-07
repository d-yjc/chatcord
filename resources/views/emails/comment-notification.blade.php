<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Comment Notification</title>
    <style>
     
        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #151336;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 20px;
            color: #333333;
        }
        .email-body p {
            line-height: 1.6;
            margin: 10px 0;
        }
        .email-body a {
            color: #4CAF50;
            text-decoration: none;
        }
        .email-body a:hover {
            text-decoration: underline;
        }
        .email-footer {
            text-align: center;
            background-color: #f4f4f4;
            color: #777777;
            padding: 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
        <img src="{{ asset('chatcord_logo.ico') }}" alt="Chatcord Logo" style="max-width: 100px; width: 100%; max-height: 100px; height: auto;">

            <h1>New Comment Notification</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p>You have received a new comment on your post {{ "'" . $title . "'" }}:</p>

            <blockquote style="background: #f9f9f9; padding: 15px; margin: 20px 0; border-left: 5px solid #e8de1c;">
                <strong>Comment:</strong> {{ $body }}
            </blockquote>

            <p><strong>From:</strong> {{ $sender }}</p>

            <p>
                <a href="{{ $postUrl }}" style="display: inline-block; padding: 10px 20px; background: #4CAF50; color: white; border-radius: 4px; text-decoration: none;">
                    View Comment
                </a>
            </p>

            <p>Thank you for continually connecting like a cord!</p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>© {{ date('Y') }} Chatcord. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
