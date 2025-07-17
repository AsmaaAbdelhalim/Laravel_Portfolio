<div class="section contact" id="contact">
        <div id="map" class="map"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-form-card">
                        <h4 class="contact-title">Send a message</h4>
                        <!--form -->

<form id="ContactForm" wire:submit.prevent="submit">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="form-group">
        <input type="text" for="name" class="form-control" id="exampleInputName" placeholder="Name *" wire:model="name" name="name">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="exampleInputEmail" placeholder="Email *" wire:model="email" name="email">
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="exampleInputPhone" placeholder="Phone *" wire:model="phone" name="phone">
        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="exampleInputCity" placeholder="City *" wire:model="city" name="city">
        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="exampleInputCountry" placeholder="Country *" wire:model="country" name="country">
        @error('country') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="exampleInputSubject" placeholder="Subject *" wire:model="subject" name="subject">
        @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <textarea class="form-control" id="exampleInputbody" placeholder="Message *" wire:model="message" name="message"></textarea>
        @error('message') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <button type="submit" class="form-control btn btn-primary">Send Message</button>
</form>

<!--end form -->

</div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-info-card">
                        <h4 class="contact-title">Get in touch</h4>
                        <div class="row mb-2">
                            <div class="col-1 pt-1 mr-1">
                                <i class="ti-mobile icon-md"></i>
                            </div>
                            <div class="col-10 ">
                                <h6 class="d-inline">Phone : <br> <span class="text-muted">{{ $about->phone }}</span></h6>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-1 pt-1 mr-1">
                                <i class="ti-map-alt icon-md"></i>
                            </div>
                            <div class="col-10">
                                <h6 class="d-inline">Address :<br> <span class="text-muted">{{ $about->address }}.</span></h6>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-1 pt-1 mr-1">
                                <i class="ti-envelope icon-md"></i>
                            </div>
                            <div class="col-10">
                                <h6 class="d-inline">Email :<br> <span class="text-muted">{{ $about->email }}</span></h6>
                            </div>
                        </div>
                        <ul class="social-icons pt-4">
                        @foreach($about->social_links ?? [] as $link)
                            <li class="social-item">
                                <a class="social-link text-dark" href="{{ $link['url'] }}" target="_blank" rel="noopener">
                                    <i class="{{ $link['icon'] }}" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endforeach
                        </ul> 
                    </div>
                </div>
            </div>
        </div>
    </div>