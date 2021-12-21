<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Environment\Console;

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

    public function editUser(Request $req, $id) {
        $user = [];
        isset($req->name) ? $user["name"] = $req->name : '';
        isset($req->email) ? $user["email"] = $req->email : '';
        isset($req->password) ? $user["password"] = $req->password : '';
        isset($req->status) ? $user["status"] = $req->status : '';
        isset($req->gender) ? $user["gender"] = $req->gender : '';

        // // $updateUser = $this->userRepository->update(['id' => $req->idUser], $user);

        // if(!empty($getUser)) {
            $updateUser = User::where('id', $req->idUser)->update($user);
            if($updateUser){
                return redirect('admin/user')->with('success','Cập nhật thành công');
            }else{
                return redirect('admin/user')->with('error','Cập nhật không thành công');
            }
        // }
        // return redirect('admin/user')->with('error','Người dùng không tồn tại');

    }
}
