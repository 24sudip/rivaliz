<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Enrollment Confirmation</title>
</head>
<body>
    <h1>Dear {{ $student->name }}</h1>
    <p>You have been successfully enrolled in the course: <strong>{{ $course->name }}</strong>.</p>
    <p>
        <strong>One-Click Login:</strong><br>
        <a href="{{ $signedLoginUrl }}">Click here to log in directly</a>
    </p>
    
    @if($password)
        <p><strong>Login Email:</strong> {{ $student->email }}</p>
        <p><strong>Your Password:</strong> {{ $password }}</p>
    @endif
    <p>
        Or login manually: <a href="{{ url('/login') }}">{{ url('/login') }}</a><br>
        View course details: <a href="{{ url('coursedetails/' . $course->id) }}">{{ url('coursedetails/' . $course->id) }}</a>
    </p>

    <p>Thank you for choosing our platform!</p>
    <p>Best regards,<br>Our Team</p>
</body>
</html>
