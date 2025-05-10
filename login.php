<?php
session_start();
include("db_connect.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $_SESSION["user_id"] = $row["id"];
        $_SESSION["user_email"] = $row["email"];
        $_SESSION["role"] = $row["role"];

        if ($row["role"] == "admin") {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: index.html");
        }
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | HUNGER STAR</title>
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
          <li><a href="menu.php">Menu</a></li>
          <li><a href="login.php" class="active">Login</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="form-section">
    <div class="container">
      <h2>Login</h2>
      <form method="POST" action="login.php" class="form-box">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p class="error"><?php echo $error; ?></p>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
      </form>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 HUNGER STAR - All rights reserved</p>
  </footer>
</body>
</html>
