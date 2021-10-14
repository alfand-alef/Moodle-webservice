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
        ?>
        <h1 style="text-align: center; font-family: monospace"><?= getRandomPassword()?></h1>
    </body>
</html>
