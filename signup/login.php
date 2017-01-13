<?php
include 'boot.php';
include_once 'browser.func.php';

$emailErr = array ( );

if (isset($_POST['submit'])) {
	$email = isset($_POST['email']) ? trim($_POST['email']) : '';
	$password = isset($_POST['password']) ? trim($_POST['password']) : '';


	if (empty($email) || empty($password)) {
		$emailErr['empty'] = "Please enter the email and password fields";
	}else if  (filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
		$emailErr['valid'] = "Your e-mail address is not valid!";
	}else {
		$recaptcha_secret = "6LfpnREUAAAAAPbCRYaQeSCiIZjDhE5I3MRQyEda";
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
        $response = json_decode($response, true);
        if($response["success"] === false) {
            $emailErr['valid'] = "Please complete reCaptcha";
			

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
				} else {
					$user = $result->fetch_assoc() ;
					$loginuser = "Hello, ".$user['firstname']." ".$user['lastname']."<br />\n";
					$userid = $user['id'];
					$_SESSION['user'] = $user;
					header("Location:myprofile.php");
					$sql = "
							INSERT INTO logininfo (
								`user_id`,
								`date`,
								`browser`,
							) VALUES (
								'" .$connect->real_escape_string($userid). "',
								NOW(),
								'" .$connect->real_escape_string($yourbrowser). "',
							)
					";
					$connect->query($sql);
				}
			} else {
				echo "Error!";
				echo $connect->connect_error;
			}
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
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<style>
		.signup{
			background-color: #B0C4DE;
		}
		.row{
			margin: 0;
			padding: 0;
		}
		.g-recaptcha{
			transform:scale(0.77);
			-webkit-transform:scale(0.77);
			transform-origin:left top;
			-webkit-transform-origin:0 0;
		}
	</style>
	<script language="javascript">
		function utcDifference() {
		var date = new Date();
		var utcdiff = d.getTimezoneOffset();
		document.getElementById("utcdiff").innerHTML = utcdiff;
		}
	</script>
</head>
<body>
	<div id="container">
		<div class="row">
			<div class="col-sm-3 col-md-3"></div>
			<div class="col-sm-6 col-md-6">
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
						<div class="col-md-5">
							<div class="form-group">
								<div class="g-recaptcha" data-sitekey="6LfpnREUAAAAAJ6Jwg6CoWx7X9tx0mQp9G0PL-8u" style="transform:scale(0.77);-webkit-transform:scale(0.90);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
							</div>
						</div>
						<div class="col-md-3"></div>
					</div>
					<div class="row">
					<div class="col-sm-4"></div>
						<div class="form-group">
							<div class="col-sm-4 text-center">
								<button type="submit" class="btn btn-primary" name="submit">Sign In</button>
								<button type="reset" class="btn btn-primary" onclick="utcDifference()" name="reset">Reset</button>
							</div>
						</div>
						<div class="col-sm-4"><p id="utcdiff" ></p></div>
					</div>
					<div class="row">
						<div class="col-sm-3"></div>
						<div class="col-sm-6">
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
						<div class="col-sm-3"></div>
					</div>
					<div class="col-sm-4"></div>
				</form>
			</div>
			<div class="col-sm-3 col-md-3"></div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>