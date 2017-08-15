<?php
/* Smarty version 3.1.30, created on 2017-08-15 18:05:20
  from "/var/www/WineStyle/views/default/createWorker.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59930db075ae75_53267202',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f4d0bd267b11ca89d64a6f23629f061dbec2de07' => 
    array (
      0 => '/var/www/WineStyle/views/default/createWorker.tpl',
      1 => 1502809520,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59930db075ae75_53267202 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container_worker">
    <div class="row header">
        <h1 style="color: black">Новый работник</h1>
    </div>
    <div class="row body">

        <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" id="table" name="table" value="workers">
            <ul>
                <li>
                    <p class="left">
                        <label for="first_name">Имя</label>
                        <input type="text" name="first_name" id="first_name" value="">
                    </p>
                    <p class="pull-right">
                        <label for="second_name">Фамилия</label>
                        <input type="text" name="second_name" id="second_name" value="">
                    </p>
                </li>
                <li>
                    <p class="left">
                        <label for="salary">Оплата</label>
                        <input type="number" min="0" step="1" name="salary" id="salary" value="">
                    </p>
                </li>
                <li>
                    <div class="divider"></div>
                </li>
                <li>
                    <div class="control-group controlWorker">
                        <div class="select">
                            <label>Выберите профессию</label><br/>
                            <select id='position' name="position" multiple size="3">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arProfessions']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </select>
                        </div>
                    </div>
                </li>
                <li>
                    <div id="selectImage">
                        <label for="file">Выберите фото</label><br/>
                        <input type="file" name="file" id="file" required/>
                    </div>
                </li>
                <li>
                    <input class="button -regular center" type="submit" value="Отправить"/>
                </li>
            </ul>
        </form>

    </div>
</div><?php }
}
