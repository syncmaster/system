<?php
include '../app/boot.php';
include_once 'browser.func.php';



define('TIMEOUT', 5*60);

$emailErr = array ( );
if (isset($_POST['submit'])) {
	$email = isset($_POST['email']) ? trim($_POST['email']) : '';
	$password = isset($_POST['password']) ? trim($_POST['password']) : '';
	$utcdiff = isset($_POST['utcdiff']) ? trim($_POST['utcdiff']) : '';
	$recaptcha_secret = "6LfpnREUAAAAAPbCRYaQeSCiIZjDhE5I3MRQyEda";
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
	$response = json_decode($response, true);

	//Variables in smarty
	$smarty->assign('email', $email);
	$smarty->assign('password', $password);
	$smarty->assign('utcdiff', $utcdiff);

	if (isset($_SESSION['timeout']) && (time() - $_SESSION['timeout']) < TIMEOUT) {
		$emailErr['loginerr'] = "wait ".(TIMEOUT/60)." min(s) for another attempt";
	} else if (isset($_SESSION['fail']) && $_SESSION['fail'] >= 3) {
		$emailErr['loginerr'] = "wait ".(TIMEOUT/60)." min(s) for another attempt";
		$_SESSION['timeout'] = time();
		$_SESSION['fail'] = 0;
	} else if (empty($email) || empty($password)) {
		$emailErr['empty'] = "Please enter the email and password fields";
	} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$emailErr['valid'] = "Your e-mail address is not valid!";
	}/* else if ($response['success'] === false) {
		$emailErr['valid'] = 'Please complete reCaptcha';
	}*/ else {
			$sql = "SELECT
						`id`,
						`firstname`,
						`lastname`,
						`password`
					FROM `users`
					WHERE
						`email` = '" . $connect->real_escape_string($email) . "'
					LIMIT 1";
			if ($result = $connect->query($sql)) {
				 
				if (!$result->num_rows) {
					$emailErr['user'] = "Invalid user! Your information is not in our database";

					if (isset($_SESSION['fail'])){
						$_SESSION['fail'] = $_SESSION['fail'] +1;
					} else {
						$_SESSION['fail'] = 1;
					}

				} else { 
					
					$user = $result->fetch_assoc() ;
					
					
					if (password_verify($password, $user['password'])) {
						$loginuser = "Hello, ".$user['firstname']." ".$user['lastname']."\n";
						$userid = $user['id'];
						$_SESSION['user'] = $loginuser;
						$_SESSION['utcdiff'] = $utcdiff;
						$smarty->assign('loginuser', $loginuser);
						$smarty->assign('utcdiff', $_SESSION['utcdiff']);
						$sql = "
							INSERT INTO logininfo (
								`user_id`,
								`date`,
								`browser`
							) VALUES (
								'" .$connect->real_escape_string($userid). "',
								NOW(),
								'" .$connect->real_escape_string($yourbrowser). "'
							)
						";
						$connect->query($sql);
						header("Location: myprofile.php");
						exit;
					} else {
						$emailErr['user'] = "Invalid user! Your information is not in our database";
					}
					//variables smarty


					
				}
			} else {
				echo "Error!";
				echo $connect->connect_error;
			}
		}
	
$smarty->assign('emailErr', $emailErr);
}
$smarty->display("../templates/login.html");