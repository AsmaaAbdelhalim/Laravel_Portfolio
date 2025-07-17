@extends('layouts.admin')

@section('content')

    <div class="title">
        <i class="uil uil-tachometer-fast-alt"></i>
        <span class="text">Add New Portfolio</span>
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
        <h2>Add Portfolio</h2>
        <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name input -->
            <div class="input-group">
                <label for="name">Portfolio Name:</label>
                <input type="text" id="name" name="name" required placeholder="Enter Project title">
            </div>

            <!-- URL input -->
            <div class="input-group">
                <label for="url">Portfolio URL:</label>
                <input type="text" id="url" name="url" required placeholder="Enter Project URL">
            </div>

            <!-- Image upload -->
            <div class="input-group">
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <!-- Description input -->
            <div class="input-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required>{{ old('description') }}</textarea>
            </div>

            <!-- Submit button -->
            <div class="input-group">
                <button type="submit" class="btn-success"><i class="uil uil-plus"></i> Create Portfolio</button>
            </div>
        </form>
    </div>

@endsection