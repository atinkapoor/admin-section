<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UsersRepositoryInterface;
use App\Utilities\AppStore;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $usersRepository;

    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function verifyemail(Request $request)
    {
        $param['email_verified_code'] = $request->query('enc');
        $this->usersRepository->verifyemail("/verifyMail", $param);
        $app_login_url = env('APP_LOGIN_URL');
        return view('verifyemail', compact('app_login_url'));
    }

    public function resetpwd(Request $request)
    {
        $enc = $request->query('enc');
        $email = $request->query('email');
        $app_reset_password_url = env('APP_NEW_PASSWORD_URL');
        $app_reset_password_url .= "&email=" . $email . "&enc=" . $enc;
        return view('resetpwd', compact('app_reset_password_url'));
    }

    public function invite(Request $request, $code)
    {
        $app_invite_password_url = env('APP_INVITE_URL');
        $cond = ['invite_code' => $code];
        $info = $this->usersRepository->inviteInformation("/inviteInformation", $cond);
        if ( empty($info) ) {
            abort(404);
        }
        $app_invite_password_url .= "?invite_code=" . $code . "&name=" . $info['name'] . "&dat=" . $info['booking_date'] . "&stime=" . $info['start_time_label'] . "&etime=" . $info['end_time_label'];

        $app_store_url = AppStore::url($request);

        return view('invite', compact('app_invite_password_url', 'app_store_url'));
    }

    public function subscription_renewal(Request $request)
    {
        $completeDataArr = $request->all();
        $dataArr = $completeDataArr['data']['object'];
        $billing_reason = $dataArr['billing_reason'];
        $msg = '';
        if ( $billing_reason == "subscription_cycle" ) {

            $sendData['customer_stripe_id'] = $dataArr['customer'];
            $sendData['invoice_stripe_id'] = $dataArr['id'];
            foreach ($dataArr['lines']['data'] as $info) {
                $sendData['amount_paid'] = ($info['amount']);
                $sendData['time_start'] = $info['period']['start'];
                $sendData['time_end'] = $info['period']['end'];
                $sendData['plan_stripe_id'] = $info['plan']['id'];
                $sendData['subscription_stripe_id'] = $info['subscription'];
                $sendData['subscription_stripe_item_id'] = $info['subscription_item'];
            }

            $renewalResponse = $this->usersRepository->subscription_renewal("/subscription_renewal", $sendData);
            if ( isset($renewalResponse['errors']) ) {
                $msg = $renewalResponse['errors']['message'][0];
            } else {
                $msg = $renewalResponse['message'][0];
            }

        }

        return view('subscription_renewal', compact('msg'));
    }

}
