<?php

function convertTOKWH($watts)
{
    $kilowatts = (float)$watts / 1000;
    return $kilowatts;
}
