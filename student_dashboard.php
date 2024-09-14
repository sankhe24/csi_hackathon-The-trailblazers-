<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "tutoring_platform";

$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$searchQuery = "";
if (isset($_POST['search'])) {
    $searchQuery = mysqli_real_escape_string($con, $_POST['search']);
}

$sql = "SELECT * FROM mentors WHERE name LIKE '%$searchQuery%' OR expertise LIKE '%$searchQuery%' OR availability LIKE '%$searchQuery%'";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 300px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .mentor-list {
            margin: 0 auto;
            width: 80%;
            border-collapse: collapse;
        }
        .mentor-list th, .mentor-list td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .mentor-list th {
            background-color: #5cb85c;
            color: white;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

<h1>Dashboard</h1>

<div class="search-container">
    <form method="POST" action="student_dashboard.php">
        <input type="text" name="search" placeholder="Search by mentor's name, expertise, or availability" value="<?php echo $searchQuery; ?>">
        <button type="submit">Search</button>
    </form>
</div>

<?php
if (mysqli_num_rows($result) > 0) {
    echo "<table class='mentor-list'>";
    echo "<tr><th>Name</th><th>Email</th><th>Expertise</th><th>Availability</th><th>Actions</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['expertise'] . "</td>";
        echo "<td>" . $row['availability'] . "</td>";
        echo "<td>";
        echo "<div class='action-buttons'>";
        // Button to choose a mentor
        echo "<a href='choose_mentor.php?mentor_id=" . $row['id'] . "'><button>Choose Mentor</button></a>";
        // Button to view mentees
        echo "<a href='view_mentees.php?mentor_id=" . $row['id'] . "'><button>View Mentees</button></a>";
        
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No mentors found. Try adjusting your search terms.</p>";
}

mysqli_close($con);
?>

</body>
</html>
