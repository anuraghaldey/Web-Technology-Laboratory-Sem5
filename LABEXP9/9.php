<!DOCTYPE html>
<html>

<head>
    <title>Student Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Student Information</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="studName">Student Name:</label>
        <input type="text" name="studName" required><br>
        <label for="studDept">Department:</label>
        <input type="text" name="studDept" required><br>
        <label for="passingYear">Passing Year:</label>
        <input type="number" name="passingYear" required><br>
        <label>Class Grades:</label>
        <input type="radio" name="classGrades" value="First Class" required> First Class
        <input type="radio" name="classGrades" value="Second Class" required> Second Class
        <input type="radio" name="classGrades" value="Pass" required> Pass<br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="submit" name="display" value="Display">
    </form>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
            $studName = $_POST['studName'];
            $studDept = $_POST['studDept'];
            $passingYear = $_POST['passingYear'];
            $classGrades = $_POST['classGrades'];

            $sql = "INSERT INTO students (studName, studDept, passingYear, classGrades)
                    VALUES ('$studName', '$studDept', '$passingYear', '$classGrades')";

            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } elseif (isset($_POST['display'])) {
            $result = $conn->query("SELECT * FROM students");
            if ($result->num_rows > 0) {
                echo "<h2>Student Information</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Student Name</th><th>Department</th><th>Passing Year</th><th>Class Grades</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['studName'] . "</td>";
                    echo "<td>" . $row['studDept'] . "</td>";
                    echo "<td>" . $row['passingYear'] . "</td>";
                    echo "<td>" . $row['classGrades'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No records found.";
            }
        }
    }
    $conn->close();
    ?>
</body>

</html>