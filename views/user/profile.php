<!-- views/user/profile.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle">
            <div class="cell medium-6 large-4">
                <h1 class="text-center">Profile</h1>
                <p>Welcome, <?php echo htmlspecialchars($user['name']); ?>. Here you can view and update your profile information.</p>
                <form action="<?php echo BASE_URL; ?>/index.php?controller=user&action=updateProfile" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    
                    <!-- Add more fields as needed -->
                    
                    <button type="submit" class="button">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
