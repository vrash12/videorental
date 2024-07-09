<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rent Video</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
<?php include 'navbar.php'; ?> 
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle" style="height: 100vh;">
            <div class="cell medium-6 large-4">
                <h1 class="text-center">Rent Video</h1>
                <?php if ($video): ?>
                    <h3><?php echo htmlspecialchars($video['title']); ?></h3>
                    <p><?php echo htmlspecialchars($video['genre']); ?> | <?php echo htmlspecialchars($video['release_year']); ?></p>
                    <form action="<?php echo BASE_URL; ?>/index.php?controller=user&action=rentVideo" method="post">
                        <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">
                        <div class="grid-container">
                            <div class="grid-x grid-padding-x">
                                <div class="medium-12 cell">
                                    <label for="rental_days">Rental Days:
                                        <input type="number" id="rental_days" name="rental_days" min="1" required>
                                    </label>
                                </div>
                                <div class="medium-12 cell">
                                    <label for="format">Format:
                                        <select id="format" name="format" required>
                                            <option value="dvd">DVD</option>
                                            <option value="bluray">Blu-ray</option>
                                            <option value="digital">Digital</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="medium-12 cell">
                                    <button type="submit" class="button expanded">Rent Video</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <p>Video not found.</p>
                <?php endif; ?>
                <p class="text-center"><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=browseVideos">Back to Browse</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
