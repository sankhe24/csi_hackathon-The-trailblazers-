<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "tutoring_platform";
$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle password reset
if (isset($_POST['reset_password'])) {
    $username = $_POST['username'];
    $security_answer = $_POST['security_answer'];
    $new_password = $_POST['new_password'];

    // Verify the security answer
    $sql = "SELECT * FROM users WHERE username='$username' AND security_answer='$security_answer'";
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        // If the security answer is correct, update the password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE users SET password='$hashed_password' WHERE username='$username'";

        if (mysqli_query($con, $update_sql)) {
            echo "Password reset successful!";
        } else {
            echo "Error updating password: " . mysqli_error($con);
        }
    } else {
        echo "Incorrect username or security answer!";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Forgot Password</h2>
    <form action="forgot_password.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="security_answer" placeholder="Security Answer" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <button type="submit" name="reset_password">Reset Password</button>
    </form>
</div>

</body>
</html>
