<?php
// send_message.php

// Simple confirmation page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Message Sent - BloomShop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fde8e8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .message-box {
      background: white;
      padding: 40px 50px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    }
    .message-box h2 {
      color: #ff5c5c;
      margin-bottom: 20px;
    }
    .message-box a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: white;
      background-color: #ff8c8c;
      padding: 12px 25px;
      border-radius: 6px;
      transition: background 0.3s;
    }
    .message-box a:hover {
      background-color: #ff5c5c;
    }
  </style>
</head>
<body>

<div class="message-box">
  <h2>Message Sent!</h2>
  <p>Thank you for contacting us. We will get back to you soon.</p>
  <a href="index.php">Back to Home</a>
</div>

</body>
</html>
