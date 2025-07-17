@extends('layouts.admin')
@section('content')
<div class="title">
        <i class="uil uil-star"></i>
        <span class="text">Users</span>
</div>

<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Users</h4>

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
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td> @if ($user->avatar)
                <img src="{{ Storage::url( $user->avatar) }}" alt="" class="avatar">
            @else
                <img src="{{ Storage::url('default_avatar.png') }}" class="avatar">
            @endif
            </td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
                @if($user->role == '1')
                    Admin
                @elseif($user->role == 0)
                    User
                @endif
            </td>
            <td>
                <!-- Action buttons --> 
               <a href="{{ route('admin.user.edit-user-role', $user->id) }}" class="btn-success"><i class="uil uil-edit"> Edit Role</i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
        <!-- Pagination Links -->
        {{ $users->links('layouts.custom-pagination') }}
    </div>
</div>
@endsection