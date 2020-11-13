<?php

namespace App\Enumeration;


interface TimeRangeTypesInterface
{
    const HOURLY = 'hourly only';
    const HALF_HOURLY = 'hour and half hourly';
    const TIME_RANGE_TYPES = [
        self::HOURLY,
        self::HALF_HOURLY,
    ];
}