<script src="{{ asset('js/register.js') }}"></script>
@include("includes/important")
<div id="registerModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title account-title">Create Account</h4>
                <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_register" name="frm_register" class="clear_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="operationregis" id="operationregis">
                    <input type="hidden" name="idregis" id="idregis">
                    <div class="form-group">
                        <label for="firstname" class="form-control-label">First Name</label>
                        <input type="text" id="firstname" class="form-control" name="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="form-control-label">Last Name</label>
                        <input type="text" id="lastname" class="form-control" name="lastname">
                    </div>
                    <div class="form-group">
                        <label for="contact" class="form-control-label">Contact Number</label>
                        <input type="text" id="contact" class="form-control" name="contact">
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-control-label">Address</label>
                        <input type="text" id="address" class="form-control" name="address">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-control-label">Email Address</label>
                        <input type="text" id="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="user_type" class="form-control-label">User Type</label>
                        <input type="text" id="user_type" class="form-control" disabled value="2" name="user_type">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label">Password</label>
                        <input type="password" id="password" class="form-control" name="password">
                    </div>

                    <div class="modal-footer">
                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                        {{--<button type="button" class="btn btn-primary">Send message</button>--}}
                        <input type="button" class="btn btn-primary" value="Submit" id="btnRsubmit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>