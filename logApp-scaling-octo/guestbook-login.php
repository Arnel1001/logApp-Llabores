<?php
//start session
session_start();

require('config/config.php');
require('config/db.php');

// Set variables to null to avoid undefined index
$usr = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

// Assign session to post
$_SESSION['user'] = $usr;
$_SESSION['pass'] = $pass;

$query = "SELECT * FROM login ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$check = mysqli_num_rows($result);

if ($check > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if there's still a user and pass session
        if ($_SESSION['user'] && $_SESSION['pass']) {
            // If session is equal to the database, proceed to the next page
            if ($_SESSION['user'] == $row['username'] && $_SESSION['pass'] == $row['password']) {
                header("location: guestbook-list.php");
                exit; // Exit the script to prevent further execution
            }
        }
    }

    // If the post usr and pass are empty, turn off error reporting for undefined index
    if (empty($usr) && empty($pass)) {
        error_reporting(0);
    } else {
        echo "Account is not in the database";
    }
}

?>
<?php include('inc/header.php'); ?>
  <br/>
  <div style="width:30%; margin: auto; text-align: center;">
    <form method="POST" action="guestbook-list.php" class="form-signin">
      <img class="mb-4" src="img/bootstrap.svg" alt="" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="">
      <br/><label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button type="submit" name="submit" value="Submit" class="btn btn-lg btn-primary btn-block">Sign in</button>

    </form>
  </div>
<?php include('inc/footer.php'); ?>

