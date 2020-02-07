<?php
if (isset($_POST['signup-submit'])) { //makes sure that you only access this from the signup button in signup.php

  require 'db.php';
  $email = $_POST['newEmail'];
  $password = $_POST['password'];
  $password2= $_POST['password2'];

  if (empty($email) || empty($password) || empty($password2)){ //check for any empty fields

    header("Location: ../signup.php?error=emptyfields&newEmail=".$email);
    /*send the user back to the signup page, ? means info after the url
    & means sends the info back so user doesn't need to redo everting*/
    exit(); //exit the program
  }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ //check if this is a valid email.
    header("Location: ../signup.php?error=invalidemail");
    /*send the user back to the signup page, ? means info after the url
    & means sends the info back so user doesn't need to redo everting*/
    exit();
  } /*elseif (!preg_match("/^[a-aA-Z0-9]*$/", $somename)){
  } THis is how to validate a proper name*/

  else if ($password !== $password2){//note that not equal is !== not !=, check if the two password is the same
      header("Location: ../signup.php?error=passwordcheck&newEmail=".$email);
      exit();
  }else{//check if there are matching users
    $sql = "SELECT emailUser From users WHERE emailUser=?"; //the ? is a placeholder in order to avoid sql injection
    //to add more placeholders just do 'AND' at the end

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../signup.php?error=sqlerror");
      exit();
    } else{
      mysqli_stmt_bind_param($stmt, "s", $email);
      //now we are passing in info for the placeholder in stmt, s for string,
      //i for int, b for bool, and d for double
      //for multiple placeholders then add more datatypes, ie if there are 2 strings, then pass in 'ss'
      mysqli_stmt_execute($stmt); //run the code
      mysqli_stmt_store_result($stmt);// get info back from sql and store in $stmt
      $resultCheck = mysqli_stmt_num_rows($stmt); //sql returns the number of matches of the rows
      //so if user already exists then its 1, if it is a new user then it should return 0
      if ($resultCheck > 0){
        header("Location: ../signup.php?error=emailalreadyinuse");
        exit();
      }
      else{ //insert info since no more errors
        $sql = "INSERT INTO users(emailUser, pwdUsers) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../signup.php?error=sqlerror");
          exit();
        } else{
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT); //we need to hash the pwd, USE the default which is bcrypt hahsing
            mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPwd);
            mysqli_stmt_execute($stmt); //run the code


            $sql = "INSERT INTO users(emailUser, pwdUsers) VALUES (?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
              header("Location: ../signup.php?error=sqlerror");
              exit();
            } else{
              //create new table
              mysqli_stmt_bind_param($stmt, )

              header("Location: ../signup.php?signup=success"); //success message
              exit();
            }
        }

      }

    }

  }
  mysqli_stmt_close($stmt); //close the stmt
  mysqli_close($conn); //close connection with sql

}
else{ //if user didn't access this script using the signup page
  header("Location: ../signup.php");
  exit();
}
