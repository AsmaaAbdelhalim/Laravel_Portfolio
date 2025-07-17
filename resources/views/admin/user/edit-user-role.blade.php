@extends('layouts.admin')
@section('content')
<div class="title">
        <i class="uil uil-star"></i>
        <span class="text">Edit User Role</span>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <a href="{{ route('admin.user.users') }}" class="btn-success">
            <i class="uil uil-arrow-left"></i>
            <i class="uil uil-users-alt" title="Back to Users"></i> Back To Users
        </a>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Users Records</h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>

                                    <th>ID</th>
            
                                    <th>Photo</th>
            
                                    <th>Name</th>
            
                                    <th>Last Name</th>
            
                                    <th>Email</th>
            
                                    <th>Created at</th>
            
                                    <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>

                    <tr>
            <td>{{ $user->id }}</td>
            <td>@if ($user->avatar)
                    <img src="{{ Storage::url( $user->avatar) }}" alt="Avatar" class="avatar">
                @else
                    <img src="{{ Storage::url('default_avatar.png') }}" class="avatar">
                @endif</td>   
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>@if($user->role == '1')
                    Admin
                @elseif($user->role == 0)
                    User
                @endif
            </td>
        </tr>
                    </tbody>
                </table>

                <form action="{{ route('admin.user.edit-user-role', $user) }}" method="POST">
    @csrf
    @method('PUT')
        <h3><label for="role" class="form-label">Role:</label></h3>
        <div class="input-group">
            <select name="role" id="role">
                <option value="1" {{ $user->role === '1' ? 'selected' : '1' }}>Admin</option>
                <option value="0" {{ $user->role === '0' ? 'selected' : '0' }}>User</option>
            </select>
        </div>
        <button class="btn-success" type="submit"><i class="uil uil-edit"></i> Update</button>
    </form>
            </div>
        </div>
    </div>

@endsection