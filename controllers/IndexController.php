<?php
/**
 * формирование главной страницы
 * @param $smarty Шаблонизатор
 */

/**
 * @var $CheckedStatus - проверка на выбранный фильтр. Если фильтр(ы) выбран,
 * то заполняется из $_GET['position']
 * @param $smarty
 * @param $db
 */
function indexAction($smarty, $db)
{

    $CheckedStatus = null;
    $where = null;

    if (isset($_GET['position'])) {
        $CheckedStatus = $_GET['position'];
        $GetWhereArray = $_GET['where'];

        /**
         * Сборка Where для запроса. Ключи = имя параметра, значение = значение параметра
         */
        foreach ($GetWhereArray as $WhereRow) {
            foreach ($_GET[$WhereRow] as $t) {
                $where .= "workers.$WhereRow = '$t' OR ";
            };
        };

        //удаляется последний OR из WHERE
        $where = preg_replace('/(OR )$/', ' ', $where);
    };

    //get now month
    $date = date('F');

    $join = [
        ['payment', 'workers.id=payment.workers_id'],
        ['professions', 'workers.position=professions.id']
    ];
    $rows = "workers.id, workers.first_name, workers.second_name, workers.photo, workers.photo_ico, 
    professions.name as position, workers.salary, payment.year, payment.$date as month";
    $order = 'workers.id';

    //Получение информации для страницы.ФИО, ЗП, Профессия
    $arWorkers = $db->select('workers', $rows, $join, $where, $order);
    //загрузка названий профессий для создания фильтра
    $arFilter = $db->select('professions', 'id, name', null, null, 'id');


    $smarty->assign('pageTitle', 'Главная страница сайта');
    $smarty->assign('arWorkers', $arWorkers);
    $smarty->assign('arFilter', $arFilter);
    $smarty->assign('CheckedStatus', $CheckedStatus);


    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');

}