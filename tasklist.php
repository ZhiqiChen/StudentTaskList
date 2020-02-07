<div class="container">
  <?php
    require 'includes/db.php';
    if (!$_SESSION['userEmail']) {
      exit();
    }else {
      $sql = "SELECT * FROM ?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: index.php?error=sqlerror");
        exit();
      }
      mysqli_stmt_bind_param($stmt, "s", $_SESSION[userEmail]);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      //for loops to go through and echo out tasklist item, dropdown for priority, button for deletion
      echo '<form action= "includes/tasklistChange" method="POST">';
      //adding tasklist
      echo "<text> </text>";
      echo "<button type='submit' name = 'submit'>";
      //display tasks
      echo "<ul class= 'tasklist'>";
      // echo "<li>
      //       <p>Task</p>
      //       <dropdown>priority</dropdown>
      //       <button>Delete</button>
      //       </li>";


      while ($row = mysqli_fetch_assoc($result) == true) {
        echo "<li> <p>".$row['task']"</p>

        </li>";
      }
      echo "</ul>";
    }
  ?>
</div>
