{{--<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
</head>
<body>
    <h1>✅ Payment Successful</h1>
    <p><strong>Amount:</strong> {{ $amount }} BDT</p>
    <p><strong>Transaction ID:</strong> {{ $trxID }}</p>
    <p><strong>Payment ID:</strong> {{ $paymentID }}</p>
    <p>{{ $message }}</p>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>

    <style>
        body {
            background: #f0f7ff;
            font-family: "Segoe UI", Tahoma, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .success-card {
            background: #fff;
            padding: 40px;
            width: 420px;
            text-align: center;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            animation: fadeIn 0.5s ease;
        }

        .success-icon {
            font-size: 70px;
            color: #22c55e;
            animation: pop 0.4s ease;
        }

        h1 {
            margin-top: 15px;
            font-size: 28px;
            color: #1d4ed8;
        }

        .details {
            text-align: left;
            margin-top: 25px;
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }

        .details strong {
            color: #111;
        }

        .btn-back {
            margin-top: 30px;
            display: inline-block;
            background: #1d4ed8;
            color: white;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            transition: 0.2s ease;
        }

        .btn-back:hover {
            background: #163bb6;
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

    <div class="success-card">
        <div class="success-icon">✔️</div>
        <h1>Payment Successful</h1>

        <div class="details">
            <p><strong>Amount:</strong> {{ $amount }} BDT</p>
            <p><strong>Transaction ID:</strong> {{ $trxID }}</p>
            <p><strong>Payment ID:</strong> {{ $paymentID }}</p>
            <p><strong>Message:</strong> {{ $message }}</p>
        </div>

        <!--<a href="/" class="btn-back">Go to Home</a>-->
    </div>

</body>
</html>
