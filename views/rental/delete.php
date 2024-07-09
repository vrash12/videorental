<?php
session_start();
if ($_SESSION['user_role'] !== 'admin') {
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
    <title>Delete Rental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
<?php include 'navbar.php'; ?> <!-- Include the navbar file -->
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle">
            <div class="cell medium-8 large-6">
                <h1 class="text-center">Delete Rental</h1>
                <form action="<?php echo BASE_URL; ?>/index.php?controller=rental&action=delete" method="post">
                    <input type="hidden" name="id" value="<?php echo $rental['id']; ?>">
                    <p>Are you sure you want to delete this rental?</p>
                    <button type="submit" class="button alert">Delete</button>
                </form>
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
