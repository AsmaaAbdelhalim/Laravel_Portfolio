@include('layouts.header')
@extends('layouts.app')
@section('content')
<div>
@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif
</div>
@include('partials.abouts')
    <!--Resume Section-->
    <section class="section" id="resume">
        <div class="container">
            <h2 class="mb-5"><span class="text-danger">My</span> Resume</h2>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                       <div class="card-header">
                            <div class="mt-2">
                                <h4>Expertise</h4>
                                <span class="line"></span>  
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($experiences as $experience)
                            <h6 class="title text-danger">{{ $experience->from }} - {{ $experience->to }}</h6>
                            <P>{{ $experience->title }} - {{ $experience->association }}</P>
                            <P class="subtitle">{{ $experience->description }}.</P>
                            <hr>@endforeach
                        </div>   
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                       <div class="card-header">
                            <div class="mt-2">
                                <h4>Education</h4>
                                <span class="line"></span>  
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($educations as $education)
                            <h6 class="title text-danger">{{ $education->from }} - {{ $education->to }}</h6>
                            <P>{{ $education->title }} - {{ $education->association }}</P>
                            <P class="subtitle">{{ $education->description }}Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, id officiis quas placeat quia voluptas dolorum rem animi nostrum quae.aliquid repudiandae saepe!.</P>
                            <hr>@endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                       <div class="card-header">
                            <div class="pull-left">
                                <h4 class="mt-2">Skills</h4>
                                <span class="line"></span>  
                            </div>
                        </div>
                        <div class="card-body pb-2">
                            @foreach ($skills as $skill)
                            <div class="row mb">
                        <div class="col-auto">
                            <h6>- {{ $skill->name }}</h6>
                        </div>
                            </div>
                            @if($skill->percent)
                            <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" style="background-color: {{$skill->color }} ;width: {{$skill->percent}}%" aria-valuenow="{{$skill->percent}}" aria-valuemin="0" aria-valuemax="100">{{ $skill->level }}</div>
                    </div>@endif
                    @endforeach
                        </div>
                    </div>
                    <div class="card">
                       <div class="card-header">
                            <div class="pull-left">
                                <h4 class="mt-2">Languages</h4>
                                <span class="line"></span>  
                            </div>
                        </div>
                        <div class="card-body pb-2">
                            @foreach ($languages as $language)
                            <h6>- {{ $language->name }}</h6>

                            @if($language->percent)
                            <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" style="background-color: {{$language->color }} ;width: {{$language->percent}}%" aria-valuenow="{{$language->percent}}" aria-valuemin="0" aria-valuemax="100">{{ $language->level }}</div>
                            </div>@endif
                             @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-dark text-center">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6 col-lg-3">
                    <div class="row ">
                        <div class="col-5 text-right text-light border-right py-3">
                            <div class="m-auto"><i class="ti-alarm-clock icon-xl"></i></div>
                        </div>
                        <div class="col-7 text-left py-3">
                            <h1 class="text-danger font-weight-bold font40">500</h1>
                            <p class="text-light mb-1">Hours Worked</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="row">
                        <div class="col-5 text-right text-light border-right py-3">
                            <div class="m-auto"><i class="ti-layers-alt icon-xl"></i></div>
                        </div>
                        <div class="col-7 text-left py-3">
                            <h1 class="text-danger font-weight-bold font40">50K</h1>
                            <p class="text-light mb-1">Project Finished</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="row">
                        <div class="col-5 text-right text-light border-right py-3">
                            <div class="m-auto"><i class="ti-face-smile icon-xl"></i></div>
                        </div>
                        <div class="col-7 text-left py-3">
                            <h1 class="text-danger font-weight-bold font40">200K</h1>
                            <p class="text-light mb-1">Happy Clients</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="row">
                        <div class="col-5 text-right text-light border-right py-3">
                            <div class="m-auto"><i class="ti-heart-broken icon-xl"></i></div>
                        </div>
                        <div class="col-7 text-left py-3">
                            <h1 class="text-danger font-weight-bold font40">2k</h1>
                            <p class="text-light mb-1">Coffee Drinked</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partials.services')

    <section class="section bg-dark py-5">
        <div class="container text-center">
            <h2 class="text-light mb-5 font-weight-normal">I Am Available For FreeLance</h2>
            <button class="btn bg-primary w-lg" >Hire me</button>
        </div>
    </section>

<!-- Portfolio Section -->
 @include('partials.portfolio')

<!-- Include contact form -->
@livewire('contact-form')
@endsection