@extends('layouts.admin')

@section('content')

    <div class="title">
        <i class="uil uil-tachometer-fast-alt"></i>
        <span class="text">Edit Skill/Language </span>
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
        <h2>Edit Skill/Language</h2>
        <form action="{{ route('admin.skillLanguage.update', $skillLanguage->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group">
                <label for="name">Skill/Language Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $skillLanguage->name) }}" required>
            </div>

            <div class="input-group">
                <label for="colorpicker">Color:</label>
                <input type="color" id="colorpicker" name="color" value="{{ old('color', $skillLanguage->color) }}" required>
            </div>

            <div class="input-group">
                <label for="percent">Percent:</label>
                <input type="number" id="percent" name="percent" value="{{ old('percent', $skillLanguage->percent) }}" required>
            </div>
                        <!-- Type selection (Skill or Language) -->
                        <div class="input-group">
                <label for="type">Type:</label>
                <select name="type" id="type" required>
                    <option value="skill" {{ old('type') == 'skill' ? 'selected' : '' }}>Skill</option>
                    <option value="language" {{ old('type') == 'language' ? 'selected' : '' }}>Language</option>
                </select>
            </div>

            <button type="submit" class="btn-success"><i class="uil uil-edit"></i> Update Skill/Language</button>
        </form>
    </div>

@endsection