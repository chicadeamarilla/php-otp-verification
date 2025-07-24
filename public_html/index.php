<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "db.php";


//sendmail("sheidarajabi7@gmail.com","Your verification code is: ", mt_rand(1000, 9999));




?>
<!DOCTYPE html>
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
<body>

<?php if (isset($_GET['msg'])){ ?>
  <div class='msg'><?= htmlspecialchars($_GET['msg']) ?></div>
<?php } ?>

<?php if (isset($_COOKIE['beedata'])){ ?>

  <div class="welcome-box">
    <h1>Welcome Back <?= htmlspecialchars($_COOKIE['beedata']) ?></h1>
    <a href='logout.php'>Logout</a>
  </div>

  <div class="welcome-box">
    <h2>User List</h2>
    <?php
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo $row['id'] . " " . htmlspecialchars($row['username']) . " " . htmlspecialchars($row['Email']) . "<br>";
      }
    }
    ?>
  </div>

  <div class="welcome-box">
    <h2>Jarden List</h2>
    <?php
    $sql = "SELECT jarden.id , description , jarden.name , breed.name as bname , users.username FROM jarden INNER JOIN  breed ON jarden.breed_id = breed.id INNER JOIN users ON jarden.user_id = users.id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
 

        echo $row['id'] . " " . ($row['name']) . " Breed:  " . $row['bname'] . " " . $row['username'] . " " . ($row['description']) . "<br>";
          if(isset($_COOKIE['rules']))   {
        echo '<a href="delete.php?id='.$row['id'].'">Delete</a>';

          } 

      }

    }
    ?>
        <a href="saveJarden.php">Add</a>

  </div>

<?php }else{ ?>
  <div class="login-box">
    <div class="emoji">🐝</div>
    <h2>Login</h2>
    <form method="post" action="auth.php?type=login">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login">
    </form>
    <a href="signup.php">Sign up</a>
    <a href="forget.php">forget</a>
  </div>
<?php } ?>

</body>
</html>