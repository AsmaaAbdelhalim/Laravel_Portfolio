@extends('layouts.admin')
@section('content')

<div class="title">
    <i class="uil uil-tachometer-fast-alt"></i>
    <span class="text">Edit Service</span>
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
    <h2>Edit Service</h2>
    <form action="{{ route('admin.service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
             @csrf
            @method('PUT')

        <div class="input-group">
            <label for="name">Service Title:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $service->name )}}" required placeholder="Enter Service title">
        </div>

        <!-- Icon Selector Modal Area -->
         
        <div class="input-group flex items-center gap-2">
            <label for="icon" class="w-auto">Icon</label>
            <input type="hidden" id="selectedIcon" name="icon" value="{{ old('icon', $service->icon ) }}">
            <button type="button" id="iconSelector" class="btn btn-secondary w-full text-left flex items-center gap-2">
                <i class="fas fa-icons"></i>
                <span>Select an icon</span>
            </button>
            <div id="iconPreview" class="mt-2"></div>    
        </div>

        <div class="input-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required>{{ old('description', $service->description ) }}</textarea>
        </div>

        <div class="input-group">
            <button type="submit" class="btn-success"><i class="uil uil-edit"></i> Update</button>
        </div>
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