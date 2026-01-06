<?php
include "db.php";

$query = "SELECT * FROM flowers";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Flowers</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div class="header-inner">
    <div class="logo">🌸 BloomShop Admin</div>
    <nav class="main-nav">
      <ul>
        <li><a href="add_flower.php">Add Flower</a></li>
        <li><a href="view_flower.php">View Flowers</a></li>
        <li><a href="index.php">Website</a></li>
      </ul>
    </nav>
  </div>
</header>

<div class="container">
  <h2 style="margin-top:40px;">All Flowers</h2>

  <table style="width:100%; margin-top:20px; border-collapse:collapse; text-align:center;">
    <tr style="background:#fde8e8;">
      <th>Image</th>
      <th>Name</th>
      <th>Category</th>
      <th>Price</th>
      <th>Description</th>
      <th>Action</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr style="border-bottom:1px solid #ddd;">
        <td style="padding:10px;">
          <img src="images/<?php echo $row['image']; ?>" width="80" alt="<?php echo htmlspecialchars($row['flower_name']); ?>">
        </td>
        <td><?php echo htmlspecialchars($row['flower_name']); ?></td>
        <td><?php echo htmlspecialchars($row['category']); ?></td>
        <td>Rs <?php echo $row['price']; ?></td>
        <td><?php echo htmlspecialchars($row['description']); ?></td>
        <td>
          <a href="edit_flower.php?id=<?php echo $row['id']; ?>">Edit</a> |
          <a href="delete_flower.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this flower?')">Delete</a>
        </td>
      </tr>
    <?php } ?>

    <?php if(mysqli_num_rows($result) == 0) { ?>
      <tr>
        <td colspan="6" style="padding:20px;">No flowers found. Add some flowers first.</td>
      </tr>
    <?php } ?>
  </table>
</div>

</body>
</html>
