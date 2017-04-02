<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Logo</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Welcome {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                            if(Auth::user()->user_type == 1){
                                echo "<li><a id='createAccount'><span class='glyphicon glyphicon-user'></span> Create Account</a></li>";
                            }
                        ?>
                        <?php
                        if(Auth::user()->user_type == 1){
                            echo "<li><a href='users'><span class='glyphicon glyphicon-globe'></span> Users</a> </li>";
                        }
                        ?>
                        <li><a href="#" id="btnreport"><span class="glyphicon glyphicon-file"></span> Report </a></li>
                        <li><a href="logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>