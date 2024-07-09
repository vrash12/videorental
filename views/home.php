<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Video Rental System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
    <style>
        .video-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .video-item {
            margin: 15px;
            width: 200px;
            text-align: center;
        }
        .video-item img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="grid-container">
        <h1>Welcome to the Video Rental System</h1>
        <p>Please <a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=login">login.</p>
        <h2>Available Videos</h2>
        <div class="video-grid">
            <?php foreach ($videos as $video): ?>
                <div class="video-item">
                    <img src="<?php echo htmlspecialchars($video['image']); ?>" alt="<?php echo htmlspecialchars($video['title']); ?>">
                    <h3><?php echo htmlspecialchars($video['title']); ?></h3>
                    <p><?php echo htmlspecialchars($video['genre']); ?> | <?php echo htmlspecialchars($video['release_year']); ?></p>
                    <p>Price: $<?php echo htmlspecialchars($video['price']); ?></p>
                   
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
