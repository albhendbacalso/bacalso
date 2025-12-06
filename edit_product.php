<?php
include 'database.php';
$id = $_GET['id'];
$product = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM products WHERE id='$id'"));
$categories = mysqli_query($conn,"SELECT * FROM categories");

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];
    mysqli_query($conn,"UPDATE products SET name='$name', price='$price',stock='$stock', category_id='$category_id' WHERE id='$id'");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Product</title>
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
    <h1>Edit Product</h1>
    <form method="POST">
        <label>Name</label>
        <input type="text" name="name" value="<?= $product['name'];?>" required>

        <label>Price</label>
        <input type="number" name="price" step="0.01" value="<?= $product['price'];?>" required>
        <label>Stock</label>
        <input type="number" name="stock" step="0.01" value="<?= $product['stock'];?>" required>
        <label>Category</label>
        <select name="category_id" required>
            <?php while($cat=mysqli_fetch_assoc($categories)){ ?>
            <option value="<?= $cat['id'];?>" <?= $product['category_id']==$cat['id']?'selected':'';?>>
                <?= $cat['name'];?>
            </option>
            <?php } ?>
        </select>

        <button class="btn" name="submit" type="submit">Update Product</button>
        <a class="btn" href="index.php">Back</a>
    </form>
</div>

</body>
</html>
