<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make a Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle" style="height: 100vh;">
            <div class="cell medium-6 large-4">
                <h1 class="text-center">Make a Payment</h1>
                <form action="<?php echo BASE_URL; ?>/index.php?controller=payment&action=createPayment" method="post">
                    <input type="hidden" name="rental_id" value="<?php echo htmlspecialchars($rental_id); ?>">
                    <div class="grid-container">
                        <div class="grid-x grid-padding-x">
                            <div class="medium-12 cell">
                                <label for="amount">Amount:
                                    <input type="number" id="amount" name="amount" step="0.01" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="payment_method">Payment Method:
                                    <select id="payment_method" name="payment_method" required>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="debit_card">Debit Card</option>
                                    </select>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <button type="submit" class="button expanded">Pay Now</button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="text-center"><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=dashboard">Back to Dashboard</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
