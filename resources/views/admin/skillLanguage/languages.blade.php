@extends('layouts.admin')
@section('content')

<div class="title">
        <i class="uil uil-star"></i>
        <span class="text">Languages</span>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <a href="{{ route('admin.skillLanguage.create') }}" class="btn btn-success btn-sm me-1">
            <i class="uil uil-plus"></i> Add New
        </a>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Languages Records</h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Language</th>
                            <th>Color</th>
                            <th>Percent</th>
                            <th>Level</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($languages as $language)
                            <tr>
                                <td>{{ $language->id }}</td>
                                <td>{{ $language->name }}</td>
                                <td><span style="background-color: {{ $language->color }}; display: inline-block; width: 30px; height: 20px;"></span></td>
                                <td>{{ $language->percent }}%</td>
                                <td>{{ $language->level }}</td>
                                <td>
                                    <a href="{{ route('admin.skillLanguage.edit', $language->id) }}" class="btn btn-success btn-sm me-1">
                                        <i class="uil uil-edit"></i> Edit
                                    </a>

                                    <form method="POST" style="display: inline" action="{{ route('admin.skillLanguage.destroy', $language->id) }}" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="uil uil-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        
        <!-- Pagination Links -->
        {{ $languages->links('layouts.custom-pagination') }}
    </div>

@endsection