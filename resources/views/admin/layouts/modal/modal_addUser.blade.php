<div class="modal" id="addUser" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{asset('admin/user/add')}}" method="post" id="formAddUser">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header pt-5 border-b">
                        <h3 class="block-title font-w600">ADD USER</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-material">
                                    <input type="text" class="form-control" id="add_user_name" name="username" placeholder="Please enter your username">
                                    <label for="material-text">Name User</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material">
                                    <input type="email" class="form-control" id="add_email" name="email" placeholder="Please enter your email">
                                    <label for="material-email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-material">
                                    <input type="password" class="form-control" id="add_password" name="password" placeholder="Please enter your password">
                                    <label for="material-password">Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <select class="position-relative input-group pt-0 align-items-center" name="status" id="status" style="height: 34px; border: 1px solid #d4dae3;">
                                    <option value="NOT_FILTER" class="text-center">----- Status -----</option>
                                    @foreach(config('apps.user.status') as $key => $value)
                                        <option value="{{ $value }}" {{isset($_GET['status']) && ($_GET['status'] == $value) ? 'selected' : ''}}> {{ config('apps.user.status_str')[$value] }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="position-relative input-group pt-0 align-items-center" name="gender" id="gender" style="height: 34px; border: 1px solid #d4dae3;">
                                    <option value="NOT_FILTER" class="text-center">----- Gender -----</option>
                                    @foreach(config('apps.user.gender') as $key => $value)
                                        <option value="{{ $value }}" {{isset($_GET['gender']) && ($_GET['gender'] ==  $value) ? 'selected' : ''}}> {{ config('apps.user.gender_str')[$value] }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-alt-secondary" data-dismiss="modal">Close</a>
                    <button href="submit" class="btn btn-bk btn-success-bk btn-add-user btn btn-bk btn-danger-bk btnSearch" id="btnAddUser">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
