<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);

        class Users {

            public $name = '';
            public $surname = '';
            public $patronymic = '';

        }

        $users[] = new Users;
        $users[0]->name = "Александр";
        $users[1]->name = "Helga";

        //$filename = "c:/Users/a.andreev/bin/Apache24/moodledata/test.txt";
        $filename = "/moodledata/test.txt";
        $f = fopen("/moodledata/yes.txt", 'w+');
        ?>
        <p><?= count($users) ?></p>
        <?php for ($i = 0; $i < count($users); $i++): ?>
            <p><?= $users[$i]->name ?></p>
        <?php endfor; ?>


        <p dir="ltr" style="text-align: left;"><br></p>
        <p dir="ltr" style="text-align: left;"><a href="https://youtu.be/szlgJ0sRV30?list=PLBlKgfcFv41v2pkVxctUyz0DgkqXu4BJf" target="_blank">https://youtu.be/szlgJ0sRV30?list=PLBlKgfcFv41v2pkVxctUyz0DgkqXu4BJf</a><br></p>
        <p dir="ltr" style="text-align: left;"><a href="https://youtu.be/szlgJ0sRV30?list=PLBlKgfcFv41v2pkVxctUyz0DgkqXu4BJf" target="_blank">https://youtu.be/szlgJ0sRV30?list=PLBlKgfcFv41v2pkVxctUyz0DgkqXu4BJf</a><br></p>
        <p dir="ltr" style="text-align: left;"><a href="https://youtu.be/OHtHqmnaiUc?list=PLBlKgfcFv41v2pkVxctUyz0DgkqXu4BJf" target="_blank">https://youtu.be/OHtHqmnaiUc?list=PLBlKgfcFv41v2pkVxctUyz0DgkqXu4BJf</a><br></p>
    </body>
</html>
