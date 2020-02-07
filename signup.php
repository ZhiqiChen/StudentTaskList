<?php
require "header.php";
?>

<main>
	<div>
		<h1> Signup </h1>
		<?php
			if (isset($_GET['error'])) {//if there is an error
				if ($_GET['error'] == "emptyfields") {
					echo 'Please fill out all fields';
				}elseif ($_GET['error'] == "invalidemail") {
					echo 'Invalid Email';
				}elseif ($_GET['error'] == "passwordcheck") {
					echo 'The passwords do not match up, please double check';
				}elseif ($_GET['error'] == "sqlerror") {
					echo 'SQL Error';
				}elseif ($_GET['error'] == "emailalreadyinuse") {
					echo "The email is already used";
				}
			}elseif (isset($_GET['signup'])) {
				if ($_GET['signup'] == "success"){
					echo "Sign up successful!";
				}
			}


		 ?>
		 <?php
		 	if (isset($_GET['newEmail'])) {
		 		echo '<form action="includes/signupProcess.php" method="post">
		      <input type="text" name="newEmail" value='.$_GET['newEmail'].'>
		      <input type="password" name="password" placeholder="Password">
		      <input type="password" name="password2" placeholder="Repeat Password">
		      <button type="submit" name="signup-submit"> Signup</button>

		    </form>';
		 	}else{
				echo '<form action="includes/signupProcess.php" method="post">
			      <input type="text" name="newEmail" placeholder="E-mail">
			      <input type="password" name="password" placeholder="Password">
			      <input type="password" name="password2" placeholder="Repeat Password">
			      <button type="submit" name="signup-submit"> Signup</button>
			    </form>';
			}

		  ?>

	</div>
</main>



<?php
require "footer.php";
?>
