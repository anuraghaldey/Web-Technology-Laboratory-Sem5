<!DOCTYPE html>
<html>
<head>
    <title>PHP Array Display with User Input</title>
</head>
<body>

<h2>Array Display:</h2>
<form method="POST">
    Enter values for numeric array (comma-separated): <input type="text" name="numeric_input"><br>
    Enter key-value pairs for associative array (key1:value1,key2:value2,...): <input type="text" name="assoc_input"><br>
    Enter values for multidimensional array (comma-separated, format: name1,age1;name2,age2;...): <input type="text" name="multi_input"><br>
    <input type="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process the numeric array input
    $numericInput = $_POST['numeric_input'];
    $numericArray = explode(',', $numericInput);

    // Process the associative array input
    $assocInput = $_POST['assoc_input'];
    $assocArray = [];
    $pairs = explode(',', $assocInput);
    foreach ($pairs as $pair) {
        $keyValue = explode(':', $pair);
        $assocArray[$keyValue[0]] = $keyValue[1];
    }

    // Process the multidimensional array input
    $multiInput = $_POST['multi_input'];
    $persons = explode(';', $multiInput);
    $multidimensionalArray = [];
    foreach ($persons as $person) {
        list($name, $age) = explode(',', $person);
        $multidimensionalArray[] = ['name' => $name, 'age' => $age];
    }

    echo "<h3>Numeric Array:</h3>";
    echo "<ul>";
    foreach ($numericArray as $value) {
        echo "<li>$value</li>";
    }
    echo "</ul>";

    echo "<h3>Associative Array:</h3>";
    echo "<ul>";
    foreach ($assocArray as $key => $value) {
        echo "<li>$key: $value</li>";
    }
    echo "</ul>";

    echo "<h3>Multidimensional Array:</h3>";
    echo "<ul>";
    foreach ($multidimensionalArray as $index => $person) {
        echo "<li>Person " . ($index + 1) . ": <ul>";
        foreach ($person as $key => $value) {
            echo "<li>$key: $value</li>";
        }
        echo "</ul></li>";
    }
    echo "</ul>";
}
?>

</body>
</html>
