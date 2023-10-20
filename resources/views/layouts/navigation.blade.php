<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            {{-- @if (Auth::check())
                @if (auth()->user()->role === 'guidance')
                    <a href="{{ route('guidance.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
                @elseif(auth()->user()->role === 'student')
                    <a href="{{ route('studentprofile') }}" class="d-block">{{ Auth::user()->name }}</a>
                @endif   
            @endif --}}
            <p style="text-align: center; color: #ffffff;"><em>A Digitalized Management System</em></p>
            <p style="text-align: center; color: #ffffff;"><em>Student Violation Record</em></p>
            {{-- <p>Student Violation Record</p> --}}
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
        @else

        @if (Auth::check())
        @if (auth()->user()->role === 'guidance')
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <p style="color: #ffffff;"><strong>MENU</strong></p>
            <li class="nav-item">
                <a href="{{ route('topviolator') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('announcementindex') }}" class="nav-link">
                    <i class="nav-icon fas fa-bullhorn"></i>
                    <p>
                        {{ __('Announcement') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    {{-- <i class="far fa-screen-users nav-icon"></i> --}}
                    <p>
                        {{ __('Users') }}
                    </p>
                </a>
            </li>

            <BR>
            <p style="color: #ffffff;"><strong>RECORDS</strong></p>
                <li class="nav-item">
                    <a href="{{ route('counsel.index') }}" class="nav-link">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                        <p>Counselling Records</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('guidance.index') }}" class="nav-link">
                        <i class="fas fa-user-tie nav-icon"></i>
                        <p>Guidance Counselors</p>
                    </a>
                </li>
                    
                <li class="nav-item">
                    <a href="{{ route('studentindex') }}" class="nav-link">
                        <i class="fas fa-user-graduate nav-icon"></i>
                        <p>Students Enrolled</p>
                    </a>
                </li>
                    
                <li class="nav-item">
                    <a href="{{ route('studentrecordindex') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Students Violation Records</p>
                    </a>
                </li>
                    
                <li class="nav-item">
                    <a href="{{ route('indexrecord') }}" class="nav-link">
                        <i class="fas fa-user-tag nav-icon"></i>
                        <p>Top Violators</p>
                    </a>
                </li>
        </ul>

        @elseif(auth()->user()->role === 'student')
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('studentdashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('My Records') }}
                    </p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('studentviolation.create') }}" class="nav-link">
                    <i class="nav-icon fa fa-file"></i>
                    <p>
                        {{ __('Report an Incident') }}
                    </p>
                </a>
            </li>
        </ul>
            @endif   
            @endif
            @endguest
        {{-- </ul> --}}
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->