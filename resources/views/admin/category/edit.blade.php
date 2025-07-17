@extends('layouts.admin')
@section('content')

<div class="title">
    <i class="uil uil-tachometer-fast-alt"></i>
    <span class="text">Edit Category</span>
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

<!-- Form for Editing Category -->
<div class="card">
    <h2>Edit Category</h2>
    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Use PUT method for updating -->

        <div class="input-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="input-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="input-group">
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            @if($category->image)
                <p>Current Image: <img src="{{ Storage::url($path . '/' . $category->image) }}" alt="Current Image" class="table-image"></p>
            @else
                <p>No image uploaded.</p>
            @endif
        </div>

        <div class="input-group">
            <label for="portfolio_id">Portfolio:</label>
            <select name="portfolio_id" id="portfolio_id">
                @foreach ($portfolios as $portfolio)
                    <option value="{{ $portfolio->id }}" {{ $portfolio->id == $category->portfolio_id ? 'selected' : '' }}>
                        {{ $portfolio->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <button type="submit" class="btn-success"><i class="uil uil-edit"></i> Update</button>
        </div>
    </form>
</div>

@endsection