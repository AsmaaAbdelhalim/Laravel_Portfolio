@extends('layouts.admin')
@section('content')

<div class="title">
    <i class="uil uil-tachometer-fast-alt"></i>
    <span class="text">Add New Service</span>
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
    <h2>Add Service</h2>
    <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Name input -->
        <div class="input-group">
            <label class="form-label" for="name">Service Name</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-input" 
                   value="{{ old('name') }}" 
                   required>
        </div>

        <div class="input-group flex items-center gap-2">
            <label for="icon" class="w-auto">Icon</label>
            <input type="hidden" id="selectedIcon" name="icon" value="{{ old('icon') }}">
            <button type="button" id="iconSelector" class="btn btn-secondary w-full text-left flex items-center gap-2">
                <i class="fas fa-icons"></i>
                <span>Select an icon</span>
            </button>
            <div id="iconPreview" class="mt-2"></div>    
        </div>

        <div class="input-group">
            <label class="form-label" for="description">Description</label>
            <textarea id="description" name="description" class="form-input" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn-success"><i class="uil uil-plus"></i> Create Service</button>
    </form>
</div>

<!-- Icon Modal -->
<div id="iconModal" class="icon-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="text-lg font-semibold">Select an Icon</h3>
            <button type="button" class="btn-close">
                    <i class="uil uil-times"></i>                    
            </button>
        </div>
        <div class="modal-body">
            <div class="icon-sidebar">
                <div class="sidebar-category active" data-category="all">All Icons</div>
                @foreach ($icons as $category => $iconList)
                    <div class="sidebar-category" data-category="{{ $category }}">{{ ucfirst($category) }}</div>
                @endforeach
            </div>
            <div class="icon-container">
                <div class="search-container">
                    <input type="text" 
                           class="search-input" 
                           placeholder="Search icons..."
                           id="iconSearch">
                </div>
                <div class="icon-grid" id="iconGrid"></div>
            </div>
        </div>
    </div>
</div>

<script>
    const iconCategories = @json($icons);
</script>
@endsection