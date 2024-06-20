<!-- views/user/browseVideos.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse Videos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="grid-container">
        <h1>Browse Videos</h1>
        <table class="stack">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Release Year</th>
                    <th>Format</th>
                    <th>Copies</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($videos as $video): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($video['title']); ?></td>
                        <td><?php echo htmlspecialchars($video['genre']); ?></td>
                        <td><?php echo htmlspecialchars($video['release_year']); ?></td>
                        <td><?php echo htmlspecialchars($video['format']); ?></td>
                        <td><?php echo htmlspecialchars($video['copies']); ?></td>
                        <td><?php echo htmlspecialchars($video['price']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($video['image']); ?>" alt="Video Image" width="50"></td>
                        <td>
                            <form action="<?php echo BASE_URL; ?>/index.php?controller=user&action=rentVideo" method="post">
                                <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">
                                <input type="hidden" name="fee" value="<?php echo $video['price']; ?>">
                                <button type="submit" class="button small">Rent</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
