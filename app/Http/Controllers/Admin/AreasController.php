<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AreasRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AreasController extends Controller
{
    private $areasRepository;

    public function __construct(AreasRepositoryInterface $areasRepository)
    {
        $this->areasRepository = $areasRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->query('page');
        if ( empty($page) ) {
            $page = 1;
        }
        $cond = ['keyword' => $request->query('search'), 'page' => $page];
        if ( !empty($request->query('sort_field')) ) {
            $cond = array_merge($cond, ['sort_field' => $request->query('sort_field'), 'sort_desc' => $request->query('sort_desc')]);
        }
        $areas = $this->areasRepository->all($cond);

        return view('admin.areas.index', compact('areas', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.areas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->areasRepository->store(
            $this->validateData(
                $request
            )
        );
        if ( Session::has('error') ) {
            return Redirect::back()->withInput($request->all());
        }

        return redirect(route('areas'))->with('success', 'Successfully added.');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = $this->areasRepository->edit($id);
        return view('admin.areas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->areasRepository->update($this->validateData($request), $id);
        if ( Session::has('error') ) {
            return Redirect::back()->withInput($request->all());
        }
        return redirect(route('areas'))->with('success', 'Successfully updated.');
    }

    /**
     * @return mixed
     */
    private function validateData(Request $request, $additional = array())
    {
        $validateData = [
            'name' => ['required', 'min:3', 'max:255'],
            'active' => 'required',
        ];
        $validateData = array_merge($validateData, $additional);
        $formData = request()->validate($validateData);
        return $formData;
    }

}
