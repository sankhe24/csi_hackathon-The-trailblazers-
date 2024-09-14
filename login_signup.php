<?php
session_start();

// Database connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "tutoring_platform";
$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Signup logic
if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $security_question = mysqli_real_escape_string($con, $_POST['security_question']);
    $security_answer = mysqli_real_escape_string($con, $_POST['security_answer']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into the database
    $sql = "INSERT INTO users (username, email, password, security_question, security_answer) 
            VALUES ('$username', '$email', '$hashed_password', '$security_question', '$security_answer')";

    if (mysqli_query($con, $sql)) {
        echo "Signup successful! You can now log in.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Login logic
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Start session and store user info
            $_SESSION['username'] = $username;
            header("Location: landing_page.php"); // Redirect after successful login
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No user found with that username!";
    }
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
            overflow: hidden;
        }
        .container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
            transition: transform 0.3s ease-in-out;
        }
        .container:hover {
            transform: scale(1.02);
        }
        h2 {
            text-align: center;
            color: #ff7e5f;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #ff7e5f;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #feb47b;
        }
        .link {
            text-align: center;
            margin-top: 15px;
        }
        .form-toggle {
            cursor: pointer;
            color: #ff7e5f;
            text-decoration: underline;
        }
        .form-toggle:hover {
            color: #feb47b;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container" id="loginContainer">
        <h2>Login</h2>
        <form method="POST" action="login_signup.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button class="btn" type="submit" name="login">Login</button>
        </form>
        <div class="link">
            <p>Don't have an account? <span class="form-toggle" onclick="toggleForm()">Signup here</span></p>
            <p><a href="forgot_password.php" style="color: #ff7e5f; text-decoration: underline;">Forgot Password?</a></p>
        </div>
    </div>

    <div class="container" id="signupContainer" style="display:none;">
        <h2>Signup</h2>
        <form method="POST" action="login_signup.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="security_question" placeholder="Security Question" required>
            <input type="text" name="security_answer" placeholder="Security Answer" required>
            <button class="btn" type="submit" name="signup">Signup</button>
        </form>
        <div class="link">
            <p>Already have an account? <span class="form-toggle" onclick="toggleForm()">Login here</span></p>
        </div>
    </div>

    <script>
        function toggleForm() {
            var loginForm = document.getElementById('loginContainer');
            var signupForm = document.getElementById('signupContainer');
            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                signupForm.style.display = 'none';
            } else {
                loginForm.style.display = 'none';
                signupForm.style.display = 'block';
            }
        }
    </script>
</body>
</html>
