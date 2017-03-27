<form method="post" action="sendemail">
    Email: <input type="email" name="email" id="email" placeholder="Email Address">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="Submit">
</form>
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>