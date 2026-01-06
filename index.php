<?php
include "db.php"; // Database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BloomShop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Fixed Header */
    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        z-index: 999;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .header-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
    }
    .main-nav ul {
        display: flex;
        gap: 25px;
        list-style: none;
    }
    .main-nav ul li a {
        text-decoration: none;
        color: #333;
        font-weight: 600;
        transition: color 0.3s;
    }
    .main-nav ul li a:hover {
        color: #ff6b6b;
    }
    
    /* Add top padding so content not hide behind fixed header */
    body {
        padding-top: 80px; /* adjust based on header height */
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    /* Clickable cards hover effect */
    .card, .product {
        cursor: pointer;
        transition: transform 0.2s;
    }
    .card:hover, .product:hover {
        transform: scale(1.05);
    }

    /* Contact Us section styling */
    #contact {
      padding: 50px 0;
      background-color: #fde8e8;
    }
    #contact h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    /* Make images cover full card/container */
    .product-image, .card-image {
        width: 100%;
        height: 200px; 
        overflow: hidden;
        border-radius: 6px;
    }
    .product-image img, .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover; 
    }

    #contact form {
      max-width: 500px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    /* Headings styling */
    #categories {
       margin-bottom: 60px;
       text-align: center;
       margin-top: 40px;
    }

    #categories h2, .featured h2 {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 10px;
        font-size: 28px;
    }

    .featured p, #categories p {
        text-align: center;
        margin-bottom: 20px;
        color: #555;
    }

    #contact input, #contact textarea {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      width: 100%;
      font-family: inherit;
    }
    #contact button {
      padding: 12px;
      background-color: #ff8c8c;
      border: none;
      color: white;
      font-weight: 600;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s;
    }
    #contact button:hover {
      background-color: #ff5c5c;
    }

    /* Smooth scroll behavior */
    html {
      scroll-behavior: smooth;
    }

    /* Modal styling */
    .modal {
      display: none; 
      position: fixed; 
      z-index: 100; 
      padding-top: 60px; 
      left: 0;
      top: 0;
      width: 100%; 
      height: 100%; 
      overflow: auto; 
      background-color: rgba(0,0,0,0.6);
    }

    .modal-content {
      background-color: #fff;
      margin: auto;
      padding: 20px;
      border-radius: 10px;
      width: 90%;
      max-width: 500px;
      text-align: center;
      position: relative;
    }

    .modal-content img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 6px;
    }

    .modal-content .close {
      position: absolute;
      top: 10px;
      right: 15px;
      color: #333;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }

    .modal-content .close:hover {
      color: #ff5c5c;
    }

  </style>
</head>
<body>

<header>
  <div class="header-inner">
    <div class="logo">🌸 BloomShop</div>
    <nav class="main-nav">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#categories">Categories</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- HERO SECTION -->
<section class="hero">
  <div class="container hero-inner">
    <div class="hero-text">
      <span class="tag">Fresh Flowers</span>
      <h1>Beautiful Flowers for <span class="accent">Every Occasion</span></h1>
      <p>Fresh and lovely flowers for gifting and decoration.</p>
    </div>
    <div class="hero-image">
      <img src="images/main.jpg" alt="Fresh Flowers">
    </div>
  </div>
</section>

<!-- FEATURED FLOWERS SECTION -->
<section class="featured">
  <div class="container">
    <h2>Featured Flowers</h2>
    <div class="grid product-grid">
      <?php
      $featQuery = "SELECT * FROM flowers WHERE price >= 4500 ORDER BY id DESC";
      $featResult = mysqli_query($conn, $featQuery);
      if(mysqli_num_rows($featResult) > 0){
          while($flower = mysqli_fetch_assoc($featResult)) { ?>
            <div class="product" onclick="openModal('<?php echo $flower['image']; ?>','<?php echo htmlspecialchars($flower['flower_name']); ?>','<?php echo htmlspecialchars($flower['category']); ?>','Rs <?php echo $flower['price']; ?>','<?php echo htmlspecialchars($flower['description'] ?? 'Beautiful flower.'); ?>')">
              <div class="product-image">
                <img src="images/<?php echo $flower['image']; ?>" alt="<?php echo htmlspecialchars($flower['flower_name']); ?>">
              </div>
              <h4><?php echo htmlspecialchars($flower['flower_name']); ?></h4>
              <p class="price">Rs <?php echo $flower['price']; ?></p>
            </div>
      <?php }
      } else {
          echo "<p>No featured flowers available.</p>";
      }
      ?>
    </div>
  </div>
</section>

<!-- CATEGORIES SECTION -->
<section id="categories">
  <div class="container">
    <h2>Shop by Category</h2>
    <div class="grid categories-grid">
      <?php
      $catQuery = "SELECT * FROM flowers WHERE price < 4500 ORDER BY category";
      $catResult = mysqli_query($conn, $catQuery);
      if(mysqli_num_rows($catResult) > 0){
          while($cat = mysqli_fetch_assoc($catResult)) { ?>
            <div class="card" onclick="openModal('<?php echo $cat['image']; ?>','<?php echo htmlspecialchars($cat['flower_name']); ?>','<?php echo htmlspecialchars($cat['category']); ?>','Rs <?php echo $cat['price']; ?>','<?php echo htmlspecialchars($cat['description'] ?? 'Beautiful flower.'); ?>')">
              <div class="card-image">
                <img src="images/<?php echo $cat['image']; ?>" alt="<?php echo htmlspecialchars($cat['flower_name']); ?>">
              </div>
              <h3><?php echo htmlspecialchars($cat['flower_name']); ?></h3>
              <p><?php echo htmlspecialchars($cat['category']); ?></p>
              <p class="price">Rs <?php echo $cat['price']; ?></p>
            </div>
      <?php }
      } else {
          echo "<p>No categories found.</p>";
      }
      ?>
    </div>
  </div>
</section>

<!-- CONTACT SECTION -->
<section id="contact" style="background-color:#fff8f8; padding:20px 0;">
  <div class="container" style="max-width:600px; margin:0 auto; text-align:center;">
    <h2 style="font-size:32px; margin-bottom:15px; color:#ff6b6b;">Contact Us</h2>
    <p style="margin-bottom:40px; color:#555; font-size:16px;">
      Have questions or want to place a custom order? Fill out the form below and we'll get back to you!
    </p>
    <form method="POST" action="send_message.php" style="display:flex; flex-direction:column; gap:20px;">
      <input type="text" name="name" placeholder="Your Name" required 
             style="padding:12px; border:1px solid #ccc; border-radius:8px; font-size:16px;">
      <input type="email" name="email" placeholder="Your Email" required
             style="padding:12px; border:1px solid #ccc; border-radius:8px; font-size:16px;">
      <textarea name="message" rows="6" placeholder="Your Message" required
                style="padding:12px; border:1px solid #ccc; border-radius:8px; font-size:16px;"></textarea>
      <button type="submit" name="submit" 
              style="padding:15px; background:linear-gradient(45deg,#ff8c8c,#ff5c5c); border:none; color:white; 
                     font-weight:600; font-size:16px; border-radius:8px; cursor:pointer; transition:0.3s;">
        Send Message
      </button>
    </form>
  </div>
</section>

<!-- Flower Detail Modal -->
<div id="flowerModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <img id="modalImage" src="" alt="Flower Image">
    <h3 id="modalName"></h3>
    <p id="modalCategory"></p>
    <p id="modalPrice"></p>
    <p id="modalDescription"></p>
  </div>
</div>

<footer class="site-footer">
  <p>© 2025 BloomShop. All Rights Reserved.</p>
</footer>

<script>
// Modal JS
function openModal(image, name, category, price, description) {
    document.getElementById('modalImage').src = 'images/' + image;
    document.getElementById('modalName').innerText = name;
    document.getElementById('modalCategory').innerText = category;
    document.getElementById('modalPrice').innerText = price;
    document.getElementById('modalDescription').innerText = description;
    document.getElementById('flowerModal').style.display = 'block';
}

// Close modal
document.querySelector('.modal .close').onclick = function() {
    document.getElementById('flowerModal').style.display = 'none';
}

// Close when click outside modal
window.onclick = function(event) {
  if(event.target == document.getElementById('flowerModal')){
    document.getElementById('flowerModal').style.display = 'none';
  }
}
</script>

</body>
</html>
