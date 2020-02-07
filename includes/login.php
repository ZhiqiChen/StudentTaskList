<?php
if (isset($_POST['login-submit'])) {
  require 'db.php';
  $emailid = $_POST['emailId'];
  $password = $_POST['pwd'];

  if (empty($emailid) || empty($password)){
    header("Location: ../index.php?error=emptyfields&emailId=".$emailid);
    exit();
  } else {
    $sql = "SELECT * FROM users WHERE emailUser=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) { //check if stmt works with db
      header("Location: ../index.php?error=sqlerror&emailId=".$emailid);
      exit();
    } else{
      mysqli_stmt_bind_param($stmt, "s", $emailid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) { //if there was an actual result, assoc is an associative array, interprets data from db
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        if ($pwdCheck == false) { //if pwd is not correct
          header("Location: ../index.php?error=wrongpwd&emailId=".$emailid);
          exit();
        } else if ($pwdCheck == true){ //idk how it might get some random info so make sure it returns true
          /*when user logs in, you store info in global variables, to check whether or not you are logged in, check if
          global variables are available. We call these session variables!*/
          session_start();
          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userEmail'] = $row['emailUser'];
          header("Location: ../index.php?login=success");
          exit();
        } else{
          header("Location: ../index.php?error=wrongpwd&emailId=".$emailid);
          exit();
        }
      } else{
        header("Location: ../index.php?error=noemail&emailId=".$emailid);
        exit();
      }
    }
  }
}else{
  header("Location: ../index.php");
  exit();
}
