<!-- views/admin/dashboard.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle">
            <div class="cell medium-8 large-6">
                <h1 class="text-center">Admin Dashboard</h1>
                <p>Welcome to the admin dashboard. Here you can manage users, videos, rentals, payments, and more.</p>
                <ul class="menu vertical">
                    <li><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageUsers">Manage Users</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageVideos">Manage Videos</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageRentals">Manage Rentals</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=reports">View Reports</a></li>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
