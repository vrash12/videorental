<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card {
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .card-title {
            font-size: 24px;
            font-weight: bold;
        }
        .card-link {
            display: block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .card-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="grid-container">
        <h1>Admin Dashboard</h1>
        <p>Welcome to the admin dashboard. Here you can manage users, videos, rentals, payments, and more.</p>
        
        <div class="grid-x grid-margin-x small-up-1 medium-up-2 large-up-3">
            <div class="cell">
                <div class="card">
                    <div class="card-icon">
                        <i class="fi-torsos-all"></i>
                    </div>
                    <div class="card-title">Manage Users</div>
                    <a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageUsers" class="card-link">Go to Users</a>
                </div>
            </div>
            <div class="cell">
                <div class="card">
                    <div class="card-icon">
                        <i class="fi-video"></i>
                    </div>
                    <div class="card-title">Manage Videos</div>
                    <a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageVideos" class="card-link">Go to Videos</a>
                </div>
            </div>
            <div class="cell">
                <div class="card">
                    <div class="card-icon">
                        <i class="fi-graph-trend"></i>
                    </div>
                    <div class="card-title">View Reports</div>
                    <a href="<?php echo BASE_URL; ?>/index.php?controller=reports&action=allReports" class="card-link">Go to Reports</a>
                </div>
            </div>
        </div>

</body>
</html>
