<nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">
            <img src="{{\App\Helpers\MainHelper::adminLogo()}}" height="42" />
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
                    <a href="#">
                        <i class="glyphicon glyphicon-bullhorn"></i> Basic Administration
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav collapse">

                        <li>
                            <a href="{{url('admin/user')}}">
                                <i class="glyphicon glyphicon-user"></i> Users
                            </a>
                        </li>

                        <li>
                            <a href="{{url('admin/workspace')}}">
                                <i class="glyphicon glyphicon-user"></i> Workspaces
                            </a>
                    </ul>
                </li>

                <li>

                    <a href="#">
                        <i class="glyphicon glyphicon-bullhorn"></i> SIP configuration & Networking
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav collapse">
                        <li>
                            <a href="{{url('admin/provider')}}">
                                <i class="glyphicon glyphicon-user"></i> Trunk Providers
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/popregion')}}">
                                <i class="glyphicon glyphicon-user"></i> PoP Regions 
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/country')}}">
                                <i class="glyphicon glyphicon-user"></i> Service Countries
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/router')}}">
                                <i class="glyphicon glyphicon-user"></i> Routers
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/trunk')}}">
                                <i class="glyphicon glyphicon-user"></i> Hosted User Trunks
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/routingacl')}}">
                                <i class="glyphicon glyphicon-user"></i> Routing ACL
                            </a>
                        </li>

                        <li>
                            <a href="{{url('admin/ddos')}}">
                                <i class="glyphicon glyphicon-user"></i> DDoS Settings
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
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-bullhorn"></i> DIDs inventories and rates
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav collapse">
                        <li>
                            <a href="{{url('admin/number')}}">
                                <i class="glyphicon glyphicon-user"></i> Number Inventory
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/rate')}}">
                                <i class="glyphicon glyphicon-user"></i> Rate Deck
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-bullhorn"></i> Settings & Content management
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav collapse">
                        <li>
                            <a href="{{url('admin/settings')}}">
                                <i class="glyphicon glyphicon-list"></i> API credentials
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/customizations')}}">
                                <i class="glyphicon glyphicon-bullhorn"></i> Customizations
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/serviceplan')}}">
                                <i class="glyphicon glyphicon-user"></i> Service Plan
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/faqs')}}">
                                <i class="glyphicon glyphicon-bullhorn"></i> FAQs
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/policies')}}">
                                <i class="glyphicon glyphicon-bullhorn"></i> Service terms & Policies
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/competitor')}}">
                                <i class="glyphicon glyphicon-bullhorn"></i> Competitors
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/costsaving')}}">
                                <i class="glyphicon glyphicon-bullhorn"></i> Cost Savings
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/faqs')}}">
                                <i class="glyphicon glyphicon-bullhorn"></i> FAQs
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/resourcesection')}}">
                                <i class="glyphicon glyphicon-list"></i> Resources
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/companyrepresentative')}}">
                                <i class="glyphicon glyphicon-user"></i> Company Representatives
                            </a>
                        </li>
                    </ul>
                </li>



                <li>
                    <a href="#">
                        <i class="glyphicon glyphicon-bullhorn"></i> Advanced Options
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav collapse">
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
                            <a href="{{url('admin/routingeditor')}}">
                                <i class="glyphicon glyphicon-user"></i> Routing Editor
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('auth/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>