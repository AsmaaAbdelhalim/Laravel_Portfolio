<div class="container-fluid">
    <div id="about" class="row about-section">
        <div class="col-lg-4 about-card">
            <h3 class="font-weight-light">Who am I?</h3>
            <span class="line mb-5"></span>
            <h5 class="mb-3">{{ $about->title }}</h5>
            <p class="mt-20">{{ $about->description }}</p>
            <a href="{{ Storage::url( $pathabout['cv'].'/'.$about->cv) }}" class="btn btn-outline-danger" target="_blank">
                <i class="icon-down-circled2"></i> Download My CV
            </a>
        </div>

        <div class="col-lg-4 about-card">
            <h3 class="font-weight-light">Personal Info</h3>
            <span class="line mb-5"></span>
            <ul class="mt40 info list-unstyled">
                <li><span>Birthdate:</span> {{ $about->birth_date }}</li>
                <li><span>Email:</span> {{ $about->email }}</li>
                <li><span>Phone:</span> {{ $about->phone }}</li>
                <li><span>Skype:</span> John_Doe</li>
                <li><span>Address:</span> {{ $about->address }} {{ $about->city }} {{ $about->country }}.</li>
            </ul>

            <ul class="social-icons pt-3">
                    @foreach($about->social_links ?? [] as $link)
                <li class="social-item">
                    <a class="social-link" href="{{ $link['url'] }}" target="_blank" rel="noopener">
                        <i class="{{ $link['icon'] }}" aria-hidden="true"></i>
                    </a>
                </li>
                    @endforeach
            </ul>
        </div>

        <div class="col-lg-4 about-card">
            <h3 class="font-weight-light">My Expertise</h3>
            <span class="line mb-5"></span>
            <div class="row">
                @foreach ($experiences as $experience)
                    <div class="col-1 text-danger pt-1"><i class="ti-stats-up icon-lg"></i></div>
                    <div class="col-10 ml-auto mr-3">
                        <h6>{{ $experience->title }}</h6>
                        <p>{{ $experience->association }}</p>
                        <p>{{ $experience->from }} - {{ $experience->to }}</p>
                        <p class="subtitle">{{ $experience->description }}.</p>
                        <hr>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>