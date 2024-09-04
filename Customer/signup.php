<?php include('rl-function.php')?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/customer/rl.css">
</head>
<body>
    <?php 
		include 'lsnav.php';
	?>
	<!-- <div class="header">
		<h2>Welcome To PawsCloud</h2>
		<img class="logo" src="https://th.bing.com/th/id/OIP.7l_DtRvXbkuZqYFPXVKeaQHaHa?pid=ImgDet&rs=1" alt="logo" align="center">
	</div><br> -->

	<script>
            function ProfileValidate(){
				var Fullname = document.Profile["fullname"].value;
                var NoIC = document.Profile["noic"].value;
                var NoPH = document.Profile["noph"].value;
                var Email = document.Profile["email"].value;
                var Password = document.Profile["password1"].value;
				
                var icFormat = /^[0-9]{12}$/; 
                var phoneFormat = /^01\d{8,9}$/; 

                var emailFormat = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

                if (Fullname.length > 50) {
                    alert("Fullname should not be longer than 50 characters!");
                    return false;
                }else if (Password.length > 15) {
                    alert("Password should not be longer than 15 characters!");
                    return false;
                } else if (!emailFormat.test(Email)) {
                    alert("Invalid email format! Must be a Gmail email address.");
                    return false;
                } else if (!phoneFormat.test(NoPH)) {
                    alert("Invalid phone number format! Please enter a valid Malaysian phone number in the format of 01xxxxxxxx.");
                    return false;
                } else if(!icFormat.test(NoIC)) {
                    alert("Invalid IC number format! Please enter a valid Malaysian IC number in the format of xxxxxxxxxxxx.");
                    return false;
                }
                return true;
            }
        </script>
	<div class="form-container">
		<div class="rl-container">
			<header>Sign Up</header>
			<form class="login-form" method="post" action="signup.php" name="Profile" onsubmit="return ProfileValidate();">

				<?php 
				echo display_error(); 
				?>

				<div class="input_login">
					<label>Fullname: </label>
					<input type="text" name="fullname" >
				</div>
				<div class="input_login">
					<label>Email: </label>
					<input type="text" name="email">
				</div>
				<div class="input_login">
					<label>Phone number: </label>
					<input type="text" name="noph">
				</div>
				<div class="input_login">
					<label>Identity card number: </label>
					<input type="text" name="noic">
				</div>
				<div class="input_login">
					<label>Password: </label>
					<input type="password" name="password1">
				</div>
				<div class="input_login">
					<label>Re-enter password: </label>
					<input type="password" name="password2">
				</div>
				<div class="box">
				<button type="submit" class="rl_btn" name="register_btn">Sign Up</button>
			</div><br>
				<div class="inline">
					<div class="inline_left">
						<a href="login.php" data-role="button" data-inline="true">Already have an account?</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>