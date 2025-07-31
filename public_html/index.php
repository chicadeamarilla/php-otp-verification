<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "db.php";
include "header.php";

//sendmail("sheidarajabi7@gmail.com","Your verification code is: ", mt_rand(1000, 9999));


echo md5(8520);

?>
<!DOCTYPE html>

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
        <a href="saveJarden.php">Add Plant</a>
        <a href="save_food.php">Add Food</a>

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