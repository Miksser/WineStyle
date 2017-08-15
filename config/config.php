<?php
/**
 * В файле:
 * константы с путями.
 * Подключение бд.
 * Подключение Smarty.
 * Выбор шаблона.
 * Подключение курсов Валют
 */

//подключение к бд
require_once '../library/class/db.php';

$host = '127.0.0.1';
$db = 'winestyle';
$user = 'root';
$pass = 'root';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$pdo = new DataBaseFunction($dsn, $user, $pass, $opt);


//константы для контроллеров
define('PathPrefix', '../controllers/');
define('PathPostfix', 'Controller.php');

// имя шаблона
$template = 'default';

//путь к файлам шаблонов (.tpl)
define('TemplatePrefix', "../views/{$template}/");
define('TemplatePostfix', '.tpl');

//пути к файлам шаблонов в вебпространстве
define('TemplateWebPath', "/templates/{$template}/");

//подключение Smarty
require('../library/Smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->setTemplateDir(TemplatePrefix);
$smarty->setCompileDir('../tmp/smarty/templates_c');
$smarty->setCacheDir('../tmp/smarty/cache');
$smarty->setConfigDir('../library/Smarty/configs');
$smarty->assign('templateWebPath', TemplateWebPath);

//Класс для получения курса валют
require_once '../library/class/RBC.php';