<?php
include 'database.php';
$id = $_GET['id'];
$category = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM categories WHERE id='$id'"));

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    mysqli_query($conn,"UPDATE categories SET name='$name', description='$description' WHERE id='$id'");
    header("Location: manage_categories.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Category</title>
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
    <h1>Edit Category</h1>
    <form method="POST">
        <label>Name</label>
        <input type="text" name="name" value="<?= $category['name'];?>" required>
        <label>Description</label>
        <textarea name="description" required><?= $category['description'];?></textarea>
        <button class="btn" name="submit" type="submit">Update Category</button>
        <a class="btn" href="manage_categories.php">Back</a>
    </form>
</div>

</body>
</html>
