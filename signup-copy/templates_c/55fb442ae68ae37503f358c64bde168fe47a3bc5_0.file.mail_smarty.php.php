<?php
/* Smarty version 3.1.30, created on 2017-01-16 16:44:14
  from "D:\xampp\htdocs\exercises\signup\smarty\mail_smarty.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_587cdc3edacc82_02871304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55fb442ae68ae37503f358c64bde168fe47a3bc5' => 
    array (
      0 => 'D:\\xampp\\htdocs\\exercises\\signup\\smarty\\mail_smarty.php',
      1 => 1484575837,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_587cdc3edacc82_02871304 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php
';?>require ("libs/Smarty.class.php");
include 'boot.php';
$smarty = new Smarty();

$smarty->error_reporting = error_reporting() &~E_NOTICE;

$title = "Thanks for your sign up";
$smarty->assign ('title', $title);

$messege = "Thank you for sign up in our website";
$secmsg = "we apreacite it Have a nice day";

$smarty->assign ('messege', $messege);
$smarty->assign ('secmsg', $secmsg);


$smarty->display("mail.html");<?php }
}
