<?php /* Smarty version Smarty-3.1.21, created on 2015-05-10 17:01:05
         compiled from "/var/www/cora/app/views/example.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4203916755459dadcbb605-52763338%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e38cbfc8f9797ca07091c9fce10033feebca23f4' => 
    array (
      0 => '/var/www/cora/app/views/example.tpl',
      1 => 1431295264,
      2 => 'file',
    ),
    'e6bc520e8ec56e5b9bf5633c097f1c8a44f99e46' => 
    array (
      0 => '/var/www/cora/app/views/admin_template.tpl',
      1 => 1430626235,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4203916755459dadcbb605-52763338',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55459dadd35ef5_83924865',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55459dadd35ef5_83924865')) {function content_55459dadd35ef5_83924865($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Page Title</title>
</head>
<body>

    <a href="<?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
action('HomeController@otro');<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_php_tag(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">oe chiche</a>
    app_path=  <br>
    public_path= <?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
public_path();<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_php_tag(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<br>
    asset=<?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
asset();<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_php_tag(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <br>
    action=<?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
action('HomeController@otro');<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_php_tag(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <br>

</body>
</html><?php }} ?>
