<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "tutoring_platform";

$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";

    if (mysqli_query($con, $sql)) {
        echo "Student registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4); /* Gradient background */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        header h1 {
            color: #fff;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: slideIn 1s ease-out;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        #student-registration {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            animation: popUp 0.8s ease-out;
            width: 100%;
            max-width: 400px;
        }
        #student-registration h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.8em;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            transition: all 0.3s ease;
        }
        input:focus {
            border-color: #ff6f61;
            box-shadow: 0 0 8px rgba(255, 111, 97, 0.4);
            outline: none;
        }
        button {
            width: 100%;
            padding: 15px;
            background: #ff6f61; /* Coral color */
            border: none;
            color: white;
            font-size: 1.2em;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        button:hover {
            background: #e55b52; /* Darker coral on hover */
            transform: scale(1.05);
        }
        @keyframes slideIn {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes popUp {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>
<header>
    <h1>Peer-to-Peer Tutoring and Mentorship Platform</h1>
</header>
<main>
    <section id="student-registration">
        <h2>Student Registration</h2>
        <form action="student_register.php" method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Register as Student</button>
        </form>
    </section>
</main>
</body>
</html>
