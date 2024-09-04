<?php 
include('l-function.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	
	<link rel="stylesheet" href="../assets/css/staff/l-function.css">
</head>
<body>
	<?php 
		include 'loginnav.php';
	?>
<div class="form-container">
	<div class="rl-container">
		<header>Login</header>
		<form class="login-form" method="post" action="login.php">
			<?php echo display_error(); ?>

			<div class="input_login">
				<label>IC Number: </label>
				<input type="text" name="noic" >
			</div>
			<div class="input_login">
				<label>Password: </label>
				<input type="password" name="password">
			</div>
			<div class="box">
				<button type="submit" class="rl_btn" name="login_btn">Login</button>
			</div><br>
		</form>
	</div>
</div>
</body>
</html>