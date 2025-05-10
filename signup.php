<?php
session_start();
include("db_connect.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];

    if ($password != $password_confirm) {
        $error = "Passwords do not match.";
    } else {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $error = "Email is already registered.";
        } else {
            $insert_query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'user')";
            if ($conn->query($insert_query) === TRUE) {
                $_SESSION["user_email"] = $email;
                header("Location: login.php");
                exit();
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up | HUNGER STAR</title>
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
          <li><a href="login.php">Login</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="form-section">
    <div class="container">
      <h2>Sign Up</h2>
      <form method="POST" action="signup.php" class="form-box">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirm" placeholder="Confirm Password" required>
        <button type="submit">Sign Up</button>
        <p class="error"><?php echo $error; ?></p>
        <p>Already have an account? <a href="login.php">Login</a></p>
      </form>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 HUNGER STAR - All rights reserved</p>
  </footer>
</body>
</html>
