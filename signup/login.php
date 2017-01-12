<?php
session_start ();
include 'config.php';
include_once 'browser.func.php';
include_once 'securimage/securimage.php';
$securimage = new Securimage();

$emailErr = array ( );

if (isset($_POST['submit'])) {
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$browserinfo = $_POST['browser'];

	if (empty($email) || empty($password)) {
		$emailErr['empty'] = "Please enter the email and password fields";
	}else if  (filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
		$emailErr['valid'] = "Your e-mail address is not valid!";
	}else if ($securimage->check($_POST['captcha_code']) === false) {
		$captcha = "The security code entered was incorrect.<br /><br />";
	}else {
		$password = md5($password);
		$sql = "SELECT
					`id`,
					`firstname`,
					`lastname`
				FROM `users`
				WHERE `email` = '" . $connect->real_escape_string($email) . "' AND `password` = '" . $connect->real_escape_string($password) ."'
				LIMIT 1";
		if (($result = $connect->query($sql))) {
			if (!$result->num_rows) {
				$emailErr['user'] = "Invalid user! Your information is not in our database";
				header ("refresh: 5, url=index.php");
			} else {
				$user = $result->fetch_assoc() ;
				$loginuser = "Hello, ".$user['firstname']." ".$user['lastname']."<br />\n";
				$_SESSION['user'] = $loginuser;
				header("refresh: 5, url=myprofile.php");
			}
		} else {
			echo "Error!";
			echo $connect->connect-error;
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
		.signup{
			background-color:#B0C4DE;
		}
		.row{
			margin:0;
			padding:0;
		}
	</style>
</head>
<body>
	<div id="container">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6 col-xs-12">
				<form action="login.php" method="post" class="form-horizontal" name="register">
					<div class="row">
						<div class="form-group">
							<label class="control-label col-sm-4">Email:</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : ''); ?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label class="control-label col-sm-4">Password</label>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="password"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
							<input type="text" name="captcha_code" class="form-control" size="7" maxlength="6" />
							<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
						</div>
						<div class="col-md-4"></div>
					</div>
					<div class="row">
					<div class="col-sm-4"></div>
						<div class="form-group">
							<div class="col-sm-4 text-center">
								<button type="submit" class="btn btn-primary" name="submit">Sign In</button>
								<button type="reset" class="btn btn-primary" name="reset">Reset</button>
								<input type="hidden" name="browser" value="<?=$yourbrowser?>"/>
								<input type="hidden" name="hour" value=""/>
							</div>
						</div>
						<div class="col-sm-4"></div>
					</div>
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<?php if (!empty($captcha)) : ?>
								<div class="help-block alert alert-danger"><?=$captcha?></div>
							<?php endif ?>
							<?php if (!empty($emailErr['user'])) :?>
								<div class="help-block alert alert-danger"><?=$emailErr['user']?></div>
							<?php endif ?>
							<?php if (!empty($loginuser)) :?>
								<div class="help-block alert alert-success"><?=$loginuser?></div>
							<?php endif ?>
							<?php if(!empty($emailErr['empty'])) :?>
								<div class="help-block alert alert-danger"><?=$emailErr['empty']?></div>
							<?php endif ?>
							<?php if(!empty($emailErr['valid'])) :?>
								<div class="help-block alert alert-danger"><?=$emailErr['valid']?></div>
							<?php endif ?>
						</div>
						<div class="col-sm-2"></div>
					</div>
					<div class="col-sm-4"></div>
				</form>
			</div>
			<div class="col-sm-3"></div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>