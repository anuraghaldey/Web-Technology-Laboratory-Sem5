<?php
$servername = "localhost";
$username = "root";
$password = "@NUrag5623";
$dbname = "mydb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Record
if (isset($_POST['add'])) {
    $userId = $_POST['userId'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $sql = "INSERT INTO Users1 (user_id, user_name, password) VALUES ('$userId', '$userName', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error adding record: " . $conn->error;
    }
}

// Update Password
if (isset($_POST['update'])) {
    $userIdToUpdate = $_POST['userIdToUpdate'];
    $newPassword = $_POST['newPassword'];

    $updateSql = "UPDATE Users1 SET password='$newPassword' WHERE user_id='$userIdToUpdate'";

    if ($conn->query($updateSql) === TRUE) {
        echo "Password updated successfully";

        // Retrieve and display updated record
        $result = $conn->query("SELECT * FROM Users1 WHERE user_id='$userIdToUpdate'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<p>Updated Record: User ID - {$row['user_id']}, User Name - {$row['user_name']}, Password - {$row['password']}</p>";
        } else {
            echo "<p>No record found after update.</p>";
        }
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>

<body>

    <h2>Add Record</h2>
    <form method="post">
        User ID: <input type="text" name="userId" required><br>
        User Name: <input type="text" name="userName" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" name="add" value="Add Record">
    </form>

    <h2>Update Password</h2>
    <form method="post">
        User ID to Update: <input type="text" name="userIdToUpdate" required><br>
        New Password: <input type="password" name="newPassword" required><br>
        <input type="submit" name="update" value="Update Password">
    </form>

</body>

</html>
