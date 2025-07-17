@extends('layouts.admin')

@section('content')

    <div class="title">
        <i class="uil uil-tachometer-fast-alt"></i>
        <span class="text">Edit Portfolio</span>
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
        <h2>Edit Portfolio</h2>
        <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name input -->
            <div class="input-group">
                <label for="name">Portfolio Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $portfolio->name) }}" required placeholder="Enter Portfolio Name">
            </div>

            <!-- URL input -->
            <div class="input-group">
                <label for="url">Portfolio URL:</label>
                <input type="text" id="url" name="url" value="{{ old('url', $portfolio->url) }}" required placeholder="Enter Portfolio URL">
            </div>

            <!-- Image upload -->
            <div class="input-group">
                <label for="image">Upload New Image (optional):</label>
                <input type="file" id="image" name="image" accept="image/*">
                @if($portfolio->image)
                    <p>Current Image: <img src="{{ Storage::url( $path .'/'.$portfolio->image) }}" alt="Current Image" class="table-image"></p>
                @else
                    <p>No image uploaded.</p>
                @endif
            </div>

            <!-- Description input -->
            <div class="input-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required>{{ old('description', $portfolio->description) }}</textarea>
            </div>

            <!-- Submit button -->
            <div class="input-group">
                <button type="submit" class="btn-success"><i class="uil uil-edit"></i> Update Portfolio</button>
            </div>
        </form>
    </div>

@endsection