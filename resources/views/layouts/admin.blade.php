<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard Panel</title>

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin/style.css') }}">

    <!-- Icon Libraries -->
    
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">

</head>
<body>

<nav>
    <div class="logo-name">
        <div class="logo-image">
            @if(Auth::user()->avatar)
               <img src="{{ Storage::url( $pathabout['avatar'].'/'.$about->avatar) }}" alt="Avatar" class="avatar">
            @else
               <img src="{{ Storage::url('default_avatar.png') }}" alt="Default Avatar" class="avater">
            @endif
        </div>
        <span class="logo_name">Admin</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
            <li><a href="{{ route('admin.index') }}"><i class="uil uil-estate"></i><span class="link-name">Dashboard</span></a></li>
            <li><a href="{{ route('admin.about.index') }}"><i class="uil uil-user"></i><span class="link-name">About</span></a></li>
            <li><a href="{{ route('admin.portfolio.index') }}"><i class="uil uil-briefcase"></i><span class="link-name">Portfolio</span></a></li>
            <li><a href="{{ route('admin.category.index') }}"><i class="uil uil-folder"></i><span class="link-name">Category</span></a></li>
            <li><a href="{{ route('admin.project.index') }}"><i class="uil uil-layer-group"></i><span class="link-name">Projects</span></a></li>
            <li><a href="{{ route('admin.service.index') }}"><i class="uil uil-chart-growth"></i><span class="link-name">Services</span></a></li>
            <li><a href="{{ route('admin.qualification.index') }}"><i class="uil uil-file-alt"></i><span class="link-name">Qualification</span></a></li>
            <li><a href="{{ route('admin.qualification.edu') }}"><i class="uil uil-graduation-cap"></i><span class="link-name">Education</span></a></li>
            <li><a href="{{ route('admin.qualification.exp') }}"><i class="uil uil-briefcase-alt"></i><span class="link-name">Experience</span></a></li>
            <li><a href="{{ route('admin.skillLanguage.index') }}"><i class="uil uil-pen"></i><span class="link-name">Skills And Languages</span></a></li>
            <li><a href="{{ route('admin.contact.index') }}"><i class="uil uil-envelope"></i><span class="link-name">Contacts</span></a></li>
            <li><a href="{{ route('admin.user.users') }}"><i class="uil uil-user-circle"></i><span class="link-name">Users</span></a></li>
        </ul>

        <ul class="logout-mode">
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            <li class="mode">
                <a href="#">
                    <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>
                <div class="mode-toggle"><span class="switch"></span></div>
            </li>
        </ul>
    </div>
</nav>


<section class="dashboard">
    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
        <div class="user-dropdown">
        <div class="user-info">
            @if(Auth::user()->avatar)
                <img src="{{ Storage::url( $pathabout['avatar'].'/'.$about->avatar) }}" alt="Avatar" class="avatar">
            @else
                <img src="{{ Storage::url('default_avatar.png') }}" alt="Default Avatar" class="avatar">
            @endif
            <span class="user-name">{{ Auth::user()->first_name }}</span>
            <i class="uil uil-angle-down dropdown-icon"></i>
        </div>

        <div class="dropdown-content">
            <a href="{{ route('admin.profile.show') }}">Profile</a>
            <a href="{{ route('admin.profile.edit-profile') }}">Edit Profile</a>
            <a href="{{ route('admin.profile.change-password') }}">Change Password</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </div>
    </div>
    </div>

    <div class="dash-content">
        <div class="overview">
            @yield('content')
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin/script.js') }}"></script>

</body>
</html>