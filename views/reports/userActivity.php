<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Activity Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
<?php include 'navbar.php'; ?> <!-- Include the navbar file -->
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center">
            <div class="cell medium-8 large-6">
                <h1 class="text-center">User Activity Report</h1>
                <table class="hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Rental Count</th>
                            <th>Total Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userActivities as $activity): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($activity['name']); ?></td>
                                <td><?php echo htmlspecialchars($activity['email']); ?></td>
                                <td><?php echo htmlspecialchars($activity['rental_count']); ?></td>
                                <td><?php echo htmlspecialchars($activity['total_spent']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="text-center"><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=dashboard" class="button">Back to Dashboard</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
