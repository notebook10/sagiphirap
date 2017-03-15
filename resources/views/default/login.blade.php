<form method="post" id="frmlogin" action="login">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="email">
    <input type="password" name="password">
    <input type="submit" value="LOGIN">
</form>

<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>