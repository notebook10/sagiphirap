<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Philippine Social Media Examiner</title>
        <meta name="title" content="Philippine Social Media Examiner Events and Marketing Services Inc.">
        <meta name="description" content="Philippine Social Media Examiner, Events and Marketing Services, Inc. is an online data and research entity that aims to provide readily available information that may help individuals and even businesses discover how to make good use of social media platforms in connecting with their prospective clients, drive traffic to their websites and advertisements to increase sales, and generate awareness among best companies/products/brands and services.">
        <meta name="keywords" content="marketing services, events services, social media examiner,social media,social media platform,marketing,events,philippines social media">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <div class="login-div">
            <img src="images/psme-logo.png" class="img-responsive center-block psme-logo">
            <div class="login-container">
                <h1>Login to Your Account</h1><br>
                <form method="post" id="frmlogin" action="login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input id="login-email" type="text" name="email" placeholder="Enter Email.." required>
                    <input id="login-password" type="password" name="password" placeholder="Enter Password.." required>
                    <input type="submit" class="login loginmodal-submit" value="LOGIN">
                    {{--<a href="forgotpassword">Forget Password?</a>--}}
                    <ul class="errormessage">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </form>
            </div>
        </div>
    </body>
</html>
<noscript>
    Please enable Javascript in your web browser!
</noscript>