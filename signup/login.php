<?php

include 'config.php';


if (isset($_POST['submit'])) {
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';

	if (empty($email) || empty($password)) {
		echo "Please enter the email and password fields";
	}else if  (!filter_var($email,FILTER_VALIDATE_EMAIL) === true){
		$emailErr = "Your e-mail address is not valid!" ;
	} else {

		$password = md5($password);

		$sql = "SELECT
					`firstname`,
					`lastname`
				FROM `users`
				WHERE `email` = '" . mysqli_real_escape_string($connect, $email) . "' AND `password` = '" . mysqli_real_escape_string($connect, $password) ."'
				LIMIT 1";

		if (($result = mysqli_query($connect, $sql))) {
			if (!mysqli_num_rows($result)) {
				$loginErr = "Invalid user! Your information is not in our database";
			} else {
				while ($rows = mysqli_fetch_assoc($result)) {
					$loginuser = "Hello, ".$rows['firstname']." ".$rows['lastname']."<br />\n";
				}
			}
		} else {
			echo "Error!";
			echo mysqli_error($connect);
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="widrh=device-width,initial-scale=1"/>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div id="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<form action="login.php" method="post" class="form-horizontal" name="register">
					<div class="form-group">
						<label class="control-label col-sm-2">Email:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : ''); ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Password</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="password"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6 text-center">
							<button type="submit" class="btn btn-primary" name="submit">Sign In</button>
							<button type="reset" class="btn btn-primary" name="reset">Reset</button>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-6">
							<?php if (!empty($loginErr)) :?>
								<div class="help-block alert alert-danger"><?=$loginErr?></div>
							<?php endif ?>
							<?php if (!empty($loginuser)) :?>
								<div class="help-block alert alert-success"><?=$loginuser?></div>
							<?php endif ?>	
							<?php if(!empty($emailErr)) :?>
								<div class="help-block alert alert-danger"><?=$emailErr?></div>
							<?php endif ?>	
						</div>
					</div>
					<div class="col-sm-4"></div>	
				</form>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
