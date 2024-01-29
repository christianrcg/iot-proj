<?php

$currentMonth = '';
$serverMonth = date('n'); // outputs 1-12 integer
$currentYear = date('Y'); //2024

switch ($serverMonth) {
    case 1:
        $currentMonth = 'january';
        break;
    case 2:
        $currentMonth = 'february';
        break;
    case 3:
        $currentMonth = 'march';
        break;
    case 4:
        $currentMonth = 'april';
        break;
    case 5:
        $currentMonth = 'may';
        break;
    case 6:
        $currentMonth = 'june';
        break;
    case 7:
        $currentMonth = 'july';
        break;
    case 8:
        $currentMonth = 'august';
        break;
    case 9:
        $currentMonth = 'september';
        break;
    case 10:
        $currentMonth = 'october';
        break;
    case 11:
        $currentMonth = 'november';
        break;
    case 12:
        $currentMonth = 'december';
        break;
    default:
        $currentMonth = 'Invalid Month';
}

function getCurrentMonthName()
{
    global $currentMonth;
    return $currentMonth;
}

function getCurrentYear()
{
    global $currentYear;
    return $currentYear;
}
