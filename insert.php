<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "inventory_management");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Capture form data
    $product_name = htmlspecialchars($_POST['product_name']);
    $description = htmlspecialchars($_POST['description']);
    $price = (float)$_POST['price'];
    $quantity = (int)$_POST['quantity'];

    // Insert query with prepared statement
    $stmt = $conn->prepare("INSERT INTO products (product_name, description, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $product_name, $description, $price, $quantity);

    if ($stmt->execute()) {
        echo "<p>New product added successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form method="POST" action="insert.php">
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <td><label for="product_name">Product Name:</label></td>
                <td><input type="text" id="product_name" name="product_name" required></td>
            </tr>
            <tr>
                <td><label for="description">Description:</label></td>
                <td><textarea id="description" name="description" required></textarea></td>
            </tr>
            <tr>
                <td><label for="price">Price:</label></td>
                <td><input type="number" id="price" name="price" step="0.01" required></td>
            </tr>
            <tr>
                <td><label for="quantity">Quantity:</label></td>
                <td><input type="number" id="quantity" name="quantity" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit">Add Product</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
