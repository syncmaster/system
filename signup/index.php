<?php
include 'config.php';

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
$validateErr = array ( );
$sqlemailcheck = "SELECT `email` FROM users WHERE `email` = '" .$email. "' ";
$emailresult = mysqli_query($connect,$sqlemailcheck);
$rows = mysqli_num_rows($emailresult);

if(isset($_POST['signup'])) {
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
	} else if (mb_strlen($city)> 30){
		$validateErr['city'] = "Please <b>Enter</b> <b>city</b> less than <b>30 symbols</b>!";
	}
	if (empty($address)) {
		$validateErr['address'] = "Please <b><b>Enter</b></b> your <b>Address</b>! ";
	}
	if (!filter_var($email,FILTER_VALIDATE_EMAIL) === true){
		$validateErr['email'] = "Your <b>E-mail</b> is <b>not valid</b>! ";
	} else if (empty($email)) {
		$validateErr['email'] = "Please <b>Enter</b> your <b>E-mail Address</b>! ";
	} else if ($rows >0) {
		$validateErr['email'] = "Your <b>E-mail</b> Address is <b>already used</b>!";
	}
	if (empty($password) || (empty($password))) {
		$validateErr['password'] = "Please <b>Enter</b> your <b>Password</b>! ";
	} else if (!($password == $repassword)) {
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
				'".mysqli_real_escape_string($connect,$firstname)."',
				'".mysqli_real_escape_string($connect,$lastname)."',
				'".mysqli_real_escape_string($connect,$age)."',
				'".mysqli_real_escape_string($connect,$country)."',
				'".mysqli_real_escape_string($connect,$city)."',
				'".mysqli_real_escape_string($connect,$address)."',
				'".mysqli_real_escape_string($connect,$email)."',
				'".mysqli_real_escape_string($connect,$password)."'
			)
		";

		if (mysqli_query($connect, $sql)) {
			$signup = "Your account had been created..!";
			/*header("refresh: 10 ;url=login.php");*/
			
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
	<meta name="viewport" content="widrh=device-width,initial-scale=1"/>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
	.signup{
		background-color:#B0C4DE;
	}
	</style>
</head>
<body>
	<div class="wrapper container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 signup col-xs-12">
				<form action="index.php" method="post" class="form-horizontal" name="register">
					<div class="form-group <?php if (!empty($validateErr['firstname'])): ?>has-error<?php endif ?>">
						<label class="control-label col-sm-3">FirstName:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" value="<?=$firstname;?>" name="firstname"/>
							<!-- <?php if(isset($validateErr['firstname'])) : ?>
								<div class="help-block alert alert-danger"><?=$validateErr['firstname'] ?></div>
							<?php endif ?> -->
						</div>
					</div>
					<div class="form-group <?php if (!empty($validateErr['lastname'])) : ?>has-error<?php endif ?>">
						<label class="control-label col-sm-3">LastName:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="lastname"/ value="<?=$lastname?>">
							<!-- <?php if(isset($validateErr['lastname'])) : ?>
								<div class="help-block alert alert-danger"><?=$validateErr['lastname'] ?></div>
							<?php endif ?> -->
						</div>
					</div>
					<div class="form-group <?php if (!empty($validateErr['age'])) : ?>has-error<?php endif ?>" >
						<label class="control-label col-sm-3">Age:</label>
						<div class="col-sm-6">
							<input type="number" class="form-control" name="age"/ value="<?=$age?>">
							<!-- <?php if(isset($validateErr['age'])) : ?>
								<div class="help-block alert alert-danger"><?php echo $validateErr['age'];?></div>
							<?php endif ?> -->
						</div>
					</div>
					<div class="form-group <?php if (!empty($validateErr['country'])) : ?>has-error<?php endif ?>">
						<label class="control-label col-sm-3">Country:</label>
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
					</div>
					<div class="form-group <?php if (!empty($validateErr['city'])) : ?>has-error <?php endif ?>">
						<label class="control-label col-sm-3">City:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="city" value="<?=$city?>"/>
							<!-- <?php if (isset($validateErr['city'])) : ?>
								<div class="help-block alert alert-danger alert-dismissable"><?=$validateErr['city'] ?></div>
							<?php endif ?> -->
						</div>
					</div>
					<div class="form-group <?php if (!empty($validateErr['address'])) : ?>has-error <?php endif ?>">
						<label class="control-label col-sm-3">Address:</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="address" value="<?=$address?>" />
							<!-- <?php if(isset($validateErr['address'])) : ?>
								<div class="help-block alert alert-danger"><?=$validateErr['address'] ?></div>
							<?php endif ?> -->
						</div>
					</div>
					<div class="form-group <?php if (!empty($validateErr['email'])) : ?>has-error <?php endif ?>">
						<label class="control-label col-sm-3">E-mail Address</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="email" value="<?=$email?>"/>
							<!-- <?php if(isset($validateErr['email'])) : ?>
								<div class="help-block alert alert-danger"><?=$validateErr['email'] ?></div>
							<?php endif ?> -->
						</div>
					</div>
					<div class="form-group <?php if (!empty($validateErr['password'])) : ?>has-error <?php endif ?>">
						<label class="control-label col-sm-3">Password</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="password"/>
							<!-- <?php if (isset($validateErr['password'])) :?>
								<div class="help-block alert alert-danger" ><?=$validateErr['password'] ?></div>
							<?php endif ?> -->
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Repeat Password</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="repassword"/>
						</div>
					</div>
					<div class="form-group center-block">
						<div class="row">
							<div class="col-xs-2 col-sm-3"></div>
							<div class="col-xs-8 col-sm-6">
								<button type="submit" class="btn btn-primary" name="signup">Sign Up </button>
								<button type="reset" class="btn btn-primary" name="reset">Reset</button>
							</div>
							<div class="col-xs-2 col-sm-3"></div>
						</div>			
					</div>
					<div class="form-group center-block">
						<div class="row">
							<div class="col-xs-1"></div>
							<div class="col-xs-10">
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
							<div class="col-xs-1"></div>
						</div>
					</div>
				</form>
			</div>	
			<div class="col-md-3"></div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
