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

$validateErr = array ( );

if(isset($_POST['signup'])){
	if (empty($_POST['firstname'])){
		$validateErr['firstname'] = "Please enter your name " ;
	} else if((mb_strlen($_POST['firstname'])) < 6 || (mb_strlen($_POST['firstname']) > 20)){
		$validateErr['firstname'] = "Please enter your Firstname between 6 and 20 symbols ";
	}

	if (empty($_POST['lastname'])){
		$validateErr['lastname'] = "Please enter your Lastname ";
	} else if((mb_strlen($_POST['lastname'])) < 6 || (mb_strlen($_POST['lastname']) > 20)) {
		$validateErr['lastname'] = "Please enter your Lastname between 6 and 20 symbols ";
	}
	if (empty($_POST['age'])){
		$validateErr['age'] = "Please enter your age ";
	} else if(($_POST['age'] <= 13) || ($_POST['age'] > 99)) {
		$validateErr['age'] = "Please enter age between 13 and 99 ";
	}
	if (empty($_POST['country'])) {
		$validateErr['country'] = "Please choose your country";
	}
	if (empty($_POST['city'])){
		$validateErr['city'] = "please enter your city ";
	} else if (mb_strlen($_POST['city'])> 30){
		$validateErr['city'] = "Please enter city less than 30 symbols";
	}
	if (empty($_POST['address'])){
		$validateErr['address'] = "please enter your address ";
	}
	if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) === true){
		$validateErr['email'] = "Your e-mail is not valid ";
	} else if (empty($_POST['email'])){
		$validateErr['email'] = "Please enter your e-mail address ";
	}
	if (empty($_POST['password']) || (empty($_POST['repassword']))){
		$validateErr['password'] = "please enter your password ";
	} else if (!($_POST['password'] == $_POST['repassword'])){
		$validateErr['password'] =  "Your password did not match ";
	} else if (strlen($_POST['password']) < 8 ) {
		$validateErr['password']  = "Your Password must contain a 8 characters ";
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
				'$firstname',
				'$lastname',
				'$age',
				'$country',
				'$city',
				'$address',
				'$email',
				'$password'
			)
		";

		if (mysqli_query($connect, $sql)) {
			echo "Your account had been created..!";
		} else {
			echo "something went wrong";
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
		<form action="index.php" method="post" class="form-horizontal" name="register">
			<div class="form-group <?php if (!empty($validateErr['firstname'])): ?>has-error<?php endif ?>">
				<label class="control-label col-sm-2">FirstName:</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" value="<?=$firstname;?>" name="firstname"/>

					<?php if(isset($validateErr['firstname'])): ?>
					<div class="help-block"><?=$validateErr['firstname'] ?></div>
					<?php endif ?>
				</div>
			</div>
			<div class="form-group <?php if (!empty($validateErr['lastname'])) : ?>has-error<?php endif ?>">
				<label class="control-label col-sm-2">LastName:</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="lastname"/>
					<?php if(isset($validateErr['lastname'])) : ?>
					<div class="help-block"><?=$validateErr['lastname'] ?></div>
					<?php endif ?>
				</div>
			</div>
			<div class="form-group <?php if (!empty($validateErr['age'])) : ?>has-error<?php endif ?>" >
				<label class="control-label col-sm-2">Age:</label>
				<div class="col-sm-6">
					<input type="number" class="form-control" name="age"/>
					<?php if(isset($validateErr['age'])) : ?>
					<div class="help-block"><?php echo $validateErr['age'];?></div>
					<?php endif ?>
				</div>
			</div>
			<div class="form-group <?php if (!empty($validateErr['country'])) : ?>has-error<?php endif ?>">
				<label class="control-label col-sm-2">Country:</label>
				<div class="col-sm-6">
					<select type="text" class="form-control" name="country">
						<option value="selected" <?php if (!mb_strlen($country)): ?>selected<?php endif ?> disabled>Please choose country</option>
						<option value="Bulgaria" <?php if ($country === "Bulgaria"): ?>selected<?php endif ?>>Bulgaria</option>
						<option value="England" <?php if ($country === "England"): ?>selected<?php endif ?>>England</option>
						<option value="USA" <?php if ($country === "USA"): ?>selected<?php endif ?>>USA</option>
						<option value="Roumania" <?php if ($country === "Roumania"): ?>selected<?php endif ?>>Roumania</option>
						<option value="Serbia" <?php if ($country === "Serbia"): ?>selected<?php endif ?>>Serbia</option>
					</select>
					<?php if (isset($validateErr['country'])) : ?>
					<div class="help-block"><?=$validateErr['country'] ?></div>
					<?php endif ?>

				</div>
			</div>
			<div class="form-group <?php if (!empty($validateErr['city'])) : ?>has-error <?php endif ?>">
				<label class="control-label col-sm-2">City:</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="city"/>
					<?php if (isset($validateErr['city'])) : ?>
					<div class="help-block"><?=$validateErr['city'] ?></div>
					<?php endif ?>
				</div>
			</div>
			<div class="form-group <?php if (!empty($validateErr['address'])) : ?>has-error <?php endif ?>">
				<label class="control-label col-sm-2">Address:</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="address"/>
					<?php if(isset($validateErr['address'])) : ?>
					<div class="help-block"><?=$validateErr['address'] ?></div>
					<?php endif ?>
				</div>
			</div>
			<div class="form-group <?php if (!empty($validateErr['email'])) : ?>has-error <?php endif ?>">
				<label class="control-label col-sm-2">E-mail Address</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="email"/>
					<?php if(isset($validateErr['email'])) : ?>
					<div class="help-block"><?=$validateErr['email'] ?></div>
					<?php endif ?>
				</div>
			</div>
			<div class="form-group <?php if (!empty($validateErr['password'])) : ?>has-error <?php endif ?>">
				<label class="control-label col-sm-2">Password</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" name="password"/>
					<?php if (isset($validateErr['password'])) :?>
					<div class="help-block"><?=$validateErr['password'] ?></div>
					<?php endif ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Repeat Password</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" name="repassword"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-6 text-center">
					<button type="submit" class="btn btn-primary" name="signup">Sign Up </button>
					<button type="reset" class="btn btn-primary" name="reset">Reset</button>
				</div>
		</div>
		</form>
	</div>

	<div class="col-sm-4"></div>
	</div>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
