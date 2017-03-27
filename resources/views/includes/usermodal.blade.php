{{--  Change Password Modal --}}
<div id="userModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <form name="frm_password" id="frm_password" method="post">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id">
                    <p>New Password: <input type="password" id="newpassword" name="newpassword" placeholder="Enter New Password"> </p>
                    <p>Confirm Password: <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password"> </p>
                </div>
                <div class="modal-footer">
                    <input type="button" id="submitchange" class="btn btn-success" value="Submit">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>