<?php

function runCommand($text, $command, $canFail = false)
{
    // Text colors
    $green     = "\x1b[0;32m";
    $yellow    = "\x1b[0;33m";
    $red       = "\x1b[1;31m";
    $blue      = "\x1b[0;36m";
    $clear     = "\x1b[0m";
    $cmdLength = strlen($command);

    echo $blue . "\n$text \x1b[1;32m$command \n\r $clear \n\r";

    passthru($command, $return);

    if (0 !== $return && !$canFail) {
        echo "\n/!\\ The command returned $return\n";
        exit;
    }
}
