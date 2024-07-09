<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Reports</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
    <style>
        .statistics-section {
            margin-bottom: 2em;
        }
        .button-section {
            margin-top: 2em;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="grid-container">
        <h1>Manage Reports</h1>

        <!-- Rental Statistics Section -->
        <div class="statistics-section">
            <h2>Rental Statistics</h2>
            <table class="hover">
                <thead>
                    <tr>
                        <th>Video Title</th>
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
        </div>

        <!-- Financial Statistics Section -->
        <div class="statistics-section">
            <h2>Financial Statistics</h2>
            <table class="hover">
                <thead>
                    <tr>
                        <th>Total Revenue</th>
                        <th>Total Rentals</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$<?php echo htmlspecialchars($financialStats['total_revenue']); ?></td>
                        <td><?php echo htmlspecialchars($financialStats['total_rentals']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- User Activity Reports Section -->
        <div class="statistics-section">
            <h2>User Activity Reports</h2>
            <table class="hover">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Total Rentals</th>
                        <th>Last Rental Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userActivityReports as $report): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($report['name']); ?></td>
                            <td><?php echo htmlspecialchars($report['email']); ?></td>
                            <td><?php echo htmlspecialchars($report['total_rentals']); ?></td>
                            <td><?php echo htmlspecialchars($report['last_rental_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Notification Buttons Section -->
        <div class="button-section">
            <h2>Send Notifications</h2>
            <form action="<?php echo BASE_URL; ?>/index.php?controller=admin&action=sendReturnReminderToUser" method="post" style="display: inline;">
                <label for="user_id">Select User:</label>
                <select name="user_id" id="user_id">
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="button">Send Return Reminder</button>
            </form>
            <form action="<?php echo BASE_URL; ?>/index.php?controller=admin&action=sendLateFeeAlertToUser" method="post" style="display: inline;">
                <label for="user_id">Select User:</label>
                <select name="user_id" id="user_id">
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="button">Send Late Fee Alert</button>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>
