<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <h1>Display Students</h1>

    <button onclick="displayStudents()">Show First Class Students from CSE</button>

    <script>
        function displayStudents() {
            // Use AJAX to call the PHP script
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Display the result in a div
                    document.getElementById("result").innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", "display_students.php", true);
            xhr.send();
        }
    </script>

    <div id="result"></div>

</body>

</html>
