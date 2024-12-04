<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "inventory_management");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    description TEXT,
    price FLOAT NOT NULL,
    quantity INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'products' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
