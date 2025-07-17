@extends('layouts.admin')

@section('content')
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
    <h2>Edit Project</h2>
    <form action="{{ route('admin.project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="user_id" value="{{ $project->user_id }}">

        <!-- Basic project inputs -->
        <div class="input-group">
            <label for="name">Project Title:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $project->name) }}" required>
        </div>

        <div class="input-group">
            <label for="url">Project URL:</label>
            <input type="text" id="url" name="url" value="{{ old('url', $project->url) }}" required>
        </div>

        <div class="input-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required>{{ old('description', $project->description) }}</textarea>
        </div>

        <!-- Main project image -->
        <div class="input-group">
            <label for="image">Main Project Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            @if($project->image)
                <p>Current Image: <img src="{{ Storage::url( $path .'/'.$project->image) }}" alt="Current Image" class="table-image"></p>
            @endif
        </div>

        <!-- Additional Images -->
        <div id="additional-images">
            <h3>Additional Images</h3>
            @foreach($project->images as $index => $image)
                <div class="image-group existing-image-group" data-id="{{ $image->id }}">
                    <div class="input-group">
                        <label>Image {{ $index + 1 }} : Current Image <img src="{{ Storage::url( $path .'/'.$image->image) }}" alt="Current Image" class="table-image"></label>
                        <input type="file" name="images[{{ $image->id }}]" accept="image/*">
                        <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                        <p>Current Image: <img src="{{ Storage::url( $path .'/'.$image->image) }}" alt="Current Image" class="table-image"></p>
                        <button type="button" class="btn-danger remove-existing-image" data-id="{{ $image->id }}"><i class="uil uil-trash-alt"></i></button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Deleted images will be tracked here -->
        <div id="deleted-images-container"></div>

        <button type="button" id="addImage" class="btn-success"><i class="uil uil-plus"></i> Add More Images</button>

        <div class="input-group">
            <label for="category_id">Category:</label>
            <select name="category_id" id="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $project->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-success"><i class="uil uil-edit"></i> Update Project</button>
    </form>
</div>

<!-- Styles -->
<style>
    .image-group {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
    }
    .input-group {
        margin-bottom: 10px;
    }
</style>

@endsection