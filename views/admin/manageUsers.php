<!-- views/admin/manageUsers.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="grid-container">
        <h1>Manage Users</h1>
        
        <?php if (isset($mode) && $mode === 'list'): ?>
            <a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageUsers&mode=add" class="button">Add User</a>
            <table class="stack">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                            <td><?php echo htmlspecialchars($user['address']); ?></td>
                            <td><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageUsers&mode=edit&id=<?php echo $user['id']; ?>" class="button small">Edit</a>
                                <a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageUsers&mode=delete&id=<?php echo $user['id']; ?>" class="button small alert">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        
        <?php elseif (isset($mode) && $mode === 'add'): ?>
            <h2>Add User</h2>
            <form action="<?php echo BASE_URL; ?>/index.php?controller=admin&action=addUser" method="post">
                <label for="name">Name:
                    <input type="text" id="name" name="name" required>
                </label>
                <label for="email">Email:
                    <input type="email" id="email" name="email" required>
                </label>
                <label for="password">Password:
                    <input type="password" id="password" name="password" required>
                </label>
                <label for="role">Role:
                    <select id="role" name="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </label>
                <label for="address">Address:
                    <input type="text" id="address" name="address">
                </label>
                <label for="phone">Phone:
                    <input type="text" id="phone" name="phone">
                </label>
                <button type="submit" class="button expanded">Add User</button>
            </form>
        
        <?php elseif (isset($mode) && $mode === 'edit'): ?>
            <h2>Edit User</h2>
            <form action="<?php echo BASE_URL; ?>/index.php?controller=admin&action=editUser" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                <label for="name">Name:
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </label>
                <label for="email">Email:
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </label>
                <label for="role">Role:
                    <select id="role" name="role" required>
                        <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </label>
                <label for="address">Address:
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">
                </label>
                <label for="phone">Phone:
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                </label>
                <button type="submit" class="button expanded">Update User</button>
            </form>
        
        <?php elseif (isset($mode) && $mode === 'delete'): ?>
            <h2>Delete User</h2>
            <p>Are you sure you want to delete the user "<?php echo htmlspecialchars($user['name']); ?>"?</p>
            <form action="<?php echo BASE_URL; ?>/index.php?controller=admin&action=deleteUser" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                <button type="submit" class="button alert">Delete User</button>
                <a href="<?php echo BASE_URL; ?>/index.php?controller=admin&action=manageUsers" class="button">Cancel</a>
            </form>
        <?php endif; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
