    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <header class="header" style="background-image: url('{{ $about && $about->header_image ? Storage::url( $pathabout['header_image'] .'/'.$about->header_image) : asset('assets/imgs/header.jpg') }}');">
        <div class="container">
            <!-- Social Icons -->
        @if($about && !empty($about->social_links))
            <ul class="social-icons pt-3">
    @foreach($about->social_links ?? [] as $link)
        <li class="social-item">
            <a class="social-link text-light" href="{{ $link['url'] }}" target="_blank" rel="noopener">
                <i class="{{ $link['icon'] }}" aria-hidden="true"></i>
            </a>
        </li>
    @endforeach
</ul>
@endif
            <div class="header-content">
                <h4 class="header-subtitle" >Hello, I am</h4>
                <h1 class="header-title">{{ $about->first_name ?? 'Portfolio' }} {{ $about->last_name ?? '' }}</h1>
                <h6 class="header-mono" >{{ $about->job ?? 'Professional' }}</h6>
                @if($about && $about->cv)
                <a href="{{ Storage::url( $pathabout['cv'].'/'.$about->cv) }}" class="btn btn-primary btn-rounded" target="_blank"><i class="ti-printer pr-2"></i>Print Resume</a>
                @endif
            </div>
        </div>
    </header>