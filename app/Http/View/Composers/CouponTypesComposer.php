<?php

namespace App\Http\View\Composers;

use App\Enumeration\CouponTypesInterface;
use Illuminate\View\View;

class CouponTypesComposer
{
    function __construct()
    {
    }

    public function compose(View $view)
    {
        $view->with('couponTypes', CouponTypesInterface::COUPON_TYPES);
    }
}