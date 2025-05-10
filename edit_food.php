<?php
session_start();
include("db_connect.php");

// Check if the user is an admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}

$food_id = $_GET['id'];
$query = "SELECT * FROM foods WHERE id = '$food_id'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $food = $result->fetch_assoc();
} else {
    header("Location: admin_dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    $update_query = "UPDATE foods SET name = '$name', description = '$description', price = '$price' WHERE id = '$food_id'";

    if ($conn->query($update_query) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Food Item | HUNGER STAR</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="container">
      <h1 class="logo">🍔 HUNGER STAR - Edit Food Item</h1>
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="faq.html">FAQ</a></li>
          <li><a href="menu.php">Menu</a></li>
          <li><a href="admin_dashboard.php">Dashboard</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="form-section">
    <div class="container">
      <h2>Edit Food Item</h2>
      <form method="POST" action="edit_food.php?id=<?php echo $food_id; ?>" class="form-box">
        <input type="text" name="name" value="<?php echo $food['name']; ?>" required>
        <input type="text" name="description" value="<?php echo $food['description']; ?>" required>
        <input type="number" name="price" value="<?php echo $food['price']; ?>" required>
        <button type="submit">Update Food</button>
        <p class="error"><?php echo $error; ?></p>
      </form>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 HUNGER STAR - All rights reserved</p>
  </footer>
</body>
</html>
