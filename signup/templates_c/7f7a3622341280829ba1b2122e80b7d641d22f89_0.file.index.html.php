<?php
/* Smarty version 3.1.30, created on 2017-01-23 09:36:17
  from "D:\xampp\htdocs\exercises\signup\templates\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5885b271061a85_41799879',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f7a3622341280829ba1b2122e80b7d641d22f89' => 
    array (
      0 => 'D:\\xampp\\htdocs\\exercises\\signup\\templates\\index.html',
      1 => 1485156973,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5885b271061a85_41799879 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<?php echo '<script'; ?>
 src='https://www.google.com/recaptcha/api.js'><?php echo '</script'; ?>
>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div class="container">
	<?php if (isset($_smarty_tpl->tpl_vars['user']->value)) {?>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="alert alert-danger"><strong>Error!</strong>You are already registered. Please back to your profile <a href="myprofile.php" class="btn btn-primary">My Profile</a></div>
			</div>
			<div class="col-md-3"></div>
		</div>
	<?php } elseif (!isset($_smarty_tpl->tpl_vars['user']->value)) {?>
		<div class="row">
			<div class="col-md-3 col-sm-3"></div>
			<div class="col-md-6 signup col-sm-6">
				<form action="index.php" method="post" class="form-horizontal" name="register">
					<div class="row">
						<div class="form-group <?php if (!empty($_smarty_tpl->tpl_vars['firstnameErr']->value)) {?>has-error<?php }?>">
							<label class="control-label col-sm-4">FirstName:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['firstname']->value;?>
" name="firstname"/>
								<?php if (isset($_smarty_tpl->tpl_vars['firstnameErr']->value)) {?>
									<div class="help-block alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['firstnameErr']->value;?>
</div>
								<?php }?>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($_smarty_tpl->tpl_vars['lastnameErr']->value)) {?>has-error<?php }?>">
							<label class="control-label col-sm-4">LastName:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="lastname"/ value="<?php echo $_smarty_tpl->tpl_vars['lastname']->value;?>
">
								<?php if (isset($_smarty_tpl->tpl_vars['lastnameErr']->value)) {?>
									<div class="help-block alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['lastnameErr']->value;?>
</div>
								<?php }?>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($_smarty_tpl->tpl_vars['ageErr']->value)) {?>has-error<?php }?>" >
							<label class="control-label col-sm-4">Age:</label>
							<div class="col-sm-6">
								<input type="number" class="form-control" name="age"/ value="<?php echo $_smarty_tpl->tpl_vars['age']->value;?>
">
								<?php if (isset($_smarty_tpl->tpl_vars['ageErr']->value)) {?>
									<div class="help-block alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['ageErr']->value;?>
</div>
								<?php }?>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($_smarty_tpl->tpl_vars['countryErr']->value)) {?>has-error<?php }?>">
							<label class="control-label col-sm-4">Country:</label>
							<div class="col-sm-6">
								<select type="text" class="form-control" name="country" value="<?php echo $_smarty_tpl->tpl_vars['country']->value;?>
">
									<option value="selected" <?php if (!mb_strlen($_smarty_tpl->tpl_vars['country']->value)) {?>selected<?php }?> disabled>Please choose country</option>
									<option value="Bulgaria" <?php if ($_smarty_tpl->tpl_vars['country']->value === "Bulgaria") {?>selected<?php }?>>Bulgaria</option>
									<option value="England" <?php if ($_smarty_tpl->tpl_vars['country']->value === "England") {?>selected<?php }?>>England</option>
									<option value="USA" <?php if ($_smarty_tpl->tpl_vars['country']->value === "USA") {?>selected<?php }?>>USA</option>
									<option value="Roumania" <?php if ($_smarty_tpl->tpl_vars['country']->value === "Roumania") {?>selected<?php }?>>Roumania</option>
									<option value="Serbia" <?php if ($_smarty_tpl->tpl_vars['country']->value === "Serbia") {?>selected<?php }?>>Serbia</option>
								</select>
								<?php if (isset($_smarty_tpl->tpl_vars['countryErr']->value)) {?>
									<div class="help-block alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['countryErr']->value;?>
</div>
								<?php }?>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($_smarty_tpl->tpl_vars['cityErr']->value)) {?>has-error<?php }?>">
							<label class="control-label col-sm-4">City:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="city" value="<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
"/>
								<?php if (isset($_smarty_tpl->tpl_vars['cityErr']->value)) {?>
									<div class="help-block alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['cityErr']->value;?>
</div>
								<?php }?>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($_smarty_tpl->tpl_vars['addressErr']->value)) {?>has-error<?php }?>">
							<label class="control-label col-sm-4">Address:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="address" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
"/>
								<?php if (isset($_smarty_tpl->tpl_vars['addressErr']->value)) {?>
									<div class="help-block alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['addressErr']->value;?>
</div>
								<?php }?>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($_smarty_tpl->tpl_vars['emailErr']->value)) {?>has-error<?php }?>">
							<label class="control-label col-sm-4">E-mail Address</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
"/>
								<?php if (isset($_smarty_tpl->tpl_vars['emailErr']->value)) {?>
									<div class="help-block alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['emailErr']->value;?>
</div>
								<?php }?>
							</div>
							<div class="col-sm-2"></div>
						</div>
					</div>
					<div class="row">
						<div class="form-group <?php if (!empty($_smarty_tpl->tpl_vars['passwordErr']->value)) {?>has-error<?php }?>">
							<label class="control-label col-sm-4">Password</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="password"/>
								<?php if (isset($_smarty_tpl->tpl_vars['passwordErr']->value)) {?>
									<div class="help-block alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['passwordErr']->value;?>
</div>
								<?php }?>
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
						<div class="col-md-6">
							<div class="form-group">
								<div class="g-recaptcha" data-sitekey="6LfpnREUAAAAAJ6Jwg6CoWx7X9tx0mQp9G0PL-8u"></div>
							</div>
						</div>
						<div class="col-md-2"></div>
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
								<?php if (!empty($_smarty_tpl->tpl_vars['signup']->value)) {?>
									<div class="alert alert-success col-sm-12"><p><?php echo $_smarty_tpl->tpl_vars['signup']->value;?>
</p></div>
								<?php }?>
								<?php if (!empty($_smarty_tpl->tpl_vars['validateErr']->value)) {?>
									<div class="help-block alert alert-danger">
										<ul>
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['validateErr']->value, 'error');
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
							<div class="col-sm-2"></div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-3 col-sm-3"></div>
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
