<div class="modal fade" id="update_{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="modal-large" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{asset('admin/user/'.$user->id)}}" method="post" id="formEditUser_{{$user->id}}">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header pt-5 border-b pb-5">
                        <h3 class="block-title font-w600">UPDATE USER</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="text" value="{{$user->id}}" name="idUser" hidden>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-material">
                                    <input type="text" class="form-control" id="edit_user_name_{{$user->id}}" name="name" value="{{isset($user->name)?$user->name:''}}" placeholder="Please enter your username">
                                    <label for="material-text">User Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-material">
                                    <input type="text" class="form-control" id="edit_password_{{$user->id}}" name="password" value="{{isset($user->password)?$user->password:''}}" placeholder="Please enter your username">
                                    <label for="material-text">Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material">
                                    <input type="email" class="form-control" id="edit_email_{{$user->id}}" name="email" value="{{isset($user->email)?$user->email:''}}" placeholder="Please enter your email">
                                    <label for="material-email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <div class="col-6 text-left">
                                @foreach(config('apps.user.status') as $key => $value)
                                    <label class="css-control css-control-primary css-checkbox css-control-sm ml-0">
                                        <input type="radio" id="edit_status_{{$user->id}}" name="status" value="{{ $value }}" {{$user->status && $user->status == $value ? 'checked' : ''}} class="css-control-input" >
                                        <span class="css-control-indicator"></span> {{ config('apps.user.status_str')[$value] }}
                                    </label>
                                @endforeach
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                @foreach(config('apps.user.gender') as $key => $value)
                                    <label class="css-control css-control-primary css-checkbox css-control-sm d-flex align-items-center mr-10">
                                        <input type="radio" id="edit_gender_{{$user->id}}" name="gender" value="{{ $value }}" {{$user->gender && $user->gender ==  $value ? 'checked' : ''}} class="">
                                        <span class="css-control-indicator ml-5"></span> {{ config('apps.user.gender_str')[$value] }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-alt-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-bk btn-danger-bk btnSearch btn-edit-user"  id="btnEditUser_{{$user->id}}">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
