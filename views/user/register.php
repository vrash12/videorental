<!-- views/user/register.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/css/foundation.min.css">
</head>
<body>
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center-middle" style="height: 100vh;">
            <div class="cell medium-6 large-4">
                <h1 class="text-center">Register</h1>
                <form action="<?php echo BASE_URL; ?>/index.php?controller=user&action=register" method="post">
                    <div class="grid-container">
                        <div class="grid-x grid-padding-x">
                            <div class="medium-12 cell">
                                <label for="name">Name:
                                    <input type="text" id="name" name="name" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="email">Email:
                                    <input type="email" id="email" name="email" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="password">Password:
                                    <input type="password" id="password" name="password" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <label for="confirm_password">Confirm Password:
                                    <input type="password" id="confirm_password" name="confirm_password" required>
                                </label>
                            </div>
                            <div class="medium-12 cell">
                                <button type="submit" class="button expanded">Register</button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="text-center"><a href="<?php echo BASE_URL; ?>/index.php?controller=user&action=login">Login</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.4/js/foundation.min.js"></script>
</body>
</html>
