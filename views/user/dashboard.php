<?php
if ($_SESSION['user_role'] !== 'user') {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
<?php include 'navbar.php'; ?> <!-- Include the navbar file -->
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle">
            <div class="cell medium-8 large-6">
                <h1 class="text-center">User Dashboard</h1>
                
                <h2>Your Rentals</h2>
                <?php if (!empty($rentals)): ?>
                    <form action="<?php echo BASE_URL; ?>/index.php?controller=payment&action=payAllRentals" method="post">
                        <table class="hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Rental Date</th>
                                    <th>Due Date</th>
                                    <th>Fee</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total_fee = 0;
                                foreach ($rentals as $rental): 
                                    $total_fee += $rental['fee'];
                                ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($rental['title']); ?></td>
                                        <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>
                                        <td><?php echo htmlspecialchars($rental['due_date']); ?></td>
                                        <td><?php echo htmlspecialchars($rental['fee']); ?></td>
                                        <td><a href="<?php echo BASE_URL; ?>/index.php?controller=payment&action=createPayment&rental_id=<?php echo $rental['id']; ?>" class="button">Pay Now</a></td>
                                        <input type="hidden" name="rental_ids[]" value="<?php echo $rental['id']; ?>">
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="grid-x grid-padding-x align-center">
                            <div class="cell medium-6 large-4">
                                <h3>Total Fee: <?php echo $total_fee; ?></h3>
                                <label for="payment_method">Payment Method:
                                    <select id="payment_method" name="payment_method" required>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="debit_card">Debit Card</option>
                                    </select>
                                </label>
                                <button type="submit" class="button expanded">Pay All Rentals</button>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <p>You have no rentals at the moment.</p>
                <?php endif; ?>

                <a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=browseVideos" class="button">Browse Videos</a>

                <h2>Your Payments</h2>
                <?php if (!empty($payments)): ?>
                    <table class="hover">
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
                <?php else: ?>
                    <p>You have no payments at the moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>
