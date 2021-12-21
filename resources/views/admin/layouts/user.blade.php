@extends('admin.app')
@section('title', '')

@section('content')
<style>
    .nav-main li a{
        text-align: left
    }
    .hidden_text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    svg.w-5.h-5 {
        width: 30px;
    }
    .flex.justify-between.flex-1{
        display: none;
    }
    div p.text-sm.text-gray-700.leading-5 {
        display: none;
    }
    nav div div {
        text-align: center;
    }
    table thead tr th,
    table tbody tr td {
        cursor: pointer;
    }

    .btnSearch {
        background: #3f9ce8;
        color: #fff;
    }

    .table .thead-light th {
        color: #fff;
        background-color: #3f9ce8;
        border-color: #3f9ce8;
    }
    .table td, .table th {
        border-top: none;
    }
</style>
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <!-- Material Design -->
            <h2 class="content-heading">User Table</h2>
            <form class="" action="" method="get" >
                @csrf
                <div class="form-group row">
                    <div class="col-3 pr-5">
                        <div class="position-relative input-group pt-0">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nhập user" value="{{isset($_GET['name']) ? ($_GET['name']) : ''}}">
                        </div>
                    </div>
                    <div class="col-3 pr-5">
                        <div class="position-relative input-group pt-0">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Nhập email" value="{{isset($_GET['email']) ? ($_GET['email']) : ''}}">
                        </div>
                    </div>
                    <div class="col-2 pr-5">
                        <select class="position-relative input-group pt-0 align-items-center" name="status" id="status" style="height: 34px; border: 1px solid #d4dae3;">
                            <option value="NOT_FILTER" class="text-center">----- Status -----</option>
                            @foreach(config('apps.user.status') as $key => $value)
                                <option value="{{ $value }}" {{isset($_GET['status']) && ($_GET['status'] == $value) ? 'selected' : ''}}> {{ config('apps.user.status_str')[$value] }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 pr-5">
                        <select class="position-relative input-group pt-0 align-items-center" name="gender" id="gender" style="height: 34px; border: 1px solid #d4dae3;">
                            <option value="NOT_FILTER" class="text-center">----- Gender -----</option>
                            @foreach(config('apps.user.gender') as $key => $value)
                                <option value="{{ $value }}" {{isset($_GET['gender']) && ($_GET['gender'] ==  $value) ? 'selected' : ''}}> {{ config('apps.user.gender_str')[$value] }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 pl-5 text-right">
                        <button type="submit"  class="btn btn-bk btn-primary-bk btnSearch mr-5">Tìm kiếm</button>
                        <a href="{{ route('user') }}" class="btn btn-bk btn-secondary reload" >
                            <img src="http://localhost:9408/assets/img/icon/ArrowCounterClockwise.svg" alt="">
                        </a>
                    </div>
                </div>
            </form>
            <table class="table table-striped table-vcenter table-order">
                <thead class="thead-light width-100">
                    <tr>
                        <th class="text-center" style="width: 20%">UserName</th>
                        <th class="text-center" style="width: 20%">Password</th>
                        <th class="text-center" style="width: 20%">Email</th>
                        <th class="text-center" style="width: 15%">Status</th>
                        <th class="text-center" style="width: 10%">gender</th>
                        <th class="text-center" style="width: 15%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center" style="width: 20%">{{$user->name}}</td>
                            <td class="text-center hidden_text" style="width: 20%">{{$user->password}}</td>
                            <td class="text-center" style="width: 20%">{{$user->email}}</td>
                            <td class="text-center" style="width: 15%">{{$user->status_str}}</td>
                            <td class="text-center" style="width: 10%">{{$user->gender_str}}</td>
                            <td class="text-center d-flex align-items-center mt-0" style="width: 15%">
                                <button class="btn btn-alt-danger mr-5" title="Xóa" data-toggle="modal" data-target="#delete_{{$user->id}}" data-whatever="@fat">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @include('admin.layouts.modal.modal_delete')
                                <button class="btn btn-alt-primary" title="Chỉnh sửa" data-toggle="modal" data-target="#update_{{$user->id}}" data-whatever="@fat">
                                    <i class="fa fa-edit"></i>
                                </button>
                                @include('admin.layouts.modal.modal_edit')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- END Material Design -->
            {{ $users->links() }}
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection


