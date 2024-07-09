<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse Videos</title>
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
        .search-form {
            margin-bottom: 20px;
        }
        .search-form input, .search-form select {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Include the navbar file -->
    <?php include 'navbar.php'; ?>
    <div class="grid-container">
        <h1>Browse Videos</h1>
        <form class="search-form" action="<?php echo BASE_URL; ?>/index.php" method="get">
            <input type="hidden" name="controller" value="user">
            <input type="hidden" name="action" value="browseVideos">
            <input type="text" name="search" placeholder="Search by title" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <select name="genre">
                <option value="">All Genres</option>
                <option value="Action" <?php if ($genre == 'Action') echo 'selected'; ?>>Action</option>
                <option value="Comedy" <?php if ($genre == 'Comedy') echo 'selected'; ?>>Comedy</option>
                <option value="Drama" <?php if ($genre == 'Drama') echo 'selected'; ?>>Drama</option>
                <!-- Add more genres as needed -->
            </select>
            <input type="number" name="release_year" placeholder="Release Year" value="<?php echo htmlspecialchars($releaseYear); ?>">
            <button type="submit" class="button">Search</button>
        </form>
        <div class="video-grid">
            <?php foreach ($videos as $video): ?>
                <div class="video-item">
                    <img src="<?php echo htmlspecialchars($video['image']); ?>" alt="<?php echo htmlspecialchars($video['title']); ?>">
                    <h3><?php echo htmlspecialchars($video['title']); ?></h3>
                    <p><?php echo htmlspecialchars($video['genre']); ?> | <?php echo htmlspecialchars($video['release_year']); ?></p>
                    <p>Price: $<?php echo htmlspecialchars($video['price']); ?></p>
                    <a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=rentVideo&video_id=<?php echo $video['id']; ?>" class="button small">Rent</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
