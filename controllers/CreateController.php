<?php
/**
 * Add new worker
 */

/**
 * $arProfessions - получаем все професии, чтобы привзать к рабочему.
 * @param $smarty
 * @param $db
 */
function workerAction($smarty, $db)
{
    $arProfessions = $db->select('professions');

    $smarty->assign('pageTitle', 'Добавить нового работника');
    $smarty->assign('arProfessions', $arProfessions);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'createWorker');
    loadTemplate($smarty, 'footer');
}
