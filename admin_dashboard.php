<?php
session_start();
include("db_connect.php");

// Check if the user is an admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}

// Fetch all users and food items
$users_query = "SELECT * FROM users";
$foods_query = "SELECT * FROM foods";
$users_result = $conn->query($users_query);
$foods_result = $conn->query($foods_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard | HUNGER STAR</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="container">
      <h1 class="logo">🍔 HUNGER STAR - Admin Dashboard</h1>
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="faq.html">FAQ</a></li>
          <li><a href="menu.php">Menu</a></li>
          <li><a href="admin_dashboard.php" class="active">Dashboard</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="dashboard-section">
    <div class="container">
      <h2>Welcome, Admin!</h2>
      
      <h3>Users</h3>
      <table class="admin-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($user = $users_result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $user["id"]; ?></td>
              <td><?php echo $user["name"]; ?></td>
              <td><?php echo $user["email"]; ?></td>
              <td><?php echo $user["role"]; ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

      <h3>Food Items</h3>
      <table class="admin-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($food = $foods_result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $food["id"]; ?></td>
              <td><?php echo $food["name"]; ?></td>
              <td><?php echo $food["description"]; ?></td>
              <td><?php echo "$" . $food["price"]; ?></td>
              <td>
                <a href="edit_food.php?id=<?php echo $food['id']; ?>">Edit</a> |
                <a href="delete_food.php?id=<?php echo $food['id']; ?>">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 HUNGER STAR - All rights reserved</p>
  </footer>
</body>
</html>
