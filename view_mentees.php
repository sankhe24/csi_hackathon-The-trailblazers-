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

    // Fetch mentees linked to this mentor
    $sql = "SELECT students.name, students.email 
            FROM students 
            INNER JOIN sessions ON students.id = sessions.student_id 
            WHERE sessions.mentor_id = '$mentorId'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h1>Mentees for Mentor ID: $mentorId</h1>";
        echo "<table>";
        echo "<tr><th>Name</th><th>Email</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p class='no-mentees'>No mentees found for this mentor.</p>";
    }
} else {
    echo "<p class='no-id'>No mentor ID provided!</p>";
}

mysqli_close($con);
?>

<a href="student_dashboard.php"><button class="back-btn">Back to Dashboard</button></a>

<style>
    /* General Styling */
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to right, #74ebd5, #ACB6E5);
        color: #333;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
        animation: backgroundAnimation 10s ease-in-out infinite alternate;
    }

    @keyframes backgroundAnimation {
        0% { background: linear-gradient(to right, #74ebd5, #ACB6E5); }
        100% { background: linear-gradient(to right, #ff758c, #ff7eb3); }
    }

    h1 {
        color: #fff;
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        animation: fadeInDown 1s ease-in-out;
    }

    @keyframes fadeInDown {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    table {
        width: 60%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        color: #333;
    }

    th {
        background-color: #74ebd5;
        color: #fff;
        font-size: 1.2rem;
        text-transform: uppercase;
    }

    tr:hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s ease;
    }

    .back-btn {
        background-color: #74ebd5;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        margin-top: 20px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .back-btn:hover {
        background-color: #ff758c;
        transform: scale(1.05);
    }

    .no-mentees, .no-id {
        color: #fff;
        font-size: 1.5rem;
        text-align: center;
        margin-top: 20px;
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
</style>
