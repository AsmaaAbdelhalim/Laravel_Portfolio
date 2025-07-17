@extends('layouts.admin')
@section('content')

        <div class="title">
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Add New Category</span>
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
            <!-- Form for Creating/Updating Records -->
            <div class="card">
                <h2>Add Category</h2>
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                     <!-- For editing, to hold ID -->
                    <div class="input-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="input-group">
                        <label for="description">Description:</label>
                        <textarea type="text" id="description" name="description"></textarea>
                    </div>
                    <div class="input-group">
                        <label for="image">Upload Image:</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                    <div class="input-group">
                        <label for="portfolio_id">Portfolio:</label>
                        <select name="portfolio_id" id="portfolio_id">
                    @foreach ($portfolios as $portfolio)
                        <option value="{{ $portfolio->id }}">{{ $portfolio->name }}</option>
                    @endforeach
                </select>
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn-success"><i class="uil uil-plus"></i> Create</button>
                    </div>
                </form>
            </div>
@endsection