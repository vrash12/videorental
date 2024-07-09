<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle">
            <div class="cell medium-6 large-4">
                <h1 class="text-center">Update Profile</h1>
                <form action="<?php echo BASE_URL; ?>/index.php?controller=user&action=updateProfile" method="post">
                    <div class="grid-container">
                        <div class="grid-x grid-padding-x">
                            <div class="medium-12 cell">
                                <label for="name">Name:
                                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="email">Email:
                                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="address">Address:
                                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="phone">Phone:
                                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="password">New Password:
                                    <input type="password" id="password" name="password">
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="confirm_password">Confirm Password:
                                    <input type="password" id="confirm_password" name="confirm_password">
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <button type="submit" class="button expanded">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="text-center"><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=dashboard">Back to Profile</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password && password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match.');
            }
        });
    </script>
</body>
</html>
