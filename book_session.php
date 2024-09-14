<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "tutoring_platform";

$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['student_id'])) {
    $studentId = $_POST['student_id'];
    $mentorId = $_POST['mentor_id'];
    $sessionTime = $_POST['session_time'];

    // Check if the mentor has reached the maximum number of students (25)
    $checkLimit = "SELECT student_count FROM mentors WHERE id='$mentorId'";
    $result = mysqli_query($con, $checkLimit);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $studentCount = $row['student_count'];

        if ($studentCount >= 25) {
            // Mentor has reached the maximum number of students
            echo "Sorry, this mentor is not available for more students.";
        } else {
            // Proceed to book the session and increment the student count
            $sql = "INSERT INTO sessions (student_id, mentor_id, session_time) VALUES ('$studentId', '$mentorId', '$sessionTime')";

            if (mysqli_query($con, $sql)) {
                // Update the student_count in the mentors table
                $updateCount = "UPDATE mentors SET student_count = student_count + 1 WHERE id='$mentorId'";
                mysqli_query($con, $updateCount);

                echo "Session booked successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
    } else {
        echo "Error fetching mentor data.";
    }

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
            background: linear-gradient(120deg, #a8c0ff, #fbc2eb); /* Gradient background */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            animation: backgroundMove 10s linear infinite;
        }
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        header h1 {
            color: #ffffff;
            font-size: 2.5em;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
            animation: fadeIn 2s ease-in;
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
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            animation: bounceIn 1s ease-out;
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
            transition: all 0.3s ease;
        }
        input:focus {
            border-color: #ff6b6b;
            box-shadow: 0 0 8px rgba(255, 107, 107, 0.4);
            outline: none;
        }
        button {
            width: 100%;
            padding: 15px;
            background: #ff6b6b; /* Coral red */
            border: none;
            color: white;
            font-size: 1.2em;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        button:hover {
            background: #ff4757; /* Darker coral red on hover */
            transform: scale(1.05);
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes bounceIn {
            0% { transform: scale(0.5); opacity: 0; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); }
        }
        @keyframes backgroundMove {
            0% { background-position: 0% 0%; }
            100% { background-position: 100% 100%; }
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
