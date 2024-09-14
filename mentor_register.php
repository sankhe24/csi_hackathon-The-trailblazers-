<?php  
$server = "localhost";
$username = "root";
$password = "";
$dbname = "tutoring_platform";

// Create connection
$con = mysqli_connect($server, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['student_id'])) {
    $studentId = $_POST['student_id'];
    $mentorId = $_POST['mentor_id'];
    $sessionTime = $_POST['session_time'];

    // Check if student_id exists in the students table
    $checkStudentSql = "SELECT id FROM students WHERE id = '$studentId'";
    $studentResult = mysqli_query($con, $checkStudentSql);

    if (mysqli_num_rows($studentResult) > 0) {
        // If student exists, insert session record
        $sql = "INSERT INTO sessions (student_id, mentor_id, session_time) VALUES ('$studentId', '$mentorId', '$sessionTime')";

        if (mysqli_query($con, $sql)) {
            echo "Session booked successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        echo "Error: Student ID does not exist.";
    }

    // Close the connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Study Session</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #f5f7fa, #c3cfe2); /* Soft gradient background */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header h1 {
            color: #4a90e2;
            font-size: 2.5em;
            animation: bounceIn 1s ease-out;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        #book-session {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-out;
            width: 100%;
            max-width: 400px;
        }
        #book-session h2 {
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
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.3);
            outline: none;
        }
        button {
            width: 100%;
            padding: 15px;
            background: #4a90e2; /* Blue color */
            border: none;
            color: white;
            font-size: 1.2em;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }
        button:hover {
            background: #357abd; /* Darker blue on hover */
            transform: scale(1.05);
        }
        @keyframes bounceIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); }
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<header>
    <h1>Peer-to-Peer Tutoring and Mentorship Platform</h1>
</header>
<main>
    <section id="book-session"> 
        <h2>Book a Study Session</h2>
        <form action="book_session.php" method="POST">
            <input type="text" name="student_id" placeholder="Student ID" required>
            <input type="text" name="mentor_id" placeholder="Mentor ID" required>
            <input type="text" name="session_time" placeholder="Session Time (YYYY-MM-DD HH:MM:SS)" required>
            <button type="submit">Book Session</button>
        </form>
    </section>
</main>
</body>
</html>
