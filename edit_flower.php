<?php
include "db.php";

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("No flower ID provided.");
}

$id = $_GET['id'];

// Get the flower data
$query = "SELECT * FROM flowers WHERE id='$id'";
$result = mysqli_query($conn, $query);

// Check if query succeeded and row exists
if (!$result || mysqli_num_rows($result) == 0) {
    die("Flower not found.");
}

$row = mysqli_fetch_assoc($result);

// Update flower
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Check if a new image was uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "images/".$image);
    } else {
        // Keep old image
        $image = $row['image'];
    }

   $update = "UPDATE flowers 
           SET flower_name='$name', price='$price', description='$description', image='$image'
           WHERE id='$id'";
    mysqli_query($conn, $update);
    header("Location: view_flower.php");
    exit;
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
   <input type="text" name="name" value="<?= htmlspecialchars($row['flower_name'] ?? '') ?>" required
           style="width:100%; padding:10px; margin-bottom:10px;"><br>

    <label>Price</label><br>
    <input type="text" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required
           style="width:100%; padding:10px; margin-bottom:10px;"><br>

    <label>Description</label><br>
    <textarea name="description" style="width:100%; padding:10px; margin-bottom:10px;"><?php echo htmlspecialchars($row['description']); ?></textarea><br>

    <label>Current Image</label><br>
    <img src="images/<?php echo $row['image']; ?>" width="120" style="margin-bottom:10px;"><br>

    <label>Change Image (optional)</label><br>
    <input type="file" name="image" style="margin-bottom:15px;"><br>

    <button type="submit" name="update" class="btn">Update Flower</button>
  </form>
</div>

</body>
</html>
