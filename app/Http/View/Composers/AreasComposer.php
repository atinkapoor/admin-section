<?php
namespace App\Http\View\Composers;
use App\Repositories\Interfaces\AreasRepositoryInterface;
use Illuminate\View\View;

class AreasComposer
{
    private $areasRepository;
    function __construct(AreasRepositoryInterface $areasRepository)
    {
        $this->areasRepository=$areasRepository;
    }

    public function compose(View $view)
    {
        $view->with('areas',$this->areasRepository->all([]));
    }
}