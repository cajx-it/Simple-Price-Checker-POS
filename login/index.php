<?php
  session_start();

  if(isset($_SESSION['login'])){
    header('Location: ../dashboard/index.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #a0b5d6;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background: #1d2128;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      text-align: center;
      width: 200px;
      gap : 20px;
    }

    .login-box h2 {
      margin-bottom: 15px;
      font-size: 22px;
      font-weight: bold;
      color: #ffffff;
    }

    .login-box input {
      display: block;
      width: 80%;              /* ✅ match button size */
      padding: 10px;
      margin: 8px auto;        /* ✅ centers the input bar */
      border: 1px solid #ccc;
      border-radius: 15px;
      font-size: 14px;
      text-align: center;
      
    }

    .login-box button {
      width: 80%;              /* ✅ same width as inputs */
      padding: 10px;
      background: ##fff;
      color: #121010ff;
      font-size: 15px;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      margin-top: 1px;
    }

    .login-box button:hover {
      background: #c3c7ce;
    }

    .footer {
      margin-top: 12px;
      font-size: 11px;
      color: #777;
    }
    #error {
      margin-top: 10px;
      color: red;
      font-size: 11px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Admin Login</h2>
    <form id="login">
      <input id="user_name" type="text" placeholder="Username" required>
      <input id="password" type="password" placeholder="Password" required>
      <p id="error"></p>
      <button>Login</button>
    </form>
    <div class="footer">Powered by cajx</div>
  </div>
  <script src="login.js"></script>
</body>
</html>