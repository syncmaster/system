<?php

class AuthUser extends BaseController
{
	
	public function register()
	{
		$this->smarty->assign('title', 'Register');

		if (!isset($_POST['signup'])) {
			return $this->smarty->fetch("register.html");
		}

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

		//Variables for signup form
		$this->smarty->assign('firstname', $firstname);
		$this->smarty->assign('lastname', $lastname);
		$this->smarty->assign('age', $age);
		$this->smarty->assign('country', $country);
		$this->smarty->assign('city', $city);
		$this->smarty->assign('address', $address);
		$this->smarty->assign('email', $email);
		$this->smarty->assign('password', $password);
		$this->smarty->assign('repassword', $repassword);

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
		} else {
			$sql = "
				SELECT `email`
				FROM users
				WHERE `email` = '" . $this->db->real_escape_string($email) . "' ";
			$emailresult = $this->db->query($sql);
			if ($emailresult->num_rows) {
				$this->$validateErr['email'] = "E-mail address is already registered";
			}
		}

		$recaptcha_secret = "6LfpnREUAAAAAPbCRYaQeSCiIZjDhE5I3MRQyEda";
		$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
		$response = json_decode($response, true);

		if ($response["success"] === false){
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
		$password = password_hash($password, PASSWORD_DEFAULT);
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
				'" .$this->db->real_escape_string($firstname). "',
				'" .$this->db->real_escape_string($lastname). "',
				'" .$this->db->real_escape_string($age). "',
				'" .$this->db->real_escape_string($country). "',
				'" .$this->db->real_escape_string($city). "',
				'" .$this->db->real_escape_string($address). "',
				'" .$this->db->real_escape_string($email). "',
				'" .$this->db->real_escape_string($password). "'
			)
		";
		if ($this->db->query($sql)) {
			$signup = "Your account had been created..!";

			$title = "Welcome to our website |www.domain.com|";
			$messege = "Thank you for sign up in our website";
			$headtext = "We apreciate your account and we are here to help you wuth what we can</br>Feel Free to contact with us whn u have any question about your profile or some suggestions?";
			$secmsg = "Have a nice day";
			$this->smarty->assign('title', $title);
			$this->smarty->assign("email", $email);
			$this->smarty->assign('messege', $messege);
			$this->smarty->assign('headtext', $headtext);
			$this->smarty->assign('secmsg', $secmsg);
			$this->mail->Subject = 'Thank you for your sign up';
			$this->mail->addAddress($email);
			$message = $this->smarty->fetch('mail.html');
			$this->mail->MsgHTML($message);
			$this->mail->Send();
			$this->smarty->assign('signup', $signup);
		} else {
			$signupErr = "something went wrong";
		}
	}

		$this->smarty->assign('validateErr', $validateErr);

		return $this->smarty->fetch("register.html");
	}

	public function login()
	{
		global $yourbrowser;
		global $utcdiff;
		$this->smarty->assign('title', 'Login');
		define('TIMEOUT', 5*60);

		if (isset($_POST['submit'])) {
			$email = isset($_POST['email']) ? trim($_POST['email']) : '';
			$password = isset($_POST['password']) ? trim($_POST['password']) : '';
			$utcdiff = isset($_POST['utcdiff']) ? trim($_POST['utcdiff']) : '';
			$emailErr = array ();
			$recaptcha_secret = "6LfpnREUAAAAAPbCRYaQeSCiIZjDhE5I3MRQyEda";
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
			$response = json_decode($response, true);

			//Variables in smarty
			$this->smarty->assign('email', $email);
			$this->smarty->assign('password', $password);
			if (isset($this->session['timeout']) && (time() - $this->session['timeout']) < TIMEOUT) {
				$emailErr['loginerr'] = "wait ".(TIMEOUT/60)." min(s) for another attempt";
			} else if (isset($this->session['fail']) && $this->session['fail'] >= 3) {
				$emailErr['loginerr'] = "wait ".(TIMEOUT/60)." min(s) for another attempt";
				$this->session['timeout'] = time();
				$this->session['fail'] = 0;
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
								`email` = '" . $this->db->real_escape_string($email) . "'
							LIMIT 1";
					if ($result = $this->db->query($sql)) {

						if (!$result->num_rows) {
							$emailErr['user'] = "Invalid user! Your information is not in our database";

							if (isset($this->session['fail'])){
								$this->session['fail'] = $this->session['fail'] +1;
							} else {
								$this->session['fail'] = 1;
							}

						} else {

							$user = $result->fetch_assoc() ;


							if (password_verify($password, $user['password'])) {
								$loginuser = "Hello, ".$user['firstname']." ".$user['lastname']."\n";
								$userid = $user['id'];
								$this->session['user'] = $loginuser;
								$this->session['utcdiff'] = $utcdiff;
								$this->smarty->assign('loginuser', $loginuser);
								$this->smarty->assign('utcdiff', $this->session['utcdiff']);
								$sql = "
									INSERT INTO logininfo (
										`user_id`,
										`date`,
										`browser`
									) VALUES (
										'" .$this->db->real_escape_string($userid). "',
										NOW(),
										'" .$this->db->real_escape_string($yourbrowser). "'
									)
								";
								$this->db->query($sql);
								header("Location:../myprofile");
								exit;
							} else {
								$emailErr['user'] = "Invalid user! Your information is not in our database";
							}
							//variables smarty
						}
					} else {
						echo "Error!";
						echo $this->db->connect_error;
					}
				}
			$this->smarty->assign('emailErr', $emailErr);
		}
		return $this->smarty->fetch("login.html");
	}

	public function forgotPassword()
	{
		$this->smarty->assign('title', 'Forgot Password');

		if (isset($_POST['submit'])) {
			$email = isset($_POST['email']) ? trim($_POST['email']) : '' ;
			$recaptcha_secret = "6LfpnREUAAAAAPbCRYaQeSCiIZjDhE5I3MRQyEda";
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
			$response = json_decode($response, true);
			$reset = "";
			$emailErr = array();
			$this->smarty->assign("email", $email);

			If (empty($email)) {
				$emailErr['empty'] = "Please fill your E-mail Address";
				$this->smarty->assign("emailErr", $emailErr['empty']);
			} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$emailErr['valid'] = "Please enter Valid Email-Address";
				$this->smarty->assign("emailErr", $emailErr['valid']);
			} /*else if ($response['success'] === false) {
				$emailErr['captcha'] = "Please fill the captcha";
				$this->smarty->assign("emailErr", $emailErr['captcha']);
			} */else {
				$sql = "SELECT `email`
					FROM users
					WHERE
					`email` = '" .$this->db->real_escape_string($email). "'
					";
				$emailresult = $this->db->query($sql);

				if (!$emailresult->num_rows) {
					$emailErr['email'] = "Your e-mail address is not in our database";
					$this->smarty->assign("emailErr", $emailErr['email']);
				}
			}

			if (!count($emailErr)) {
				$random = md5(microtime());
				$sql = "UPDATE users SET
				`tokens` = '" .$this->db->real_escape_string($random). "',
				`expire_date` = NOW()
				WHERE
				`email` = '" .$this->db->real_escape_string($email). "' ";
				if ($this->db->query($sql)) {
					$reset = "Check your e-mail for your unique link to renew password";
					$this->smarty->assign("reset", $reset);
					$token = $random;
					$url = 'http://'. $_SERVER['HTTP_HOST'] . '/exercises/signup/auth/reset?token='.$token ;
					$this->smarty->assign("url", $url);
					$this->smarty->assign("email", $email);
					$title = "Welcome to our website |www.domain.com|";
					$messege = "Hello";
					$headtext = "We send you e-mail with unique link</br>Where you can renew your password;";
					$secmsg = "Please click link and you will be redirect to a page";
					$this->smarty->assign('title', $title);
					$this->smarty->assign('messege', $messege);
					$this->smarty->assign('headtext', $headtext);
					$this->smarty->assign('secmsg', $secmsg);
					$this->mail->Subject = 'Reset Your Password';
					$this->mail->addAddress($email);
					$message = $this->smarty->fetch('mail_password.html');
					$this->mail->MsgHTML($message);
					$this->mail->send();
				}

			}

			$this->smarty->assign('emailErr', $emailErr);
		}
		return $this->smarty->fetch("forgot.html");
	}

	public function renewPassword ()
	{
		$this->smarty->assign('title', 'Reset Password');
		define('TIMEOUT', 2*60*60);

		$success = "";
		$passErr = array();
		if (isset($_GET['token']) && mb_strlen($_GET['token']) !== 32) {
			$tokenErr = "your link is not valid Back to ->";
			$this->smarty->assign("tokenErr", $tokenErr);
			header("refresh: 10, url=forgot.php");
		}
		
		if (!isset($_GET['token'])) {
			$tokenErr = "your link is not valid Back to ->";
			$this->smarty->assign("tokenErr", $tokenErr);
			header("refresh: 10, url=forgot.php");
		} else {
			$sql = "SELECT `tokens`
					FROM `users`
					WHERE
					`tokens` = '" .$_GET['token']. "'
					";
			if ($result = $this->db->query($sql)) {
				if (!$result->num_rows) {
					$tokenErr = "your link is not valid Back to ->";
					$this->smarty->assign("tokenErr", $tokenErr);
					header("refresh: 10, url=forgot.php");
				} else {
					$user = $result->fetch_assoc() ;

					if ($_GET['token'] !==$user['tokens']) {
						$tokenErr = "your link is not valid Back to ->";
					$this->smarty->assign("tokenErr", $tokenErr);
					header("refresh: 10, url=/auth/forgot");
					} else {
						$tokens = $_GET['token'];
						$this->smarty->assign("tokenkey", $tokens);
					}
				}
			}
		}

		if (isset($_POST['submit'])) {

			$password = isset($_POST['password']) ? trim($_POST['password']) : '';
			$repassword = isset($_POST['repassword']) ? trim($_POST['repassword']) : '';
			$recaptcha_secret = "6LfpnREUAAAAAPbCRYaQeSCiIZjDhE5I3MRQyEda";
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
			$response = json_decode($response, true);

			$this->smarty->assign("password", $password);

			 if (empty($password) || empty($repassword)) {
				$passErr['empty'] = "Please fill the fileds";
				$this->smarty->assign("passErr", $passErr['empty']);
			} else if ($password !== $repassword) {
				$passErr['match'] = "Your password did not match!!!";
				$this->smarty->assign("passErr", $passErr['match']);
			} else if (mb_strlen($password) < 8 ) {
				$passErr['length'] = "your password need to be a more than 8 symbols";
				$this->smarty->assign("passErr", $passErr['length']);
			} else if ($response['success'] === false ) {
				$passErr['captcha'] = "Please complete Captcha";
				$this->smarty->assign("passErr", $passErr['captcha']);
			} else {
				$password = password_hash($password, PASSWORD_DEFAULT);
				$sql = "UPDATE users SET
							`password` = '" .$this->db->real_escape_string($password). "'
						WHERE
							`tokens` = '" .$this->db->real_escape_string($_GET['token']). "'
						";

				if($this->db->query($sql)) {
					$success = "We changed your password succesfully !!!";
					$this->smarty->assign("success", $success);

					$sql = "UPDATE `users` SET
								`tokens` = ''
							WHERE
								`tokens` = '" .$_GET['token']. "';
								";
					$this->db->query($sql);
				} else {
					$fail = "We did not change your password please back after few hours.";
					$this->smarty->assign("fail", $fail);
				}
			}

		$this->smarty->assign("passErr", $passErr);
		}

		return $this->smarty->fetch("renew.html");

	}

	public function logOut()
	{
		session_destroy();
		header("Location:../");
		return $this->smarty->display("logout.html");
	}

}