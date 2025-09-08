<!DOCTYPE html>
<html>
<head>
    <title>User Credentials</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .container { margin: 50px; }
        h2 { text-align: center; }
        .info { margin-top: 30px; font-size: 16px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>KRISHNA MINERALS Login Credentials</h2>
        <div class="info">
            <p><strong>Username:</strong> {{ $username }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
            <p><strong>Joining:</strong> {{ $created_at }}</p>
        </div>
        <p>Please keep this information safe.</p>
    </div>
</body>
</html>
