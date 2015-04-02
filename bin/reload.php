<?php

require __DIR__ . '/base.php';

$newLine = "\n\r";

// Text colors
$green  = "\x1b[0;32m";
$yellow = "\x1b[0;33m";
$red    = "\x1b[1;31m";
$blue   = "\x1b[0;36m";
$clear  = "\x1b[0m";

echo($green . "   _____  __" . $newLine);
echo("  / ___/ / /_ ____ _ _____ ___   __  __ ___   _____ " . $newLine);
echo("  \__ \ / __// __ `// ___// _ \ / / / // _ \ / ___/ " . $newLine);
echo(" ___/ // /_ / /_/ // /   /  __// /_/ //  __/(__  )  " . $newLine);
echo("/____/ \__/ \____//_/    \___/ \__, / \___//____/   " . $newLine);
echo("                              /____/                " . $newLine);
echo($newLine . $yellow . " [ r | e | l | o | a | d ] " . $newLine);
echo($newLine . $red ."---- [ BEGIN SCRIPT ] ----" . $newLine . $clear);

//    runCommand("[1] - Drop database:", "app/console doctrine:database:drop --force");
    runCommand("[1] - Create database:", "app/console doctrine:database:create");
    runCommand("[2] - Create scheme:", "app/console doctrine:schema:create");
    runCommand("[3] - Install assets:", "app/console assets:install --symlink web");
    runCommand("[4] - Load fixtures:", "php app/console doctrine:fixtures:load");
//    runCommand("[6] - Run unit tests:", "phpunit -c app src/Panch/");

echo($newLine . $red . '---- [ END SCRIPT] ----' . $newLine . $clear);
