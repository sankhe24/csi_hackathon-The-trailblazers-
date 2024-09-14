<?php 
$server = "localhost";
$username = "root";
$password = "";
$dbname = "tutoring_platform";

$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['session_id'])) {
    $sessionId = $_POST['session_id'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    $sql = "INSERT INTO feedback (session_id, rating, feedback) VALUES ('$sessionId', '$rating', '$feedback')";

    if (mysqli_query($con, $sql)) {
        echo "Feedback submitted successfully";
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
    <title>Submit Feedback</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(45deg, #ff9a9e, #fad0c4); /* Gradient background */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            animation: backgroundMove 15s ease infinite;
        }
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        header h1 {
            color: #fff;
            font-size: 2.5em;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
            animation: fadeIn 2s ease-in;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        #feedback {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
            animation: slideIn 1s ease-out;
            width: 100%;
            max-width: 400px;
        }
        #feedback h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.8em;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            transition: all 0.3s ease;
        }
        input:focus, textarea:focus {
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
        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
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
        <section id="feedback"> 
            <h2>Give Feedback</h2>
            <form action="submit_feedback.php" method="POST">
                <input type="text" name="session_id" placeholder="Session ID" required>
                <input type="number" name="rating" placeholder="Rating (1-5)" min="1" max="5" required>
                <textarea name="feedback" placeholder="Feedback" required></textarea>
                <button type="submit">Submit Feedback</button>
            </form>
        </section>
    </main>
</body>
</html>
