<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: register.php");
    exit();
}

$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "registration_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_SESSION['username'];
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    $sql = "SELECT password FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($current_password, $row['password'])) {
            if ($new_password === $confirm_new_password) {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_sql = "UPDATE users SET password='$hashed_new_password' WHERE username='$user'";
                if ($conn->query($update_sql) === TRUE) {
                    $success = "Password has been reset successfully";
                } else {
                    $error = "Error updating password: " . $conn->error;
                }
            } else {
                $error = "New password and Re-Enter new password should be the same.";
            }
        } else {
            $error = "Current password is not the same with the old password.";
        }
    } else {
        $error = "User not found.";
    }
}

$user_sql = "SELECT * FROM users WHERE username='$user'";
$user_result = $conn->query($user_sql);
$user_data = $user_result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Information Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .container input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error, .success {
            text-align: center;
            margin-bottom: 10px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .logout {
            text-align: right;
            margin-bottom: 20px;
        }
        .logout a {
            text-decoration: none;
            color: #4CAF50;
        }
        .logout a:hover {
            color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logout">
            <a href="logout.php">Log-out</a>
        </div>
        <h2>User Information Form</h2>
        <p><strong>Welcome</strong> <?php echo $user_data['first_name'] . " " . $user_data['middle_name'] . " " . $user_data['last_name']; ?></p>
        <p><strong>Birthday:</strong> <?php echo $user_data['birthday']; ?></p>
        <p><strong>Contact Details</strong></p>
        <p><strong>Email:</strong> <?php echo $user_data['email']; ?></p>
        <p><strong>Contact:</strong> <?php echo $user_data['contact_number']; ?></p>

        <h2>RESET PASSWORD</h2>
        
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <label for="current_password">Enter Current Password:</label>
            <input type="password" id="current_password" name="current_password" required>

            <label for="new_password">Enter New Password:</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_new_password">Re-Enter New Password:</label>
            <input type="password" id="confirm_new_password" name="confirm_new_password" required>

            <input type="submit" name="reset_password" value="Reset Password">
        </form>
    </div>
</body>
</html>
