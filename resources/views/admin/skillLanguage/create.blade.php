@extends('layouts.admin')

@section('content')

    <div class="title">
        <i class="uil uil-tachometer-fast-alt"></i>
        <span class="text">Add New Skill or Language</span>
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
        <h2>Add Skill or Language</h2>
        <form action="{{ route('admin.skillLanguage.store') }}" method="POST">
            @csrf

            <!-- Color Picker input -->
            <div class="input-group">
                <label for="colorpicker">Color:</label>
                <input type="color" id="colorpicker" name="color" value="{{ old('color') }}" required>
            </div>

            <!-- Skill/Language Name input -->
            <div class="input-group">
                <label for="name">Skill/Language Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter name">
            </div>

            <!-- Percent input -->
            <div class="input-group">
                <label for="percent">Percent:</label>
                <input type="number" id="percent" name="percent" value="{{ old('percent') }}" placeholder="From 1 to 100" min="1" max="100">
            </div>
            <!-- Type selection (Skill or Language) -->
            <div class="input-group">
                <label for="type">Type:</label>
                <select name="type" id="type" required>
                    <option value="skill" {{ old('type') == 'skill' ? 'selected' : '' }}>Skill</option>
                    <option value="language" {{ old('type') == 'language' ? 'selected' : '' }}>Language</option>
                </select>
            </div>

            <!-- Submit button -->
            <div class="input-group">
                <button type="submit" class="btn-success"><i class="uil uil-plus"></i> Create Skill/Language</button>
            </div>
        </form>
    </div>

@endsection
