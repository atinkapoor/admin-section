<?php
namespace App\Http\View\Composers;
use App\Enumeration\EmailTypesInterface;
use Illuminate\View\View;

class EmailTypesComposer
{
    function __construct()
    {
    }

    public function compose(View $view)
    {
        $view->with('emailTypes', EmailTypesInterface::EMAIL_TYPES);
    }
}
