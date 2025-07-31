<html>
<head>
  <title>Login Page</title>
  <style>
    /* Your CSS styles (unchanged) */
    body {
      background-color: #fff9c4;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background: #fffde7;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .emoji {
      font-size: 48px;
      margin-bottom: 10px;
    }

    .login-box h2 {
      margin-bottom: 20px;
      color: #fbc02d;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #fdd835;
      border-radius: 5px;
      background-color: #fffde7;
    }

    input[type="submit"] {
      background-color: #fdd835;
      color: #000;
      border: none;
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    input[type="submit"]:hover {
      background-color: #fbc02d;
    }

    a {
      display: block;
      margin-top: 10px;
      color: #fbc02d;
      text-align: center;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    .welcome-box {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .msg {
      background: #fffde7;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      text-align: center; 
    }
  </style>
</head>