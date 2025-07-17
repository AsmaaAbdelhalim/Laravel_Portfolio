@extends('layouts.admin')

@section('content')

    <div class="title">
        <i class="uil uil-tachometer-fast-alt"></i>
        <span class="text">Add New Qualification</span>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <h2>Add Qualification</h2>
        <form action="{{ route('admin.qualification.store') }}" method="POST">
            @csrf

            <!-- Title input -->
            <div class="input-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Enter Title">
            </div>

            <!-- Association input -->
            <div class="input-group">
                <label for="association">Association:</label>
                <input type="text" id="association" name="association" value="{{ old('association') }}" required placeholder="Enter Association">
            </div>

            <!-- Description input -->
            <div class="input-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="{{ old('description') }}" required placeholder="Enter Description">
            </div>

            <!-- Type input -->
            <div class="input-group">
                <label for="type">Type:</label>
                <select id="type" name="type" class="form-control text-black" required>
                    <option value="Education" {{ old('type') == "Education" ? 'selected' : '' }}>Education</option>
                    <option value="Work" {{ old('type') == "Work" ? 'selected' : '' }}>Work</option>
                </select>
            </div>

            <p class="card-description">Duration</p>
            <div class="row">
                <!-- From input -->
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="from">From:</label>
                        <input type="text" id="from" name="from" value="{{ old('from') }}" required placeholder="Enter Start Date">
                    </div>
                </div>
                <!-- To input -->
                <div class="col-md-6">
                    <div class="input-group">
                        <label for="to">To:</label>
                        <input type="text" id="to" name="to" value="{{ old('to') }}" required placeholder="Enter End Date">
                    </div>
                </div>
            </div>

            <!-- Submit button -->
            <div class="input-group">
                <button type="submit" class="btn-success"><i class="uil uil-plus"></i> Create Qualification</button>
            </div>
        </form>
    </div>

@endsection