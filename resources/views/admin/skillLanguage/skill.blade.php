@extends('layouts.admin')
@section('content')

<div class="title">
        <i class="uil uil-star"></i>
        <span class="text">Skills</span>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <a href="{{ route('admin.skillLanguage.create') }}" class="btn btn-success btn-sm me-1">
            <i class="uil uil-plus"></i> Add New
        </a>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Skills Records</h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Skill</th>
                            <th>Color</th>
                            <th>Percent</th>
                            <th>Level</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skills as $skill)
                            <tr>
                                <td>{{ $skill->id }}</td>
                                <td>{{ $skill->name }}</td>
                                <td><span style="background-color: {{ $skill->color }}; display: inline-block; width: 30px; height: 20px;"></span></td>
                                <td>{{ $skill->percent }}%</td>
                                <td>{{ $skill->level }}</td>
                                <td>
                                    <a href="{{ route('admin.skillLanguage.edit', $skill->id) }}" class="btn btn-success btn-sm me-1">
                                        <i class="uil uil-edit"></i> Edit
                                    </a>

                                    <form method="POST" style="display: inline" action="{{ route('admin.skillLanguage.destroy', $skill->id) }}" onsubmit="return confirm('Are you sure?')">
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
        {{ $skills->links('layouts.custom-pagination') }}
    </div>

@endsection