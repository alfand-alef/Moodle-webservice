<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Функция для генерации случайного пароля
function getRandomPassword($passLen = 10) {
    $alfa = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $symbols = '!@#$%&?';
    $numbers = '1234567890';
    $pass = '';
    $alfaLength = strlen($alfa) - 1;
    $symLength = strlen($symbols) - 1;
    $numLength = strlen($numbers) - 1;
    for ($i = 0; $i < $passLen; $i++) {
        $n_s = rand(0, $alfaLength);
        $pass = $pass . $alfa[$n_s];
    }
    $s_s = rand(0, $symLength);
    $n_n = rand(0, $numLength);
    $pass = $symbols[$s_s] . $pass . $numbers[$n_n];
    return $pass;
}

$token = '7438c75e1f45e84c34b6fbc52c39ac83'; //Ключ пользователя вебсервиса
$domainname = 'http://127.0.0.1/moodle'; //Адрес мудла
$functionname = 'core_user_create_users'; //Наименование вызываемой функции
//$users_count = 10; //Количество пользователей в пакете
//$restformat = 'json'; //На выбор формат общения json
$restformat = 'xml'; //или XML

$user = new stdClass();
$s = 'student@gmail.com';
$user->username = strtolower($s); //Логин в системе мудла, используем почту
//$user->password = getRandomPassword(); //Генерируем первичный пароль, если надо
$user->createpassword = true;
$user->firstname = 'Александр' . $s; //Имя
$user->lastname = 'Андреев'; //Фамилия
$user->email = strtolower($s); //Почта
$user->auth = 'manual'; //Метод регистрации
$user->timezone = 'Europe/Moscow'; //… тут понятно
$user->description = 'Автогенерация'; //Описание
$user->city = 'Кемерово'; //Город студента
$user->country = 'RU'; //Страна студента
$user->preferences = array(
    array('type' => 'auth_forcepasswordchange', 'value' => true)
); //массив различных настроек, в данном случае, заставим студента сменить пароль при первом входе
$params = array('users' => array($user));

/// REST CALL
//header('Content-Type: text/plain');
$serverurl = $domainname . '/webservice/rest/server.php'
        . '?wstoken=' . $token
        . '&wsfunction=' . $functionname;

require_once('./curl.php');
$curl = new curl;
//если формат == 'xml', тогда не добавляем параметр для обратной совместимости с Moodle < 2.2
$restformat = ($restformat == 'json') ? '&moodlewsrestformat=' . $restformat : '';
$resp = $curl->post($serverurl . $restformat, $params);

print_r("<pre>" . $resp . "</pre>"); //смотрим на результат запроса
?>