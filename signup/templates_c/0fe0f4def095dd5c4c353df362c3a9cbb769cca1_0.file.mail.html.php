<?php
/* Smarty version 3.1.30, created on 2017-01-19 13:07:08
  from "D:\xampp\htdocs\exercises\signup\smarty\templates\mail.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58809ddc5ef882_07805628',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0fe0f4def095dd5c4c353df362c3a9cbb769cca1' => 
    array (
      0 => 'D:\\xampp\\htdocs\\exercises\\signup\\smarty\\templates\\mail.html',
      1 => 1484823990,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58809ddc5ef882_07805628 (Smarty_Internal_Template $_smarty_tpl) {
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
		
	</head>
	<body>
		<div class="container">
			<h1><?php echo $_smarty_tpl->tpl_vars['messege']->value;?>
</h1></br>
			<h4><?php echo $_smarty_tpl->tpl_vars['headtext']->value;?>
</h4></br>
			<h3><?php echo $_smarty_tpl->tpl_vars['secmsg']->value;?>
</h3>
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
