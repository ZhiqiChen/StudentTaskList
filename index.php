<?php
require "header.php";
?>

<main>
	<div>
			<?php
			if (isset($_SESSION['userId'])) {
				echo '<p> You are logged in! </p>';
			} else{
				echo '<p> You are logged out! </p>';
			}

			if (isset($_GET['error'])){
				if ($_GET['error'] == 'emptyfields' ) {
					echo "Please fill out all fields";
				}elseif ($_GET['error'] == 'sqlerror') {
					echo "SQL Error Please try again";
				}elseif ($_GET['error'] == 'wrongpwd') {
					echo "Wrong Password Please try again";
				}elseif ($_GET['error'] == 'noemail') {
					echo "No such E-mail in record, please signup.";
				}
			}elseif(isset($_GET['error'])){
				 if ($_GET['login'] == 'success') {
					 echo 'Welcome Back!';
				 }
			}
			?>

	</div>
</main>

<body>
	<?php
		require "tasklist.php";
	 ?>
</body>



<?php
require "footer.php";
?>
