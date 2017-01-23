<?php
/* Smarty version 3.1.30, created on 2017-01-19 13:21:34
  from "D:\xampp\htdocs\exercises\signup\smarty\templates\login.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5880a13e95e709_36836003',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ed365b6a378b24d3100c130bac15b8f9c1968b60' => 
    array (
      0 => 'D:\\xampp\\htdocs\\exercises\\signup\\smarty\\templates\\login.html',
      1 => 1484824878,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5880a13e95e709_36836003 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<?php echo '<script'; ?>
 src='https://www.google.com/recaptcha/api.js'><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="./js/utcdiff.js"><?php echo '</script'; ?>
>
		<link href="./css/style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div id="container">
			<?php if (isset($_smarty_tpl->tpl_vars['user']->value)) {?>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="alert alert-danger">
							<strong>Error!</strong>You are already logged in your account. Please back to your profile <a href="myprofile.php" class="btn btn-primary">My Profile</a>
						</div>
					</div>
					<div class="col-md-3"></div>
				</div>
			<?php } else { ?>
				<div class="row">
					<div class="col-sm-3 col-md-3"></div>
					<div class="col-sm-6 signup col-md-6">
						<form action="login.php" method="post" class="form-horizontal" name="register">
							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-4">Email:</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['email']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
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
										<div class="g-recaptcha" data-sitekey="6LfpnREUAAAAAJ6Jwg6CoWx7X9tx0mQp9G0PL-8u"></div>
									</div>
								</div>
								<div class="col-md-3"></div>
							</div>
							<div class="row">
							<div class="col-sm-4"></div>
								<div class="form-group">
									<div class="col-sm-4 text-center">
										<button type="submit" id="button" class="btn btn-primary" name="submit">Sign In</button>
										<a href="forgot.php" class="btn btn-primary">Forgot Password</a>
										
										<input type="hidden" id="utcdiff" name="utcdiff" value=""/>
									</div>
								</div>
								<div class="col-sm-4"></div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-6">
									<?php if (!empty($_smarty_tpl->tpl_vars['loginuser']->value)) {?>
										<div class="help-block alert alert-success"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['loginuser']->value, ENT_QUOTES, 'UTF-8', true);?>
</div>
									<?php }?>
									<?php if (!empty($_smarty_tpl->tpl_vars['emailErr']->value)) {?>
										<div class="help-block alert alert-danger">
											<ul>
												<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['emailErr']->value, 'error');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
?>
													<li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
												<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

											</ul>
										</div>
									<?php }?>
								</div>
								<div class="col-sm-3"></div>
							</div>
							<div class="col-sm-4"></div>
						</form>
					</div>
					<div class="col-sm-3 col-md-3"></div>
				</div>
			<?php }?>
		</div>
		<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"><?php echo '</script'; ?>
>
	</body>
</html>
<?php }
}
