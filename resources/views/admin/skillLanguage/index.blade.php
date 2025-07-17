@extends('layouts.admin')

@section('content')

    <div class="title">
        <i class="uil uil-star"></i>
        <span class="text">Skills And Languages</span>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <a href="{{ route('admin.skillLanguage.create') }}" class="btn btn-success btn-sm me-1">
            <i class="uil uil-plus">Add New</i>
        </a>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Skills And Languages Records</h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Skill / Language</th>
                            <th>Type</th>
                            <th>Color</th>
                            <th>Percent</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skillLanguages as $skillLanguage)
                            <tr>
                                <td>{{ $skillLanguage->id }}</td>
                                <td>{{ $skillLanguage->name }}</td>
                                <td>{{ $skillLanguage->type }}</td>
                                <td><span style="background-color: {{ $skillLanguage->color }}; display: inline-block;"class="table-image"></span></td>
                                <td>{{ $skillLanguage->percent }}%</td>
                                <td>
                <a href="{{ route('admin.skillLanguage.edit', $skillLanguage->id) }}" class="btn-success"><i class="uil uil-edit"></i></a>
                
                <form action="{{ route('admin.skillLanguage.destroy', $skillLanguage->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="uil uil-trash-alt"></i>
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
        {{ $skillLanguages->links('layouts.custom-pagination') }}
    </div>

@endsection