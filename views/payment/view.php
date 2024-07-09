<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Payments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle">
            <div class="cell medium-8 large-6">
                <h1 class="text-center">Your Payments</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Rental ID</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($payment['rental_id']); ?></td>
                                <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                                <td><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                                <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="text-center"><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=dashboard">Back to Dashboard</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
