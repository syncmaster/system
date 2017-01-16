<?php
/* Smarty version 3.1.30, created on 2017-01-12 12:31:12
  from "D:\xampp\htdocs\exercises\signup\smarty\index.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58776900e225c7_98004730',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0cf19a3eb29efc193ce2444d36d7d576872340b' => 
    array (
      0 => 'D:\\xampp\\htdocs\\exercises\\signup\\smarty\\index.php',
      1 => 1484220667,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58776900e225c7_98004730 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php
';?>require ("libs/Smarty.class.php");
include ("../config.php");
$smarty = new Smarty();

$title = "Hello smarty";
$smarty->assign ("title", $title);

$welcome= "Success Welcome to Samrty php engine";
$smarty->assign ("welcome", $welcome);

$signup = "";
$validateErr = "";
$lastnamerr = "";
$firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
$lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';

if (isset($_POST['signup'])) {
	if (empty($firstname)) {
		$validateErr = "vavedi ime ";

	}

	if (empty($lastname)) {
		$lastnamerr = "vavedi 2ro ime";

	}

}
$smarty->assign ("firstname", $firstname);
$smarty->assign ("lastname", $lastname);
$smarty->assign ("signup", $signup);
$smarty->assign ("validateErr", $validateErr);
$smarty->assign ("lastnamerr", $lastnamerr);

$smarty->display("index.php");
<?php }
}
