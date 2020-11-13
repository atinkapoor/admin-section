<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\AdminRepositoryInterface;

class AdminController extends Controller
{
    private $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.change_password.index');
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
        $this->adminRepository->update(
            $this->validateAdmin(
                $request
            )
            , $id
        );
        return redirect(route('change_password'))->with('success', 'Password Successfully updated.');
    }

    /**
     * @return mixed
     */
    private function validateAdmin(Request $request)
    {
        $validateData = [
            'password' => 'required|confirmed|string|min:8',
            'password_confirmation' => 'required|string|min:8',
        ];

        $formData = request()->validate($validateData);

        return $formData;        
    }
}
