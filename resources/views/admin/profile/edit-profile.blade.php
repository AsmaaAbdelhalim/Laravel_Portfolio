@extends('layouts.app')
@section('content')
    <div class="row"> 
    <div class="col-lg-10 m-auto py-2">
        <div class="col-md-12">
                    <div class="card-title"><h4>Edit Profile<h4></div>
                    <div class="card">
                        <div class="card-body">
                    <form class="form-horizontal" action="{{ route('admin.profile.update-profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                        </div>
                      </div>
                        <div class="form-group row">
                        <label for="last_ame" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="avatar" id="avatar" accept="image/*">
                        </div>
                      </div>
  
    <div class="form-group">
        <label for="current_avatar">Current Avatar</label>
        @if ($user->avatar)
            <img src="{{ Storage::url( $user->avatar) }}" alt="Avatar" style="border-radius: 50%; height: 100px; width: 100px;">
        @else
            <img src="{{ Storage::url('default_avatar.png') }}" alt="Default Avatar" style="border-radius: 50%; height: 100px; width: 100px;">
        @endif
    </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Update Profile</button>
                        </div>
                      </div>
                    </form> 

</div>         
</div> 
</div>
        </div>
    </div>
</div>
@endsection


                                                  