<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UsersRepositoryInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Login Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles authenticating users for the application and
   | redirecting them to your home screen. The controller uses a trait
   | to conveniently provide its functionality to your applications.
   |
   */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    private $usersRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->usersRepository = $usersRepository;
    }

    public function getLoginForm()
    {
        return view('admin/auth/login');
    }

    public function authenticate()
    {
        if ( $this->usersRepository->login(
            env('API_ADMIN_PREFIX') . '/admin-login',
            request()->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]))
        ) {
            return redirect(route('dashboard'));
        } else {
            return redirect(route('login'))->with('status', 'Please enter correct credentials');
        }
    }

    public function getLogout()
    {
        auth()->guard('admin')->logout();
        Session::flush();
        return redirect(route('login'));
    }
}
