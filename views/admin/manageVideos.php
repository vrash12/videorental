<!-- views/admin/manageVideos.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Videos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="grid-container">
        <h1>Manage Videos</h1>
        
        <?php if (isset($mode) && $mode === 'list'): ?>
            <a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageVideos&mode=add" class="button">Add Video</a>
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
                                <a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageVideos&mode=edit&id=<?php echo $video['id']; ?>" class="button small">Edit</a>
                                <a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageVideos&mode=delete&id=<?php echo $video['id']; ?>" class="button small alert">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        
        <?php elseif (isset($mode) && $mode === 'add'): ?>
            <h2>Add Video</h2>
            <form action="<?php echo BASE_URL; ?>/index.php?controller=admin&action=addVideo" method="post" enctype="multipart/form-data">
                <label for="title">Title:
                    <input type="text" id="title" name="title" required>
                </label>
                <label for="genre">Genre:
                    <input type="text" id="genre" name="genre" required>
                </label>
                <label for="release_year">Release Year:
                    <input type="number" id="release_year" name="release_year" required>
                </label>
                <label for="format">Format:
                    <select id="format" name="format" required>
                        <option value="DVD">DVD</option>
                        <option value="Blu-ray">Blu-ray</option>
                        <option value="Digital">Digital</option>
                    </select>
                </label>
                <label for="copies">Copies:
                    <input type="number" id="copies" name="copies" required>
                </label>
                <label for="price">Price:
                    <input type="number" step="0.01" id="price" name="price" required>
                </label>
                <label for="image">Image:
                    <input type="file" id="image" name="image" accept="image/*">
                </label>
                <button type="submit" class="button expanded">Add Video</button>
            </form>
        
        <?php elseif (isset($mode) && $mode === 'edit'): ?>
            <h2>Edit Video</h2>
            <form action="<?php echo BASE_URL; ?>/index.php?controller=admin&action=editVideo" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($video['id']); ?>">
                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($video['image']); ?>">
                <label for="title">Title:
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($video['title']); ?>" required>
                </label>
                <label for="genre">Genre:
                    <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($video['genre']); ?>" required>
                </label>
                <label for="release_year">Release Year:
                    <input type="number" id="release_year" name="release_year" value="<?php echo htmlspecialchars($video['release_year']); ?>" required>
                </label>
                <label for="format">Format:
                    <select id="format" name="format" required>
                        <option value="DVD" <?php echo $video['format'] == 'DVD' ? 'selected' : ''; ?>>DVD</option>
                        <option value="Blu-ray" <?php echo $video['format'] == 'Blu-ray' ? 'selected' : ''; ?>>Blu-ray</option>
                        <option value="Digital" <?php echo $video['format'] == 'Digital' ? 'selected' : ''; ?>>Digital</option>
                    </select>
                </label>
                <label for="copies">Copies:
                    <input type="number" id="copies" name="copies" value="<?php echo htmlspecialchars($video['copies']); ?>" required>
                </label>
                <label for="price">Price:
                    <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($video['price']); ?>" required>
                </label>
                <label for="image">Image:
                    <input type="file" id="image" name="image" accept="image/*">
                </label>
                <button type="submit" class="button expanded">Update Video</button>
            </form>
        
        <?php elseif (isset($mode) && $mode === 'delete'): ?>
            <h2>Delete Video</h2>
            <p>Are you sure you want to delete the video "<?php echo htmlspecialchars($video['title']); ?>"?</p>
            <form action="<?php echo BASE_URL; ?>/index.php?controller=admin&action=deleteVideo" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($video['id']); ?>">
                <button type="submit" class="button alert">Delete Video</button>
                <a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageVideos" class="button">Cancel</a>
            </form>
        <?php endif; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
