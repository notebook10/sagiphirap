{{--  Change Password Modal --}}
<div id="userModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <form name="frm_password" id="frm_password" method="post">
                <div class="modal-body userForm-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label class="control-label" for="newpassword">New Password:</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter New Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="cpassword">Confirm Password:</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="button" id="submitchange" class="btn btn-success" value="Submit">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


