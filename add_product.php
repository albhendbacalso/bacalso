<?php
include 'database.php';
$categories = mysqli_query($conn,"SELECT * FROM categories");

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    mysqli_query($conn,"INSERT INTO products (name, price, category_id) 
        VALUES ('$name','$price','$category_id')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Add Product</title>
</head>
<body>

<div class="navbar">
    <div class="nav-left"><h2>Inventory System</h2></div>
    <div class="nav-right">
        <a href="index.php">Products</a>
        <a href="manage_categories.php">Categories</a>
        <a href="customers.php">Customers</a>
        <a href="view_orders.php">Orders</a>
    </div>
</div>

<div class="container">
    <h1>Add Product</h1>
    <form method="POST">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Price</label>
        <input type="number" name="price" step="0.01" required>

        <label>Category</label>
        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php while($cat=mysqli_fetch_assoc($categories)){ ?>
            <option value="<?= $cat['id'];?>"><?= $cat['name'];?></option>
            <?php } ?>
        </select>

        <button class="btn" name="submit" type="submit">Add Product</button>
        <a class="btn" href="index.php">Back</a>
    </form>
</div>

</body>
</html>
