<?php
/* Smarty version 3.1.30, created on 2017-08-15 18:09:55
  from "/var/www/WineStyle/views/default/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59930ec383da43_06157215',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c124a69878b9ec243cba3a26ee31c2b878b4ed98' => 
    array (
      0 => '/var/www/WineStyle/views/default/header.tpl',
      1 => 1502809795,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59930ec383da43_06157215 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
    <?php echo '<script'; ?>
 src="/templates/js/jquery.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/templates/js/jquery.fancybox.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/templates/js/jquery-ui.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/templates/js/main.js"><?php echo '</script'; ?>
>

    <link href="/templates/css/jquery.fancybox.css" rel="stylesheet">
    <link href="/templates/css/jquery-ui.css" rel="stylesheet">
    <link href="/templates/css/style.css" rel="stylesheet">
</head>
<body>
<div id="header">
    <div class="headerLeft"><a href="/"><h1>Список работников</h1></a></div>
    <div class="headerRight"><a href="/create/worker/"><h1>Добавить работника</h1></a></div>
</div>



<?php }
}
