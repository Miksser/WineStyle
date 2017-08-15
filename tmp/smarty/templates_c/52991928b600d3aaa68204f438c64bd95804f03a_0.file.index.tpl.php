<?php
/* Smarty version 3.1.30, created on 2017-08-15 19:26:38
  from "/var/www/WineStyle/views/default/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_599320be98f0f4_41303882',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52991928b600d3aaa68204f438c64bd95804f03a' => 
    array (
      0 => '/var/www/WineStyle/views/default/index.tpl',
      1 => 1502814396,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_599320be98f0f4_41303882 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="calendar"></div>
<div class="info">
    <div class="container">
        <div class="control-group">
            <h1>Выбрать курс:</h1>
            <label class="control control--radio">RUB
                <input type="radio" name="Currency" id="RUB" checked="checked" value="RUB">
                <div class="control__indicator"></div>
            </label>
            <label class="control control--radio">USD
                <input type="radio" name="Currency" id="USD" value="USD">
                <div class="control__indicator"></div>
            </label>
        </div>

        <div class="control-group">
            <h1>Профессии</h1>

            <form action="?/" method="get">
                <input type="hidden" name="where[]" value="position">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arFilter']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
                    <label class="control control--checkbox"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>

                        <input type="checkbox" name="position[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"
                               <?php if (isset($_smarty_tpl->tpl_vars['CheckedStatus']->value) && in_array($_smarty_tpl->tpl_vars['item']->value['id'],$_smarty_tpl->tpl_vars['CheckedStatus']->value)) {?>checked<?php }?>>
                        <div class="control__indicator"></div>
                    </label>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <input type="submit" class="button -regular center">
            </form>
        </div>

        <div class="control-group">
            <h1>Премия</h1>

            <form id="bonus" action="javascript:void(null);">
                <input type="number" name="bonusNumber" id="bonusNumber" required>
                <h4>увелчить в:</h4>
                <div class="select">
                    <select name="bonusType" id="chooseBonusType">
                        <option name="bonusPercent" id="bonusPercent" value="percent">Процентах</option>
                        <option name="bonusAmount" id="bonusAmount" value="amount">Сумме</option>
                    </select>
                </div>
                <input type="submit" class="button -regular center">
            </form>
        </div>
    </div>

    <div class="table-users">
        <div class="header-table">Рабочие</div>
        <table id="workers" cellpadding="0">
            <thead>
            <th>№</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Должность</th>
            <th>Зарплата</th>
            <th>Зарплата за месяц</th>
            <th>Фото</th>
            </thead>
            <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arWorkers']->value, 'item', false, NULL, 'worker', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_worker']->value['iteration']++;
?>
                <tr>
                    <td class="id" number='<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'>
                        <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_worker']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_worker']->value['iteration'] : null);?>

                    </td>
                    <td class="second_name">
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['second_name'];?>

                    </td>
                    <td class="first_name">
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['first_name'];?>

                    </td>
                    <td class="position">
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['position'];?>

                    </td>
                    <td class="salary">
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['salary'];?>

                    </td>
                    <td class="month" worker='<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'>
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['month'];?>

                    </td>
                    <td class="photo">
                        <a class="fancybox" href="/upload/<?php echo $_smarty_tpl->tpl_vars['item']->value['photo'];?>
">
                            <img alt="Worker Photo" src="/upload/photo-ico/<?php echo $_smarty_tpl->tpl_vars['item']->value['photo_ico'];?>
"
                                 style="opacity: 1"></a>
                    </td>
                </tr>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </tbody>
        </table>
    </div>


</div><?php }
}
