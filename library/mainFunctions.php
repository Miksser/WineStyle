<?php

/**
 * @param $controlleName
 * @param string $actionName
 *
 */

function loadPage($smarty, $db, $controlleName, $actionName = 'index')
{
    include_once PathPrefix . $controlleName . PathPostfix;

    $function = $actionName . 'Action';
    $function($smarty, $db);
}

/**
 * Загрузка шаблона
 * @param $smarty
 * @param $templateName
 */

function loadTemplate($smarty, $templateName)
{
    $smarty->display($templateName . TemplatePostfix);
}

/**
 * Дебаггер, останавливает сайт при die = 1
 * @param null $value переменная которую надо проверить
 * @param int $die остановить работу сайта 1 да 0 нет
 */
function d($value = null, $die = 1)
{
    echo 'Debug: </br></pre>';
    print_r($value);
    echo '</pre>';

    if ($die) die;
}

/**
 * Получение имени месяца по номеру
 * @param $month - номер месяца
 * @return string - имя латиницой
 */
function getMonth($month)
{
    $getMonth = intval($month);
    $getMonth = gregoriantojd($getMonth, 1, 1);
    $month = jdmonthname($getMonth, 1);
    return $month;
}