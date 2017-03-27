<div id="registerModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title center-block">Create Account</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="insertuser" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--<div id="registerModal" class="modal fade" role="dialog">--}}
    {{--<div class="modal-dialog modal-lg">--}}

        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                {{--<h4 class="modal-title">Create Account</h4>--}}
            {{--</div>--}}
            {{--<form class="form-horizontal" id="frmcompany" name="frmcompany" method="post" action="submitcompany">--}}
            {{--<form action="insertuser" method="post">--}}
                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                {{--Firstname<input type="text" name="firstname"><br/>--}}
                {{--Lastname<input type="text" name="lastname"><br/>--}}
                {{--Contact Number <input type="text" name="contact"><br/>--}}
                {{--Address <textarea name="address"></textarea><br/>--}}
                {{--Email<input type="email" name="email"><br/>--}}
                {{--User Type<input type="text" name="user_type"disabled value="2"><br/>--}}
                {{--Password<input type="password" name="password"><br/>--}}
                {{--Confirm Password<input type="hidden" name="cpassword"><br/>--}}
                {{--<input type="submit" value="Save">--}}
            {{--</form>--}}
        {{--</div>--}}

    {{--</div>--}}
{{--</div>--}}