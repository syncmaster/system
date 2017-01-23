<?php
/* Smarty version 3.1.30, created on 2017-01-19 15:57:05
  from "D:\xampp\htdocs\exercises\signup\smarty\templates\forgot.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5880c5b1edcb02_34981200',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94a11be44e72c1f4e5d8b3a0ea77e51bd4c11c9d' => 
    array (
      0 => 'D:\\xampp\\htdocs\\exercises\\signup\\smarty\\templates\\forgot.html',
      1 => 1484833942,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5880c5b1edcb02_34981200 (Smarty_Internal_Template $_smarty_tpl) {
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
		<link href="./css/style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 signup">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<form method="post" action="forgot.php" class="form-horizontal" name="forgot">
								<div class="row">
									<div class="form-group">
										<label class="col-md-3 control-label">E-mail:</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="email" value="" />
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
								</div>
								<div class="row">
									<div class="col-md-4 col-xs-3"></div>
									<div class="col-md-4 col-xs-6">
										<div class="form-group">
											<button type="submit" class="btn btn-primary" name="submit">Reset Password</button>
										</div>
									</div>
									<div class="col-md-4 col-xs-3"></div>
								</div>
								<div class="row">
									<div class="col-md-12 col-xs-12">
										<?php if (!empty($_smarty_tpl->tpl_vars['reset']->value)) {?>
											<div class="help-block alert alert-success"><?php echo $_smarty_tpl->tpl_vars['reset']->value;?>
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
								</div>
							</form>
						</div>
						<div class="col-md-3"></div>
					</div>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
	<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"><?php echo '</script'; ?>
>
	</body>
</html><?php }
}
