<?php
	//require "header.php"
  //will add header and footer later
?>

<main>
	<h1>Sign up</h1>
	<!-- Action points to a spesific page where we'll have only php code
	things will be checked there and, if everythings ok, user will be logged in-->
	<form action="includes/signup.inc.php" method="post">
		<input type="text" name="uid" placeholder="Username">
		<input type="text" name="mail" placeholder="E-mail">
		<input type="password" name="pwd" placeholder="Password">
		<input type="password" name="pwd-repeat" placeholder="Repeat password">
		<button type="submit" name="signup-submit">Signup</button>
	</form>
</main>

<?php
	//require "footer.php"
?>
