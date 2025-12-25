{{--<!DOCTYPE html>
<html>
<head>
    <title>Payment Failed</title>
</head>
<body>
    <h1>❌ Payment Failed</h1>
    <p>{{ $message }}</p>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>

    <style>
        body {
            background: #fff5f5;
            font-family: "Segoe UI", Tahoma, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .failed-card {
            background: #fff;
            padding: 40px;
            width: 420px;
            text-align: center;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            animation: fadeIn 0.5s ease;
        }

        .failed-icon {
            font-size: 70px;
            color: #dc2626;
            animation: pop 0.4s ease;
        }

        h1 {
            margin-top: 15px;
            font-size: 28px;
            color: #b91c1c;
        }

        .details {
            margin-top: 25px;
            font-size: 16px;
            color: #444;
            line-height: 1.6;
        }

        .btn-back {
            margin-top: 30px;
            display: inline-block;
            background: #dc2626;
            color: white;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            transition: 0.2s ease;
        }

        .btn-back:hover {
            background: #b91c1c;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pop {
            0% { transform: scale(0.6); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>

    <div class="failed-card">
        <div class="failed-icon">❌</div>
        <h1>Payment Failed</h1>

        <div class="details">
            <p><strong>Message:</strong> {{ $message }}</p>
        </div>

        <!--<a href="/" class="btn-back">Try Again / Go Home</a>-->
    </div>

</body>
</html>
