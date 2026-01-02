<?php
include "db.php";

if (isset($_POST['save'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];

  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];

  move_uploaded_file($tmp, "images/".$image);

 $query = "INSERT INTO flowers (flower_name, price, description, image)
          VALUES ('$name', '$price', '$description', '$image')";

  mysqli_query($conn, $query);
  header("Location: view_flower.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Flower</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div class="header-inner">
    <div class="logo">🌸 BloomShop Admin</div>
  </div>
</header>

<div class="container">
  <h2 style="margin-top:40px;">Add New Flower</h2>

  <form method="post" enctype="multipart/form-data" style="margin-top:20px; max-width:400px;">
    <label>Flower Name</label><br>
    <input type="text" name="name" required style="width:100%; padding:10px; margin-bottom:10px;"><br>

    <label>Price</label><br>
    <input type="text" name="price" required style="width:100%; padding:10px; margin-bottom:10px;"><br>

    <label>Description</label><br>
    <textarea name="description" required style="width:100%; padding:10px; margin-bottom:10px;"></textarea><br>

    <label>Image</label><br>
    <input type="file" name="image" required style="margin-bottom:15px;"><br>

    <button type="submit" name="save" class="btn">Save Flower</button>
  </form>
</div>

</body>
</html>
