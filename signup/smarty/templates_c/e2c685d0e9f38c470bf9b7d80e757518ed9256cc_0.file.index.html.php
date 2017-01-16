<?php
/* Smarty version 3.1.30, created on 2017-01-12 14:04:32
  from "D:\xampp\htdocs\exercises\signup\smarty\templates\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58777ee06eca85_80843445',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e2c685d0e9f38c470bf9b7d80e757518ed9256cc' => 
    array (
      0 => 'D:\\xampp\\htdocs\\exercises\\signup\\smarty\\templates\\index.html',
      1 => 1484226266,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58777ee06eca85_80843445 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_spacify')) require_once 'D:\\xampp\\htdocs\\exercises\\signup\\smarty\\libs\\plugins\\modifier.spacify.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="alert alert-success"><?php echo $_smarty_tpl->tpl_vars['welcome']->value;?>
</div>
					Question:Will we ever have time travel?
					answers: <?php echo smarty_function_question(array(),$_smarty_tpl);?>

					
					<p>Friend List:</p>
					<?php
$__section_i_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_i']) ? $_smarty_tpl->tpl_vars['__smarty_section_i'] : false;
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['friends']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total != 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?> 
						<?php echo $_smarty_tpl->tpl_vars['friends']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)];?>
</br>; 
					<?php
}
}
if ($__section_i_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_i'] = $__section_i_0_saved;
}
?>	
				</div>
				<div class="col-md-3">
					<?php echo smarty_modifier_spacify($_smarty_tpl->tpl_vars['something']->value);?>

					</br>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['input']->value, ENT_QUOTES, 'UTF-8', true);?>
</br>
					<?php echo (($tmp = @$_smarty_tpl->tpl_vars['number']->value)===null||$tmp==='' ? "5" : $tmp);?>
</br>
					<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['number']->value);?>
</br>
					<?php echo sprintf("%d",$_smarty_tpl->tpl_vars['number']->value);?>
</br>
				</div>
			</div>
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
