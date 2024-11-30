<!-- resources/views/emails/comment-notification.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>New Comment Notification</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>You have received a new comment on your post.</p>
    <p><strong>Comment:</strong> {{ $body }}</p>
    <p><strong>From:</strong> {{ $sender }}</p>
    <p><a href="{{ $postUrl }}">Click here</a> to view the comment.</p>
    <p>Thank you!</p>
</body>
</html>
