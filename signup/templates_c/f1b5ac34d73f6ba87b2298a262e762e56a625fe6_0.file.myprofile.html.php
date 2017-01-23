<?php
/* Smarty version 3.1.30, created on 2017-01-19 15:25:00
  from "D:\xampp\htdocs\exercises\signup\smarty\templates\myprofile.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5880be2c802c85_56223360',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f1b5ac34d73f6ba87b2298a262e762e56a625fe6' => 
    array (
      0 => 'D:\\xampp\\htdocs\\exercises\\signup\\smarty\\templates\\myprofile.html',
      1 => 1484823997,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5880be2c802c85_56223360 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="./css/style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<?php if (empty($_smarty_tpl->tpl_vars['user']->value)) {?>
						<div class="alert alert-danger">
							<strong>You are not logged in !!! You will be redirect to login page</strong>
						</div>
					<?php } else { ?>
						<div class="alert alert-success">
							<strong>Success!</strong><?php echo $_smarty_tpl->tpl_vars['user']->value;?>

							<a href="logout.php" class="btn btn-primary">Log Out</a>
						</div>	
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['utcdiff']->value)) {?>
					<p><?php echo $_smarty_tpl->tpl_vars['utcdiff']->value;?>
 minutes difference bewtween UTC time;</p>
					<?php }?>
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
