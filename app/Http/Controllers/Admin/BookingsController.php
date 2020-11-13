<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BookingsRepositoryInterface;
use Illuminate\Http\Request;


class BookingsController extends Controller
{
    private $bookingsRepositoryInterface;

    public function __construct(BookingsRepositoryInterface $bookingsRepositoryInterface)
    {
        $this->bookingsRepositoryInterface = $bookingsRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param $user_id
     * @param $user_type_id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id, $user_type_id)
    {
        $sessions = $this->bookingsRepositoryInterface->userBookings(['user_id' => $user_id]);
        return view('admin.users.sessions.index', compact('sessions', 'user_id', 'user_type_id'));
    }

}
