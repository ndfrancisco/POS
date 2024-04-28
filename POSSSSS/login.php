<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    
    <div class="login-container">
    <h1>POS and Inventory Management System</h1>
        <form id="login-form">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div class="checkbox-row">
                <input type="checkbox" id="remember-me" name="remember-me">
                <label for="remember-me">Remember Me</label>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            <button type="submit">Login</button>
        </form>
        <p id="error-message"></p>
    </div>
    <script src="script.js"></script>
</body>
</html>
