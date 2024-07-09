<!-- views/admin/profile.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
<?php include 'navbar.php'; ?> 
    <div class="grid-container">
        <h1 class="text-center">Admin Profile</h1>
        <form action="<?php echo BASE_URL; ?>/index.php?controller=admin&action=profile" method="post">
            <label for="name">Name:
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </label>
            <label for="email">Email:
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </label>
            <label for="address">Address:
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">
            </label>
            <label for="phone">Phone:
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
            </label>
            <label for="password">Password (leave blank if not changing):
                <input type="password" id="password" name="password">
            </label>
            <button type="submit" class="button expanded">Update Profile</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
