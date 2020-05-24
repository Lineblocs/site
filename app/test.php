<?php

use App\Helpers\MainHelper;
$match = "8SpGhTMA";
$got = MainHelper::randomPassword();
while ($got != $match) {
        printf("testing %s != %s\r\n", $got, $match);
        $got = MainHelper::randomPassword();
}

