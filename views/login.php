<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
    <div class="grid-container">
        <h1>Login</h1>
        <form action="<?php echo BASE_URL; ?>/index.php?controller=user&action=login" method="post">
            <label for="email">Email:
                <input type="email" id="email" name="email" required>
            </label>
            <label for="password">Password:
                <input type="password" id="password" name="password" required>
            </label>
            <button type="submit" class="button">Login</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
