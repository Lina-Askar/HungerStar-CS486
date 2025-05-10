<?php include("db_connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HUNGER STAR | Menu</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="container">
      <h1 class="logo">🍔 HUNGER STAR</h1>
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="faq.html">FAQ</a></li>
          <li><a href="menu.php" class="active">Menu</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="menu-section">
    <div class="container">
      <h2>Our Menu</h2>
      <div class="menu-grid">
        <?php
        $sql = "SELECT * FROM foods";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "<div class='food-card'>";
            echo "<img src='assets/images/" . $row["image"] . "' alt='" . $row["name"] . "'>";
            echo "<h3>" . $row["name"] . "</h3>";
            echo "<p>" . $row["description"] . "</p>";
            echo "<p class='price'>$" . $row["price"] . "</p>";
            echo "</div>";
          }
        } else {
          echo "<p>No food items available.</p>";
        }
        ?>
      </div>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 HUNGER STAR - All rights reserved</p>
  </footer>
</body>
</html>
