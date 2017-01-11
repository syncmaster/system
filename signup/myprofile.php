<?php
session_start ();
$user = array( );
if(isset($_SESSION['user'])) {
	$user['success'] = $_SESSION['user'];
} else {
	$user['failed'] = "You are not logged in!!! You will be redirect to login page";
	header("refresh: 5,url=login.php");
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
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<?php if (!empty($user['success'])) : ?>
					<div class="alert alert-success">
						<strong>Success!</strong> <?=$user['success']?>
						<a href="logout.php" class="btn btn-primary">Log out</a>
					</div>
					<?php endif ?>
					<?php if (!empty($user['failed'])) : ?>
					<div class="alert alert-danger">
						<strong><?=$user['failed']?></strong>
					</div>
					<?php endif ?>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>


