<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rental History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
    <style>
        .history-table {
            width: 100%;
            margin-top: 20px;
        }
        .history-table th, .history-table td {
            padding: 10px;
            text-align: left;
        }
        .history-table th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?> 
    <div class="grid-container">
        <h1 class="text-center">Rental History</h1>
        <?php if (!empty($rentals)): ?>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Rental Date</th>
                        <th>Due Date</th>
                        <th>Returned</th>
                        <th>Fee</th>
                        <th>Payment Amount</th>
                        <th>Payment Date</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rentals as $rental): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rental['title']); ?></td>
                            <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>
                            <td><?php echo htmlspecialchars($rental['due_date']); ?></td>
                            <td><?php echo $rental['returned'] ? 'Yes' : 'No'; ?></td>
                            <td><?php echo htmlspecialchars($rental['fee']); ?></td>
                            <td><?php echo htmlspecialchars($rental['amount'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($rental['payment_date'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($rental['method'] ?? 'N/A'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">You have no rental history at the moment.</p>
        <?php endif; ?>
        <p class="text-center"><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=dashboard" class="button">Back to Dashboard</a></p>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
