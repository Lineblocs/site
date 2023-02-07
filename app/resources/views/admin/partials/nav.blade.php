<nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">
                <img src="{{\App\Helpers\MainHelper::adminLogo()}}" height="42"/>
        </a>
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
                    <a href="{{url('admin/router')}}">
                        <i class="glyphicon glyphicon-user"></i> SIP Routers
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/trunk')}}">
                        <i class="glyphicon glyphicon-user"></i> SIP Trunks
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/rtpproxy')}}">
                        <i class="glyphicon glyphicon-user"></i> RTP proxies
                    </a>
                </li>




                <li>
                    <a href="{{url('admin/server')}}">
                        <i class="glyphicon glyphicon-user"></i> Media Servers
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/number')}}">
                        <i class="glyphicon glyphicon-user"></i> Number Inventory
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/routerflow')}}">
                        <i class="glyphicon glyphicon-user"></i> Router flows
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-bullhorn"></i> Settings
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav collapse">
                        <li>
                            <a href="{{url('admin/settings')}}">
                                <i class="glyphicon glyphicon-list"></i>  API credentials
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/customizations')}}">
                                <i class="glyphicon glyphicon-bullhorn"></i> Customizations
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/faqs')}}">
                                <i class="glyphicon glyphicon-bullhorn"></i> FAQs
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/resources')}}">
                                <i class="glyphicon glyphicon-bullhorn"></i> Resource Articles
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('admin/rate')}}">
                        <i class="glyphicon glyphicon-user"></i> Call Rates
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/serviceplan')}}">
                        <i class="glyphicon glyphicon-user"></i> Service Plan
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/dns')}}">
                        <i class="glyphicon glyphicon-user"></i> DNS Records
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