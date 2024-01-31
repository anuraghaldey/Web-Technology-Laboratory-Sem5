<!DOCTYPE html>
<html>

<head>
    <title>Shopping Application</title>
    <style>
        .action-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h2>Add Item</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        Item Name: <input type="text" name="itemName" required>
        Quantity: <input type="number" name="itemQuantity" required>
        <button type="submit" name="add_item" class="action-button" style="background-color: #4CAF50;">Add</button>
    </form>

    <h2>Update Item</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        Item ID: <input type="number" name="itemID" required>
        New Item Name: <input type="text" name="newItemName" required>
        New Quantity: <input type="number" name="newItemQuantity" required>
        <button type="submit" name="update_item" class="action-button" style="background-color: #008CBA;">Update</button>
    </form>

    <h2>Delete Item</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        Item ID: <input type="number" name="itemID" required>
        <button type="submit" name="delete_item" class="action-button" style="background-color: #f44336;">Delete</button>
    </form>

    <h2>Items</h2>
    <table border="1">
        <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Quantity</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shopping_app";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['add_item'])) {
                $itemName = $_POST['itemName'];
                $itemQuantity = $_POST['itemQuantity'];
                $sql = "INSERT INTO items (itemName, itemQuantity) VALUES ('$itemName', '$itemQuantity')";
                $conn->query($sql);
            } elseif (isset($_POST['update_item'])) {
                $itemID = $_POST['itemID'];
                $newItemName = $_POST['newItemName'];
                $newItemQuantity = $_POST['newItemQuantity'];
                $sql = "UPDATE items SET itemName='$newItemName', itemQuantity='$newItemQuantity' WHERE itemID=$itemID";
                $conn->query($sql);
            } elseif (isset($_POST['delete_item'])) {
                $itemID = $_POST['itemID'];
                $sql = "DELETE FROM items WHERE itemID=$itemID";
                $conn->query($sql);
            }
        }

        $sql = "SELECT * FROM items";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['itemID'] . "</td>";
                echo "<td>" . $row['itemName'] . "</td>";
                echo "<td>" . $row['itemQuantity'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No items available</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>

</html>