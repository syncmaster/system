<?php
include 'boot.php';
require_once 'mail.php';

$firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
$lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
$age = isset($_POST['age']) ? trim($_POST['age']) : '';
$country = isset($_POST['country']) ? trim($_POST['country']) : '';
$city = isset($_POST['city']) ? trim($_POST['city']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$repassword = isset($_POST['repassword']) ? trim($_POST['repassword']) : '';
$signup = "";
$validateErr = array();


if (isset($_POST['signup'])) {
	if (empty($firstname)) {
		$validateErr['firstname'] = "Please <b>Enter</b> your <b>FirstName</b> " ;
	} else if ((mb_strlen($firstname)) < 6 || (mb_strlen($firstname) > 20)){
		$validateErr['firstname'] = "Please <b>Enter</b> your Firstname between 6 and 20 symbols ";
	}

	if (empty($lastname)) {
		$validateErr['lastname'] = "Please <b>Enter</b> your <b>Lastname</b> ";
	} else if ((mb_strlen($lastname)) < 6 || (mb_strlen($lastname) > 20)) {
		$validateErr['lastname'] = "Please <b>Enter</b> your <b>Lastname</b> between 6 and 20 symbols ";
	}

	if (empty($age)) {
		$validateErr['age'] = "Please <b>Enter</b> your <b>Ages</b>! ";
	} else if (($age <= 13) || ($age > 99)) {
		$validateErr['age'] = "Please <b>Enter</b> ages between <b>13 and 99</b>! ";
	}

	if (empty($country)) {
		$validateErr['country'] = "Please choose your <b>Country</b>!";
	}

	if (empty($city)) {
		$validateErr['city'] = "Please <b>Enter</b> your <b>City</b>! ";
	} else if (mb_strlen($city)> 30) {
		$validateErr['city'] = "Please <b>Enter</b> <b>city</b> less than <b>30 symbols</b>!";
	}

	if (empty($address)) {
		$validateErr['address'] = "Please <b><b>Enter</b></b> your <b>Address</b>! ";
	}

	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$validateErr['email'] = "Your <b>E-mail</b> is <b>not valid</b>! ";
	} else if (empty($email)) {
		$validateErr['email'] = "Please <b>Enter</b> your <b>E-mail Address</b>! ";
	} else  {
		$sql = "SELECT `email`
			FROM users
			WHERE `email` = '" . $connect->real_escape_string($email) . "' ";
		$emailresult = $connect->query($sql);
		if ($emailresult->num_rows) {
			$validateErr['email'] = "E-mail address is already registered";
		}
	}
	
	$recaptcha_secret = "6LfpnREUAAAAAPbCRYaQeSCiIZjDhE5I3MRQyEda";
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
	$response = json_decode($response, true);
	if($response["success"] === false){
        $validateErr['captcha'] = "Please complete reCaptcha";
	}

	if (empty($password) || empty($repassword)) {
		$validateErr['password'] = "Please <b>Enter</b> your <b>Password</b>! ";
	} else if ($password !== $repassword) {
		$validateErr['password'] =  "Your <b>password</b> did <b>not match</b>! ";
	} else if (strlen($password) < 8 ) {
		$validateErr['password']  = "Your Password must contain a <b>8 characters</b>! ";
	}
	
	if (!count($validateErr)) {
		$password = md5($password);
		$sql = "
			INSERT INTO users (
				`firstname`,
				`lastname`,
				`age`,
				`country`,
				`city`,
				`address`,
				`email`,
				`password`
			) VALUES (
				'" .$connect->real_escape_string($firstname). "',
				'" .$connect->real_escape_string($lastname). "',
				'" .$connect->real_escape_string($age). "',
				'" .$connect->real_escape_string($country). "',
				'" .$connect->real_escape_string($city). "',
				'" .$connect->real_escape_string($address). "',
				'" .$connect->real_escape_string($email). "',
				'" .$connect->real_escape_string($password). "'
			)
		";
		if ($connect->query($sql)) {
			$signup = "Your account had been created..!";
			//PHP Mail send with successful sing up
			$mail->Send();
			header("refresh: 2 ;url=login.php");
		} else {
			$signupErr = "something went wrong";
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
			transform:scale(0.65);
			-webkit-transform:scale(0.85);
			transform-origin:left top;
			-webkit-transform-origin:0 0;
		}
		@media screen and (max-height: 575px){
		#rc-imageselect, .g-recaptcha {
			transform:scale(0.70);
			-webkit-transform:scale(0.70);
			transform-origin:0 0;
			-webkit-transform-origin:0 0;
			}
		}
	</style>	
</head>
<body>
	<div class="container">
	<?php if (isset($_SESSION['user'])) : ?>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="alert alert-danger"><strong>Error!</strong>You are already registered. Please back to your profile <a href="myprofile.php" class="btn btn-primary">My Profile</a></div>
			</div>
			<div class="col-md-3"></div>
		</div>
	<?php endif ?>
	<?php if (!isset($_SESSION['user'])) : ?>
		<div class="row">
			<div class="col-md-3 col-sm-2"></div>
			<div class="col-md-6 signup col-sm-8 col-xs-12">
				<form action="index.php" method="post" class="form-horizontal" name="register">
					<div class="row">
						<div class="form-group <?php if (!empty($validateErr['firstname'])): ?>has-error<?php endif ?>">
							<label class="control-label col-sm-4">FirstName:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?=$firstname;?>" name="firstname"/>
								<!-- <?php if(isset($validateErr['firstname'])) : ?>
									<div class="help-block alert alert-danger"><?=$validateErr['firstname'] ?></div>
								<?php endif ?> -->
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($validateErr['lastname'])) : ?>has-error<?php endif ?>">
							<label class="control-label col-sm-4">LastName:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="lastname"/ value="<?=$lastname?>">
								<!--<?php if(isset($validateErr['lastname'])) : ?>
									<div class="help-block alert alert-danger"><?=$validateErr['lastname'] ?></div>
								<?php endif ?> -->
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($validateErr['age'])) : ?>has-error<?php endif ?>" >
							<label class="control-label col-sm-4">Age:</label>
							<div class="col-sm-6">
								<input type="number" class="form-control" name="age"/ value="<?=$age?>">
								<!-- <?php if(isset($validateErr['age'])) : ?>
									<div class="help-block alert alert-danger"><?php echo $validateErr['age'];?></div>
								<?php endif ?> -->
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($validateErr['country'])) : ?>has-error<?php endif ?>">
							<label class="control-label col-sm-4">Country:</label>
							<div class="col-sm-6">
								<select type="text" class="form-control" name="country" value="<?=$country?>">
									<option value="selected" <?php if (!mb_strlen($country)): ?>selected<?php endif ?> disabled>Please choose country</option>
									<option value="Bulgaria" <?php if ($country === "Bulgaria"): ?>selected<?php endif ?>>Bulgaria</option>
									<option value="England" <?php if ($country === "England"): ?>selected<?php endif ?>>England</option>
									<option value="USA" <?php if ($country === "USA"): ?>selected<?php endif ?>>USA</option>
									<option value="Roumania" <?php if ($country === "Roumania"): ?>selected<?php endif ?>>Roumania</option>
									<option value="Serbia" <?php if ($country === "Serbia"): ?>selected<?php endif ?>>Serbia</option>
								</select>
								<!-- <?php if (isset($validateErr['country'])) : ?>
									<div class="help-block alert alert-danger"><?=$validateErr['country'] ?></div>
								<?php endif ?> -->

							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($validateErr['city'])) : ?>has-error <?php endif ?>">
							<label class="control-label col-sm-4">City:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="city" value="<?=$city?>"/>
								<!-- <?php if (isset($validateErr['city'])) : ?>
									<div class="help-block alert alert-danger alert-dismissable"><?=$validateErr['city'] ?></div>
								<?php endif ?> -->
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($validateErr['address'])) : ?>has-error <?php endif ?>">
							<label class="control-label col-sm-4">Address:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="address" value="<?=$address?>" />
								<!-- <?php if(isset($validateErr['address'])) : ?>
									<div class="help-block alert alert-danger"><?=$validateErr['address'] ?></div>
								<?php endif ?> -->
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($validateErr['email'])) : ?>has-error <?php endif ?>">
							<label class="control-label col-sm-4">E-mail Address</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="email" value="<?=$email?>"/>
								<!-- <?php if(isset($validateErr['email'])) : ?>
									<div class="help-block alert alert-danger"><?=$validateErr['email'] ?></div>
								<?php endif ?> -->
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($validateErr['password'])) : ?>has-error <?php endif ?>">
							<label class="control-label col-sm-4">Password</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="password"/>
								<!-- <?php if (isset($validateErr['password'])) :?>
									<div class="help-block alert alert-danger" ><?=$validateErr['password'] ?></div>
								<?php endif ?> -->
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label class="control-label col-sm-4">Repeat Password</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="repassword"/>
							</div>
							<div class="col-sm-2"></div>
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
						<div class="form-group center-block">
							<div class="col-xs-1 col-sm-4"></div>
							<div class="col-xs-10 col-sm-6">
								<button type="submit" class="btn btn-primary" name="signup">Sign Up </button>
								<button type="reset" class="btn btn-primary" name="reset">Reset</button>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group center-block">
							<div class="col-sm-2"></div>
							<div class="col-xs-12 col-sm-8">
								<?php if (!empty($signup)) : ?>
								<div class="alert alert-success col-sm-12"><p style="text-align:center"><?=$signup?></p></div>
								<?php endif ?>
								<?php if (!empty($validateErr)) : ?>
								<div class="help-block alert alert-danger">
									<?php if(!empty($validateErr)) {
									echo "<ul>";
										foreach($validateErr as $error){
											echo "<li>$error</li>";
										}
									echo "</ul>";
									}
									?>
									<?php endif ?>
								</div>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-3 col-sm-2"></div>
		</div>
	<?php endif ?>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
