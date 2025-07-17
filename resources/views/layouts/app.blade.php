<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Professional portfolio of {{ $about->first_name }} {{ $about->last_name }}">
    <meta name="author" content="{{ $about->first_name }} {{ $about->last_name }}">
    <title>{{ $about->first_name }} {{ $about->last_name }} | Portfolio</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/dripicons@1.0.0/dist/css/dripicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/johndoe.css') }}">
    @livewireStyles
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white" data-spy="affix" data-offset-top="510">
        <div class="container">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse mt-sm-20 navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="{{ route('home') }}#home" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('home') }}#about" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="{{ route('home') }}#resume" class="nav-link">Resume</a></li>
                </ul>
                <ul class="navbar-nav brand">
                    @if($about->avatar && Storage::exists($pathabout['avatar'].'/'.$about->avatar))
                    <img src="{{ Storage::url( $pathabout['avatar'].'/'.$about->avatar) }}" class="brand-img">
                    @else
                    <img src="{{ Storage::url('default_avatar.png') }}" class="brand-img">
                    @endif
                    <li class="brand-txt">
                        <h5 class="brand-title">{{ $about->first_name }} {{ $about->last_name }}</h5>
                        <div class="brand-subtitle">{{ $about->job }}</div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ route('home') }}#portfolio" class="nav-link">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}#service" class="nav-link">Service</a>
                    </li>
                    <li class="nav-item last-item">
                        <a href="{{ route('home') }}#contact" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
    @livewireScripts

    <footer class="footer py-3">
        <div class="container">
            <p class="small mb-0 text-light">
                &copy; <script>document.write(new Date().getFullYear())</script> Created With <i class="ti-heart text-danger"></i> By <a href="" target="_blank"><span class="text-danger" title="Bootstrap 4 Themes and Dashboards">ASMAA MOHAMED ABDELHALIM</span></a>
            </p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.affix.js') }}"></script>
    <script src="{{ asset('assets/vendors/isotope/isotope.pkgd.js') }}"></script>
    <script src="{{ asset('assets/js/johndoe.js') }}"></script>
    <script>
        window.ajaxRoutes = {
            filterProjects: "{{ route('portfolio.filter') }}",
            csrfToken: "{{ csrf_token() }}"
        };
    </script>
    <script>
        // Add this script to your home page or a common JavaScript file
        document.querySelectorAll('a[href^="{{ route('home') }}#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href').substring(this.getAttribute('href').indexOf('#')); // Get the target section ID
                // Use window.location.href to go to the home page, then use the hash to scroll.
                window.location.href = "{{ route('home') }}" + targetId;

            });
        });
    </script>
</body>
</html>