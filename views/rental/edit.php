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
    <title>Edit Rental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
<?php include 'navbar.php'; ?> <!-- Include the navbar file -->
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle">
            <div class="cell medium-8 large-6">
                <h1 class="text-center">Edit Rental</h1>
                <form action="<?php echo BASE_URL; ?>/index.php?controller=rental&action=edit" method="post">
                    <input type="hidden" name="id" value="<?php echo $rental['id']; ?>">
                    <div class="grid-container">
                        <div class="grid-x grid-padding-x">
                            <div class="medium-12 cell">
                                <label for="user_id">User:
                                    <select id="user_id" name="user_id" required>
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?php echo $user['id']; ?>" <?php echo ($user['id'] == $rental['user_id']) ? 'selected' : ''; ?>><?php echo $user['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="video_id">Video:
                                    <select id="video_id" name="video_id" required>
                                        <?php foreach ($videos as $video): ?>
                                            <option value="<?php echo $video['id']; ?>" <?php echo ($video['id'] == $rental['video_id']) ? 'selected' : ''; ?>><?php echo $video['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="rental_date">Rental Date:
                                    <input type="text" id="rental_date" name="rental_date" value="<?php echo $rental['rental_date']; ?>" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="due_date">Due Date:
                                    <input type="text" id="due_date" name="due_date" value="<?php echo $rental['due_date']; ?>" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="fee">Fee:
                                    <input type="text" id="fee" name="fee" value="<?php echo $rental['fee']; ?>" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <button type="submit" class="button expanded">Update Rental</button>
                            </div>
                        </div>
                    </div>
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
