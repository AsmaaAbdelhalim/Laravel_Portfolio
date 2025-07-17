@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"><h1>Profile</h1>
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-10">
                            @if ($user->avatar)
                                <img src="{{ Storage::url( $user->avatar) }}" alt="Avatar" style="border-radius: 50%; height: 200px; width: 200px;">
                            @else
                                <img src="{{ Storage::url('default_avatar.png') }}"  style="border-radius: 50%; height: 200px; width: 200px;">
                            @endif
                            <h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Phone:</strong> {{ $user->phone }}</p>
                            <p><strong>Role:</strong>
                                @if($user->role == '1')
                                    Admin
                                @elseif($user->role == 0)
                                    User
                                @endif
                            </p>
                            <p><strong>Created at:</strong> {{ $user->created_at }}</p>
                            <p><strong>Updated at:</strong> {{ $user->updated_at }}</p>
                            <a href="{{ route('admin.profile.edit-profile', $user->id) }}" class="btn btn-primary"><i class="uil uil-edit">Edit</i></a>
                            <a href="{{ route('admin.profile.change-password') }}" class="btn btn-primary"><i class="uil uil-edit">Change Password</i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection