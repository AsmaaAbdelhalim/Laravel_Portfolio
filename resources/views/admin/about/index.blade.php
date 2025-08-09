@extends('layouts.admin')

@section('content')

    <div class="title">
        <i class="uil uil-info-circle"></i>
        <span class="text">About Information</span>
    </div>
    @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">About Details</h4>
            <table class="table table-bordered">
                <tbody>            
            <tr><td><strong>First Name:</strong></td> <td> {{ $about->first_name }}</td></tr>
            <tr><td><strong>Last Name:</strong></td> <td> {{ $about->last_name }}</td></tr>
            <tr><td><strong>Email:</strong></td> <td> {{ $about->email }}</td></tr>
            <tr><td><strong>Phone:</strong></td> <td> {{ $about->phone }}</td></tr>
            <tr><td><strong>Birth Date:</strong></td> <td> {{ $about->birth_date }}</td></tr>
            <tr><td><strong>Avatar:</strong></td> <td> 
                @if($about->avatar)
                <img src="{{ Storage::url( $pathabout['avatar'] .'/'.$about->avatar) }}" alt="Avatar" class="avatar">
                @else
                <img src="{{ Storage::url('default_avatar.png') }}" alt="Default Avatar" class="avatar">
                @endif
            </td></tr>
            <tr><td><strong>City:</strong></td> <td> {{ $about->city }}</td></tr>
            <tr><td><strong>Country:</strong></td> <td> {{ $about->country }}</td></tr>
            <tr><td><strong>Address:</strong></td> <td> {{ $about->address }}</td></tr>
            <tr><td><strong>City:</strong></td> <td> {{ $about->city }}</td></tr>
            <tr><td><strong>Country:</strong></td> <td> {{ $about->country }}</td></tr>
            <tr><td><strong>Job:</strong></td> <td> {{ $about->job }}</td></tr>
            <tr><td><strong>Degree:</strong></td> <td> {{ $about->degree }}</td></tr>
            <tr><td><strong>Experience:</strong></td> <td> {{ $about->experience }}</td></tr>
            <tr><td><strong>Title:</strong></td> <td> {{ $about->title }}</td></tr>
            <tr><td><strong>Description:</strong></td> <td> {{ $about->description }}</td></tr>
            <tr><td><strong>Header Image:</strong></td> <td> <img src="{{ Storage::url( $pathabout['header_image'] .'/'.$about->header_image) }}" alt="Header Image" class="table-image"> </td></tr>
            <tr><td><strong>CV:</strong></td> <td> <a href="{{ Storage::url( $pathabout['cv'].'/'.$about->cv) }}" target="_blank">Download CV</a> </td></tr>
            
            @foreach($about->social_links ?? [] as $link)
            <tr><td><strong>{{ $link['platform'] }}:</strong></td> 
            <td><a class="social-link text-light" href="{{ $link['url'] }}" target="_blank" rel="noopener">
                <i class="{{ $link['icon'] }}" aria-hidden="true"></i>
            </a></td></tr>
            @endforeach

            <tr><td><strong>Email:</strong></td> <td> {{ $about->email }}</td></tr>
            <tr><td><strong>Created By:</strong></td> <td> {{ $about->creator ? $about->creator->first_name : 'N/A' }}, At {{ $about->created_at }}</td></tr>
            <tr><td><strong>Updated By:</strong></td> <td> 


                @foreach($about->updaters as $updater)

                - {{ $updater['user']->first_name }} {{ $updater['user']->last_name }} 
                        , At {{ \Carbon\Carbon::parse($updater['updated_at'])->format('Y-m-d H:i:s') }}
                    <br>
                @endforeach
                </td>
            </tr>
                </tbody>
            </table>
            <a href="{{ route('admin.about.edit', $about->id) }}" class="btn-success "><i class="uil uil-edit"></i> Edit</a>

        </div>
    </div>

@endsection