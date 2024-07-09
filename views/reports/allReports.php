<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Reports</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
<?php include 'navbar.php'; ?> <!-- Include the navbar file -->

<div class="grid-container">
    <div class="grid-x grid-padding-x align-center">
        <div class="cell medium-8 large-6">
            <h1 class="text-center">All Reports</h1>
            
            <!-- Inventory Status Report -->
            <h2>Inventory Status Report</h2>
            <table class="hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Release Year</th>
                        <th>Format</th>
                        <th>Copies</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($videos as $video): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($video['title']); ?></td>
                            <td><?php echo htmlspecialchars($video['genre']); ?></td>
                            <td><?php echo htmlspecialchars($video['release_year']); ?></td>
                            <td><?php echo htmlspecialchars($video['format']); ?></td>
                            <td><?php echo htmlspecialchars($video['copies']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Rental Statistics Report -->
            <h2>Rental Statistics Report</h2>
            <table class="hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Rental Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rentalStats as $stat): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($stat['title']); ?></td>
                            <td><?php echo htmlspecialchars($stat['rental_count']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- User Activity Report -->
            <h2>User Activity Report</h2>
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

            <!-- Financial Reports -->
            <h2>Financial Reports</h2>
            <table class="hover">
                <thead>
                    <tr>
                        <th>Total Revenue</th>
                        <th>Total Rentals</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($financialStats['total_revenue']); ?></td>
                        <td><?php echo htmlspecialchars($financialStats['total_rentals']); ?></td>
                    </tr>
                </tbody>
            </table>

            <p class="text-center"><a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=dashboard" class="button">Back to Dashboard</a></p>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
