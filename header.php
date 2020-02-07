<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<meta name = "description" content = "uoft daily planner login">
	<title>UofT daily planner</title>
	<link rel="stylesheet" type="text/css" href="style.css?<?php echo time(); ?>">
</head>


<body>

	<header class="containerHeader">
		<div >
				<a href="index.php" id="navigation">Home</a>

				<a href="#" id="navigation">Facebook Activities</a>
		</div>

		<div>
			<?php
				if (isset($_SESSION['userId'])) { //the global varible exists therefore you are logged in.
					echo
					'<form action="includes/logout.php" method="post">
					<button type="submit" name="logout-submit">Logout</button>
					</form>';
				} else {
					if (isset($_GET['emailId'])) {
						echo
						'<form action="includes/login.php" method="post">
							<input type="text" name="emailId" value='.$_GET['emailId'].'>
							<input type="password" name="pwd" placeholder="password">
							<button type="submit" name="login-submit"> Login</button>
							</form>
							<a href="signup.php"> Signup</a>';
					} else {
						echo '<form action="includes/login.php" method="post">
							<input type="text" name="emailId" placeholder="E-mail">
							<input type="password" name="pwd" placeholder="password">
							<button type="submit" name="login-submit" class="button"> Login</button>
							</form>
							<a href="signup.php" class="button"> Signup</a>';
					}
				}
			?>
		</div>

	</header>


	<?php
		if (isset($_SESSION['userId'])){
			//require "taskList.php";
		} else {//default didn't sign in view maybe a picture?
			//require "";
		}
	 ?>


</body>

</html>
