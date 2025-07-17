<section class="section" id="service">
        <div class="container">
            <h2 class="mb-5 pb-4"><span class="text-danger">My</span> Services</h2>
            <div class="row">           
            @foreach ($services as $service)
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-5">
                       <div class="card-header has-icon">
                            <i class="{{ $service->icon }} text-danger" aria-hidden="true"></i>
                        </div>
                        <div class="card-body px-4 py-3">
                            <h5 class="mb-3 card-title text-dark">{{ $service->name }}</h5>
                            <P class="subtitle">{{ $service->description}}.</P>
                        </div>
                    </div>
                </div>@endforeach    
            </div>
        </div>
    </section>