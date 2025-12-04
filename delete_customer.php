<?php
include 'database.php';

$id = $_GET['id'];
$conn->query("DELETE FROM customers WHERE id=$id");

header("Location: customers.php");
exit();
?>
