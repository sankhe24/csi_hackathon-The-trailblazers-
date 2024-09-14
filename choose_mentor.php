<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "tutoring_platform";

$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['mentor_id'])) {
    $mentorId = $_GET['mentor_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get student details
        $studentName = mysqli_real_escape_string($con, $_POST['student_name']);
        $studentEmail = mysqli_real_escape_string($con, $_POST['student_email']);

        // Find the student ID by email
        $studentSql = "SELECT id FROM students WHERE email = '$studentEmail'";
        $studentResult = mysqli_query($con, $studentSql);

        if (mysqli_num_rows($studentResult) > 0) {
            $studentRow = mysqli_fetch_assoc($studentResult);
            $studentId = $studentRow['id'];

            // Insert into the sessions table
            $insertSessionSql = "INSERT INTO sessions (student_id, mentor_id) VALUES ('$studentId', '$mentorId')";

            if (mysqli_query($con, $insertSessionSql)) {
                echo "Mentor selected successfully!";
                header("Location: student_dashboard.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Student not found!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Mentor</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            animation: backgroundAnimation 10s ease-in-out infinite alternate;
        }

        @keyframes backgroundAnimation {
            0% {
                background: linear-gradient(to right, #74ebd5, #acb6e5);
            }
            100% {
                background: linear-gradient(to right, #ff758c, #ff7eb3);
            }
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .container:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #333;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #ff758c;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #ff758c;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ff7eb3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Choose Mentor</h1>
        <form action="" method="POST">
            <label for="student_name">Your Name:</label>
            <input type="text" name="student_name" required><br>

            <label for="student_email">Your Email:</label>
            <input type="email" name="student_email" required><br>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<?php mysqli_close($con); ?>
