<a href="/">Back</a>
<form action="insertuser" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    Firstname<input type="text" name="firstname"><br/>
    Lastname<input type="text" name="lastname"><br/>
    Contact Number <input type="text" name="contact"><br/>
    Address <textarea name="address"></textarea><br/>
    Email<input type="email" name="email"><br/>
    User Type<input type="text" name="user_type"><br/>
    Password<input type="password" name="password"><br/>
    Confirm Password<input type="password" name="cpassword"><br/>
    <input type="submit" value="Save">
</form>