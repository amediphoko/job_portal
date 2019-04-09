<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            @if (Auth::guard('admin')->check())
                <a class="navbar-brand" href="{{ url('/') }}">
                    Admin | {{ config('app.name', 'ITJOMS') }}
                </a>
            @else
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'ITJOMS') }}
                </a>
            @endif
                
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
                @if (Auth::guard('web')->check() or Auth::guard('employer')->check())
                    <li><a href="/">Home</a></li>
                    <li><a href="/search">Search</a></li>
                    <li><a href="/jobs">Jobs</a></li>
                    <li><a href="/forum">News Forum</a></li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guard('web')->check() or Auth::guard('employer')->check() or Auth::guard('admin')->check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="icon"><i style="color:turquoise; font-size:1.2em" class="fa fa-bell"></i></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @if (Auth::guard('employer')->check())
                                <li style="text-align:center"><h5><b>Notifications</b></h5></li>
                                <li role="separator" class="divider"></li>
                                @foreach (Auth::guard('employer')->user()->notifications as $notification)
                                    <li><a href="#">{{ $notification->data['user_name'] }} applied for the {{ $notification->data['job_name'] }} vacancy.<br>
                                    <small>{{ $notification->created_at->diffForHumans() }}</small></a></li>  
                                @endforeach
                            @elseif (Auth::guard('web')->check())
                                <li style="text-align:center"><h5><b>Notifications</b></h5></li>
                                <li role="separator" class="divider"></li>
                                @foreach (Auth::guard('web')->user()->notifications as $notification)
                                    <li><a href="#">{{ $notification->data['user_name'] }} has responded to your {{ $notification->data['job_name'] }}<br> job application.<br>
                                    <small>{{ $notification->created_at->diffForHumans() }}</small></a></li>  
                                @endforeach
                            @endif
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            @if (Auth::guard('employer')->check())
                                {{ Auth::guard('employer')->user()->name }} <span class="caret"></span>
                            @elseif (Auth::guard('web')->check())
                                {{ Auth::user()->name }} <span class="caret"></span>
                            @elseif (Auth::guard('admin')->check())
                                {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                            @endif
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @if (Auth::guard('web')->check())
                                <li><a href="/dashboard">My Dashboard</a></li>
                            @elseif (Auth::guard('employer')->check())
                                <li><a href="/employer">My Dashboard</a></li>
                            @else
                            <li><a href="{{ route('admin.dashboard') }}">My Dashboard</a></li>
                            @endif
                            
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="/">Home</a></li>
                    <li><a href="/search">Search</a></li>
                    <li><a href="/jobs">Jobs</a></li>
                    <li><a href="/forum">News Forum</a></li>
                    <li><a href="{{ route('login') }}">Job Seeker</a></li>
                    <li><a href="{{ route('employer.login') }}">Employer</a></li>
                    <li><a href="{{ route('admin.login') }}">Admin</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>