
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">


<div class="login-div">
    <div class="login-container">
        <h1>Login to Your Account</h1><br>
        <form method="post" id="frmlogin" action="login">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="email">
            <input type="password" name="password">
            <input type="submit" class="login loginmodal-submit" value="LOGIN">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </form>
    </div>
</div>