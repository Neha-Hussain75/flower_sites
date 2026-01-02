<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div class="header-inner">
    <div class="logo">🌸 BloomShop Admin Panel</div>

    <nav class="main-nav">
      <ul>
        <li><a href="admin.php">Dashboard</a></li>
        <li><a href="add_flower.php">Add Flower</a></li>
        <li><a href="view_flower.php">View Flowers</a></li>
        <li><a href="index.php">Website</a></li>
      </ul>
    </nav>
  </div>
</header>

<div class="container">
  <h2 style="margin-top:40px;">Admin Dashboard</h2>
  <p style="margin-top:10px;">Yahan se aap flowers manage kar sakti hain</p>

  <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:20px; margin-top:30px;">

    <div class="card">
      <h3>Add Flower</h3>
      <p>New flower add karo</p>
      <a href="add_flower.php" class="btn">Open</a>
    </div>

    <div class="card">
      <h3>View Flowers</h3>
      <p>Flowers list dekho</p>
      <a href="view_flower.php" class="btn">Open</a>
    </div>

  </div>
</div>

</body>
</html>
