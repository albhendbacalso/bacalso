<?php
include 'database.php';
$order_id = $_GET['id'];

// Fetch order with customer name
$order = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT o.*, c.name AS customer_name FROM orders o
     LEFT JOIN customers c ON o.customer_id = c.id
     WHERE o.id='$order_id'"));

// Fetch order items with product details
$items = mysqli_query($conn,
    "SELECT oi.*, p.name, p.price FROM order_items oi
     LEFT JOIN products p ON oi.product_id = p.id
     WHERE oi.order_id='$order_id'");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>View Order</title>
</head>
<body>

<div class="navbar">
    <div class="nav-left"><h2>Inventory System</h2></div>
    <div class="nav-right">
        <a href="index.php">Products</a>
        <a href="manage_categories.php">Categories</a>
        <a href="customers.php">Customers</a>
        <a href="orders.php">Orders</a>
    </div>
</div>

<div class="container">
    <h1>Order #<?= $order['id'];?></h1>
    <p><strong>Customer:</strong> <?= $order['customer_name'];?></p>

    <table class="table">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
        <?php $total = 0; while($row=mysqli_fetch_assoc($items)){ 
            $subtotal = $row['price']*$row['quantity']; 
            $total += $subtotal;
        ?>
        <tr>
            <td><?= $row['name'];?></td>
            <td><?= $row['quantity'];?></td>
            <td>₱<?= $row['price'];?></td>
            <td>₱<?= $subtotal;?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>₱<?= $total;?></strong></td>
        </tr>
    </table>

    <a class="btn" href="orders.php">Back</a>
</div>

</body>
</html>
