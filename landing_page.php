<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutoring Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff); /* Cool blue gradient */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.5s ease-out;
        }
        h1 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 20px;
            animation: slideIn 1s ease-out;
        }
        .button-container {
            margin: 20px 0;
        }
        button {
            background: #0072ff; /* Blue button color */
            border: none;
            color: white;
            padding: 15px 25px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            transition: background 0.3s, transform 0.3s;
        }
        button:hover {
            background: #005bb5; /* Darker blue on hover */
            transform: scale(1.05);
        }
        p {
            margin-top: 20px;
            font-size: 1.2em;
        }
        a {
            text-decoration: none;
            color: #0072ff; /* Blue link color */
            font-weight: bold;
            transition: color 0.3s;
        }
        a:hover {
            color: #005bb5; /* Darker blue on hover */
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Campus Connect</h1>
        <div class="button-container">
            <button onclick="window.location.href='mentor_register.php'">Mentor Registration</button>
            <button onclick="window.location.href='student_register.php'">Student Registration</button>
            <button onclick="window.location.href='book_session.php'">Book a Study Session</button>
            <button onclick="window.location.href='submit_feedback.php'">Submit Feedback</button>
        </div>
        <p><a href="student_dashboard.php">Go to Dashboard</a></p>
    </div>
</body>
</html>
