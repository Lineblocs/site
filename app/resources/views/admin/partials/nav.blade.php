<nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Lineblocs Admin</a>
    </div>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{ url('') }}"><i class="fa fa-backward"></i> Go to frontend</a>
                </li>
                <li>
                    <a href="{{url('admin/dashboard')}}">
                        <i class="fa fa-dashboard fa-fw"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/user')}}">
                        <i class="glyphicon glyphicon-user"></i> Users
                    </a>
                </li>
                <!--
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-bullhorn"></i> Newsletters
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav collapse">
                        <li>
                            <a href="{{url('admin/newsletters/sent')}}">
                                <i class="glyphicon glyphicon-list"></i>  Sent newsletters
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/newsletters/create')}}">
                                <i class="glyphicon glyphicon-bullhorn"></i> Create Newsletter
                            </a>
                        </li>
                    </ul>
                </li>
            -->
                <li>
                    <a href="{{url('admin/provider')}}">
                        <i class="glyphicon glyphicon-user"></i> SIP Providers
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/country')}}">
                        <i class="glyphicon glyphicon-user"></i> SIP Service Countries
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/rate')}}">
                        <i class="glyphicon glyphicon-user"></i> Call Rates
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/systemstatus')}}">
                        <i class="glyphicon glyphicon-user"></i> System Status
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/errortrace')}}">
                        <i class="glyphicon glyphicon-user"></i> Error Trace
                    </a>
                </li>
                <li>
                    <a href="{{ url('auth/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>