<?php
include 'database.php';

// Fetch orders with customer name and total items
$query = "SELECT o.id, c.name AS customer_name, COUNT(oi.id) AS total_items
          FROM orders o
          LEFT JOIN customers c ON o.customer_id = c.id
          LEFT JOIN order_items oi ON o.id = oi.order_id
          GROUP BY o.id, c.name
          ORDER BY o.id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Orders</title>
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
    <h1>Orders</h1>
    <a class="btn" href="create_order.php">Create Order</a>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Total Items</th>
            <th>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?= $row['id'];?></td>
            <td><?= $row['customer_name'];?></td>
            <td><?= $row['total_items'];?></td>
            <td>
                <a class="btn-edit" href="view_order.php?id=<?= $row['id'];?>">View</a>
                <a class="btn-delete" href="delete_order.php?id=<?= $row['id'];?>" 
                   onclick="return confirm('Delete this order?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
