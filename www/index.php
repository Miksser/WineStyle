<?php

include_once '../config/config.php';
include_once '../library/mainFunctions.php';
/**
 * Занесение курса валют в куки
 */
if (!isset($_COOKIE['rbc'])) {
    $rbc = new RBC();
    $curs = $rbc->curs(840);

    //декордирование и удаление из курса переноса строки
    $decode = urldecode($curs);
    $replace = preg_replace("/\r\n|\r|\n/",'',$decode);
    setcookie("rbc",$replace,time()+ 86400, 'index.php');
}

$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';

$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

loadPage($smarty, $pdo, $controllerName, $actionName);

