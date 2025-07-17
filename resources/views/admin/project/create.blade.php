@extends('layouts.admin')
@section('content')
    <div class="card">
        <h2>Add Project</h2>
        <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Basic project inputs -->
            <div class="input-group">
                <label for="name">Project Title:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="input-group">
                <label for="url">Project URL:</label>
                <input type="text" id="url" name="url" value="{{ old('url') }}" required>
            </div>

            <div class="input-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required>{{ old('description') }}</textarea>
            </div>

            <!-- Main project image -->
            <div class="input-group">
                <label for="image">Main Project Image:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <!-- Additional Images -->
            <div id="additional-images">
                <h3>Additional Images</h3>
                <div class="image-group">
                    <div class="input-group">
                        <label>Image 1:</label>
                        <input type="file" name="images[]" accept="image/*">
                    </div>
                </div>
            </div>

            <button type="button" id="addImage" class="btn-success"><i class="uil uil-plus"></i> Add More Images</button>

            <div class="input-group">
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-success"><i class="uil uil-plus"></i> Create Project</button>
        </form>
    </div>

    <script>

    </script>

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