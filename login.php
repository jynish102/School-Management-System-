<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login – SchoolMS</title>
  <link href="CSS/login.css" rel="stylesheet" />
</head>

<body>

 

  <div class="login-container">
    <!-- Left Form -->
    <div class="form-section">
      <img src="IMG/Logo3.png" class="logo" alt="School Logo">
      <h2>Login to your account</h2>
      <?php if (isset($_GET['msg']) && $_GET['msg'] === 'registered'): ?>
        <div class="alert alert-success text-center">
          Registration successful. Please log in.
        </div>
      <?php endif; ?>

      <form action="Action/login-valid.php" method="POST">
        <input type="text" name="email" autofocus placeholder="Username or Email">
        <input type="password" name="password" placeholder="Password">
        
        <button type="submit">Login</button>
      </form>

      <!-- ✅ Added Register Section -->
      <p class="register-link">
        Don’t have an account?
        <a href="register.php">Register here</a>
      </p>
    </div>

    <!-- Right Illustration -->
    <div class="image-section">
      <img src="IMG/illustration.png" alt="Students Illustration">
    </div>
  </div>

</body>

</html>