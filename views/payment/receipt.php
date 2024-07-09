<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle">
            <div class="cell medium-8 large-6">
                <h1 class="text-center">Payment Receipt</h1>
                <table>
                    <tr>
                        <th>Payment ID</th>
                        <td><?php echo htmlspecialchars($payment['id']); ?></td>
                    </tr>
                    <tr>
                        <th>User ID</th>
                        <td><?php echo htmlspecialchars($payment['user_id']); ?></td>
                    </tr>
                    <tr>
                        <th>Rental ID</th>
                        <td><?php echo htmlspecialchars($payment['rental_id']); ?></td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                    </tr>
                    <tr>
                        <th>Payment Date</th>
                        <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                    </tr>
                </table>
                <p class="text-center"><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=dashboard">Back to Dashboard</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
