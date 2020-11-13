<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CreditPacksRepositoryInterface;
use App\Repositories\Interfaces\UsersSubscribeCreditPacksRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CreditPacksController extends Controller
{
    private $creditPacksRepository;
    private $usersSubscribeCreditPacksRepository;

    public function __construct(CreditPacksRepositoryInterface $creditPacksRepository, UsersSubscribeCreditPacksRepositoryInterface $usersSubscribeCreditPacksRepository)
    {
        $this->creditPacksRepository = $creditPacksRepository;
        $this->usersSubscribeCreditPacksRepository = $usersSubscribeCreditPacksRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subscribersStats = $this->usersSubscribeCreditPacksRepository->subscribe();
        $page = $request->query('page');
        if ( empty($page) ) {
            $page = 1;
        }
        $cond = ['keyword' => $request->query('search'), 'page' => $page];
        if ( !empty($request->query('sort_field')) ) {
            $cond = array_merge($cond, ['sort_field' => $request->query('sort_field'), 'sort_desc' => $request->query('sort_desc')]);
        }
        $creditPacks = $this->creditPacksRepository->all($cond);
        return view('admin.credit_packs.index', compact('creditPacks', 'subscribersStats','page'));
    }

    public function change($id)
    {
        $current_credit_pack = $this->creditPacksRepository->edit($id);
        $creditPacks = $this->creditPacksRepository->all([]);
        return view('admin.credit_packs.change', compact('creditPacks', 'current_credit_pack'));
    }

    public function switch_credit_pack(Request $request, $id)
    {
        if ( $request->get('current_credit_id') != $id ) {
            abort(Response::HTTP_BAD_REQUEST);
        }
        $this->creditPacksRepository->switch_credit_pack($request->all());
        if ( Session::has('error') ) {
            return Redirect::back()->withInput($request->all());
        }
        return redirect(route('credit_packs'))->with('success', 'Successfully switch.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.credit_packs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->creditPacksRepository->store(
            $this->validateCreditPacks(
                $request
            )
        );
        if ( Session::has('error') ) {
            return Redirect::back()->withInput($request->all());
        }

        return redirect(route('credit_packs'))->with('success', 'Successfully added.');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $credit_pack = $this->creditPacksRepository->edit($id);
        return view('admin.credit_packs.edit', compact('credit_pack'));
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
        $this->creditPacksRepository->update($this->validateCreditPacks($request), $id);
        if ( Session::has('error') ) {
            return Redirect::back()->withInput($request->all());
        }
        return redirect(route('credit_packs'))->with('success', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destory($id)
    {
        $this->creditPacksRepository->delete($id);
        return redirect(route('credit_packs'))->with('success', 'Credit pack is successfully deleted');
    }

    /**
     * @return mixed
     */
    private function validateCreditPacks(Request $request, $additional = array())
    {
        $validateData = [
            'name' => 'required|min:3|max:255',
            'credits' => 'required|integer',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'expire_month' => 'required',
            'image_from' => 'image|mimes:jpeg,png,jpg|max:2048',
            'active' => 'required',
        ];
        $validateData = array_merge($validateData, $additional);
        $formData = request()->validate($validateData);

        if ( $request->hasFile('image_from')) {
            $formData['image_from'] = base64_encode(file_get_contents($_FILES['image_from']['tmp_name']));
            $formData['image_file_name'] = $_FILES['image_from']['name'];
        }

        $formData['description'] = $request->get("description");
        return $formData;
    }

}
