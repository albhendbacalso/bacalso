<?php
include 'database.php';
$id = $_GET['id'];
$customer = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customers WHERE id='$id'"));

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    mysqli_query($conn,"UPDATE customers SET name='$name', email='$email' WHERE id='$id'");
    header("Location: customers.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Customer</title>
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
    <h1>Edit Customer</h1>
    <form method="POST">
        <label>Name</label>
        <input type="text" name="name" value="<?= $customer['name'];?>" required>
        <label>Email</label>
        <input type="email" name="email" value="<?= $customer['email'];?>" required>
        <button class="btn" name="submit" type="submit">Update Customer</button>
        <a class="btn" href="customers.php">Back</a>
    </form>
</div>

</body>
</html>
