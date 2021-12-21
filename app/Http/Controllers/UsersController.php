<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public $userRepository;
    function __construct()
    {
         $this->userRepository = new UserRepository;
    }

    public function getUser(Request $req) {
        $filters = $req->all();

        $users = $this->userRepository->getPaginate([],$filters,10);


        $users = $this->userRepository->formatAllRecord($users);

        $data['users'] = $users;
        $data['allStatus'] = config('apps.user.status');

        $data['allGender'] = config('apps.user.gender');

        return view('admin.layouts.user', $data);
    }
}
