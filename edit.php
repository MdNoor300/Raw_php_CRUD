<?php
$conn = new mysqli("localhost", "root", "", "inventory_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE products SET product_name='$product_name', description='$description', price=$price, quantity=$quantity WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: display.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <label>Product Name:</label>
        <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required><br><br>
        <label>Description:</label>
        <textarea name="description" required><?php echo $product['description']; ?></textarea><br><br>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required><br><br>
        <label>Quantity:</label>
        <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required><br><br>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
