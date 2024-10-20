<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }

        .code {
            font-size: 24px;
            font-weight: bold;
            color: #c13584;
            /* Example color */
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #c13584;
            /* Example color */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Password Reset Verification Code</h1>
        <p>Hi there,</p>
        <p>We received a request to reset your password. Please use the verification code below to reset your password:
        </p>
        <div class="code">{{ $verification_code }}</div>
        <p>If you did not request a password reset, please ignore this email.</p>
        <p>For security reasons, do not share this code with anyone.</p>
        <div class="footer">
            <p>&copy; {{ now()->format('Y-m-d H:i:s') }} Blog. All rights reserved.</p>
            <p>Thank you for using our service!</p>
        </div>
    </div>
</body>

</html>