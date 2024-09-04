<?php include('Customer/rl-function.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="stylesheet" href="../assets/css/customer/rl.css">
	<style>
		.hr-container {
			margin-top: 30px;
			margin-bottom: 30px;
			position: relative;
			text-align: center;
		}

		.hr-text {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			background-color: #fff;
			padding: 0 10px;
		}
	</style>
</head>

<body>
	<?php
	include 'Customer/lsnav.php';
	?>
	<script>
		function LoginValidate() {
			var NoIC = document.login_form["noic"].value;
			var Password = document.login_form["password"].value;
			var icFormat = /^[0-9]{12}$/;

			if (Password.length > 15) {
				alert("Password should not be longer than 15 characters!");
				return false;
			} else if (!icFormat.test(NoIC)) {
				alert("Invalid IC number format! Please enter a valid Malaysian IC number in the format of xxxxxxxxxxxx.");
				return false;
			}
			return true;
		}
	</script>
	<div class="form-container">
		<div class="rl-container">
			<header>Login</header>
			<form class="login-form" method="post" action="login.php" name="login_form" onsubmit="return LoginValidate();">

				<?php echo display_error(); ?>

				<div class="input_login">
					<label>IC Number:</label>
					<input type="text" name="noic">
				</div>
				<div class="input_login">
					<label>Password: </label>
					<input type="password" name="password">
					<div class="inline_right">
						<!-- <a href="ResetPassword.php" data-role="button" data-inline="true">Forgot Password?</a> -->
					</div>
				</div><br>
				<div class="box">
					<button type="submit" class="rl_btn" name="login_btn">Login</button>
				</div>
				<div class="hr-container">
					<hr>
					<span class="hr-text">OR</span>
					<hr>
				</div>
				<div class="box">
					<button type="button" class="rl_btn" onclick="window.location.href='Customer/homepage.php';">Login as guest</button>
				</div>
			</form>
		</div>
	</div>
</body>

</html>