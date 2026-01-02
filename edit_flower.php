<?php
include "db.php";

$id = $_GET['id'];

$query = "SELECT * FROM flowers WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

  $name = $_POST['name'];
  $price = $_POST['price'];

  if ($_FILES['image']['name'] != "") {
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "images/".$image);

    $update = "UPDATE flowers 
               SET name='$name', price='$price', image='$image' 
               WHERE id='$id'";
  } else {
    $update = "UPDATE flowers 
               SET name='$name', price='$price' 
               WHERE id='$id'";
  }

  mysqli_query($conn, $update);
  header("Location: view_flower.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Flower</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div class="header-inner">
    <div class="logo">🌸 BloomShop Admin</div>
  </div>
</header>

<div class="container">
  <h2 style="margin-top:40px;">Edit Flower</h2>

  <form method="post" enctype="multipart/form-data" style="margin-top:20px; max-width:400px;">

    <label>Flower Name</label><br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required
           style="width:100%; padding:10px; margin-bottom:10px;"><br>

    <label>Price</label><br>
    <input type="text" name="price" value="<?php echo $row['price']; ?>" required
           style="width:100%; padding:10px; margin-bottom:10px;"><br>

    <label>Current Image</label><br>
    <img src="images/<?php echo $row['image']; ?>" width="120" style="margin-bottom:10px;"><br>

    <label>Change Image (optional)</label><br>
    <input type="file" name="image" style="margin-bottom:15px;"><br>

    <button type="submit" name="update" class="btn">Update Flower</button>

  </form>
</div>

</body>
</html>
