<?php
session_start();

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

$error = "";
$success = "";

// Registration logic
if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];

    if ($password !== $confirm_password) {
        $error = "Password and confirm password are not the same";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, middle_name, last_name, username, password, birthday, email, contact_number)
        VALUES ('$first_name', '$middle_name', '$last_name', '$username', '$hashed_password', '$birthday', '$email', '$contact_number')";

        if ($conn->query($sql) === TRUE) {
            $success = "New record created successfully";
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: user_info.php");
            exit();
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "No user found with that username";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration and Login Form</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>My Personal Information</h2>

        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="middle_name">Middle Name</label>
            <input type="text" id="middle_name" name="middle_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <label for="birthday">Birthday</label>
            <input type="date" id="birthday" name="birthday" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="contact_number">Contact Number</label>
            <input type="text" id="contact_number" name="contact_number" required>

            <input type="submit" name="register" value="Register">
        </form>

        <h2>Log-In Form</h2>

        <form action="" method="post">
            <label for="login_username">Username</label>
            <input type="text" id="login_username" name="login_username" required>

            <label for="login_password">Password</label>
            <input type="password" id="login_password" name="login_password" required>

            <input type="submit" name="login" value="Login">
        </form>
    </div>
</body>
</html>
