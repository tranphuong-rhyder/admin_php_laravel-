<!-- Modal -->
<div class="modal fade" id="delete_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header d-flex align-items-center btn-alt-danger pt-5 pb-5" style="border-bottom-width: 1px;">
                <h5 class="modal-title" style="color: #af1310;" id="btn_delete">DELETE USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #af1310;">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                Bạn có chắc chắn muốn xóa
                <span style="color: #af1310;">{{$user->name}}</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary border-0">Không</button>
                <button type="button" class="btn btn-secondary btn-alt-danger" data-dismiss="modal"  id="btn_delete">Có</button>
            </div>
        </div>
    </div>
</div>
