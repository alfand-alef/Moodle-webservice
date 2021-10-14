<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

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

// This file is NOT a part of Moodle - http://moodle.org/
/**
 * REST client for Moodle
 * Return JSON or XML format
 *
 * @authorr Jerome Mouneyrac
 */
/// SETUP - NEED TO BE CHANGED
$token = '7438c75e1f45e84c34b6fbc52c39ac83';
$domainname = 'http://127.0.0.1/moodle';
$functionname = 'core_user_create_users';
$user_email[0] = 'alef-photoamator@yandex.ru';
$user_email[1] = 'alef-photoamator@ya.ru';
$users_count = 10;

// REST RETURNED VALUES FORMAT
//$restformat = 'json'; //Also possible in Moodle 2.2 and later: 'json'
$restformat = 'xml'; //Also possible in Moodle 2.2 and later: 'json'
//Setting it to 'json' will fail all calls on earlier Moodle version
//////// moodle_user_create_users ////////
/// PARAMETERS - NEED TO BE CHANGED IF YOU CALL A DIFFERENT FUNCTION
//*****************
$user[] = new stdClass();
for ($i = 0; $i < $users_count; $i++) {
    $s = 'alef-photoamator' . $i . '@yandex.ru';
    $user[$i]->username = strtolower($s);
    $user[$i]->password = getRandomPassword();
    $user[$i]->firstname = 'Пользователь_' . $s;
    $user[$i]->lastname = 'Пробный';
    $user[$i]->email = strtolower($s);
    $user[$i]->auth = 'manual';
    $user[$i]->timezone = 'Europe/Moscow';
    $user[$i]->description = 'Автогенерация';
    $user[$i]->city = 'Кемерово';
    $user[$i]->country = 'RU';
    $user[$i]->preferences = array(array('type' => 'auth_forcepasswordchange', 'value' => true));
}
//*****************


$params = array('users' => $user);

/// REST CALL
//header('Content-Type: text/plain');
$serverurl = $domainname . '/webservice/rest/server.php'
        . '?wstoken=' . $token
        . '&wsfunction=' . $functionname;
require_once('./curl.php');
$curl = new curl;
//if rest format == 'xml', then we do not add the param for backward compatibility with Moodle < 2.2
$restformat = ($restformat == 'json') ? '&moodlewsrestformat=' . $restformat : '';
$resp = $curl->post($serverurl . $restformat, $params);

//$resp_decode = json_decode($resp, false);
//print_r("<p>".$resp_decode->errorcode);
//print_r("<p>".$resp_decode->message);
print_r("<pre>" . $resp . "</pre>");
print_r("<p>" . $user[0]->password);
?>