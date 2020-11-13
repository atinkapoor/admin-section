<?php

namespace App\Enumeration;


interface ReductionTypesInterface
{
    const REDUCTION_FIXED = 'Fixed';
    const REDUCTION_PERCENTAGE = 'Percentage';
    const REDUCTION_CREDITS_FIXED = 'Fixed Credits';
    const REDUCTION_CREDITS_PERCENTAGE = 'Percentage Credits';
    const REDUCTION_TYPES = [
        self::REDUCTION_FIXED,
        self::REDUCTION_PERCENTAGE,
        self::REDUCTION_CREDITS_FIXED,
        self::REDUCTION_CREDITS_PERCENTAGE,
    ];
}