<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Video Rental System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .header {
            text-align: center;
            margin-top: 50px;
        }
        .video-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 30px;
        }
        .video-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 15px;
            width: 250px;
            text-align: center;
            padding: 15px;
        }
        .video-item img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .video-title {
            font-size: 1.25em;
            font-weight: bold;
            margin: 10px 0 5px;
        }
        .video-details {
            color: #666;
            margin-bottom: 10px;
        }
        .rent-button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 4px;
            margin-top: 10px;
        }
        .rent-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="grid-container">
        <div class="header">
            <h1>Welcome to the Video Rental System</h1>
            <p>Please <a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=login">login</a> or <a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=browseVideos">browse videos</a>.</p>
        </div>
        <h2 class="text-center">Available Videos</h2>
        <div class="video-grid">
            <?php foreach ($videos as $video): ?>
                <div class="video-item">
                    <img src="<?php echo htmlspecialchars($video['image']); ?>" alt="<?php echo htmlspecialchars($video['title']); ?>">
                    <div class="video-title"><?php echo htmlspecialchars($video['title']); ?></div>
                    <div class="video-details"><?php echo htmlspecialchars($video['genre']); ?> | <?php echo htmlspecialchars($video['release_year']); ?></div>
                    <div class="video-details">Price: $<?php echo htmlspecialchars($video['price']); ?></div>
                    <a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=rentVideo&video_id=<?php echo $video['id']; ?>" class="rent-button">Rent</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
