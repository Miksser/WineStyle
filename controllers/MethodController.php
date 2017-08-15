<?php

/**
 * Функция для создания миниатюр
 * @param $smarty
 * @param $db
 */
function addworkerAction($smarty, $db)
{
    $info = $_POST;

    if (isset($_FILES["file"]["type"])) {
        require_once '../library/class/image.php';

        //Используется класс AddImage для создания миниатюр
        $photo = $_FILES;
        $image = new AddImage($photo);
        $image->thumbnail(60, 60, 4);
        $image->save('upload/photo-ico/', 'jpg', false, 100);

        //Сохраняются имена новых файлов, для занесения в базу данных
        $info['photo'] = $image->newName;
        $info['photo_ico'] = $image->newIcoName;
    }

    $db->insert($info);

}

;
/**
 * Функция для получения зарплаты за указанный месяц.
 * @param $smarty
 * @param $db
 */
function getpaymentAction($smarty, $db)
{
    $info = $_POST['id'];

    //получение имени месяца
    $month = getMonth($_POST['month']);
    $rows = "workers_id, $month as salary";
    $where = implode(', ', $info);
    $where = "workers_id IN ($where)";

    $request = $db->select('payment', $rows, null, $where, 'workers_id');

    header('Content-type: application/json');
    echo json_encode($request);

}

;
/**
 * Установить премию за месяц.
 * Формируется массив @var $info в котором будет находится имя таблицы где нужно обновить значения
 * и стобцы в которых нужно обновить значения
 *
 * В If проверяется в чем премия, в сумме или в процентах. В зависимости от результата формируется строка.
 * @param $smarty
 * @param $db
 */
function setbonusAction($smarty, $db)
{
    //получение месяца
    $month = getMonth($_POST['month']);
    $whereIn = 'ID IN (' . implode(', ', $_POST['id']) . ')';

    $info = [];
    $info['table'] = $_POST['table'];

    if ($_POST['type'] == 'percent') {
        $amount = ($_POST['amount'] + 100) / 100;
        $info[$month] = $month . ' * ' . $amount;
    } else {
        $info[$month] = $month . ' + ' . $_POST['amount'];
    }

    $db->update($info, $whereIn);

}

