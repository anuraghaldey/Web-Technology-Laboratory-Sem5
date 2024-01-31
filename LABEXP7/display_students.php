<?php
// Replace these credentials with your actual database details
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "@NUrag5623";
$dbName = "mydb";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Display First class students from CSE department
$sql = "SELECT * FROM students WHERE studDept = 'CSE' AND classGrades = 'First Class'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>First Class Students from CSE Department:</h2>";
    echo "<table border='1'><tr><th>Roll No</th><th>Student Name</th><th>Department</th><th>Passing Year</th><th>Class Grades</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['rollNo']}</td><td>{$row['studName']}</td><td>{$row['studDept']}</td><td>{$row['passingYear']}</td><td>{$row['classGrades']}</td></tr>";
    }

    echo "</table>";
} else {
    echo "No First Class students from CSE department found.";
}

$conn->close();
?>
