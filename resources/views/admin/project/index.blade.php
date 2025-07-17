@extends('layouts.admin')
@section('content')
<div class="title">
    <i class="uil uil-star"></i>
    <span class="text">Projects</span>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <a href="{{ route('admin.project.create')}}" class="btn btn-success btn-sm me-1"><i class="uil uil-plus">Add New</i></a>
    <div class="card">
      <div class="card-body"style="overflow-x: auto;">
        <h4 class="card-title">Projects Records</h4>
        {{-- <p class="card-description"></code> --}}
        </p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Description </th>
                    <th> Category </th>
                    <th> Image </th>
                    <th> Images </th>
                    <th> views </th>
                    <th> Created By </th>
                    <th> Updated By </th>
                    <th> Manage </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                <tr>
                    <td> {{ $project -> id }} </td>
                    <td> {{ $project -> name }} </td>
                    <td> {{ $project -> description }} </td>
                    <td> {{ $project -> category -> name }} </td>
                    <td>
                        @if($project->image)
                        <img src="{{ Storage::url( $path .'/'.$project->image) }}" alt="{{ $project->name }}" class="table-image">
                        @endif
                    </td>
                    <td>
                        @foreach($project->images as $image)
                        <img src="{{ Storage::url( $path .'/'.$image->image) }}" alt="{{ $image->name }}" class="table-image">
                        @endforeach
                    </td>
                    <td> {{ $project->views }} <i class="uil uil-eye"></i></td>
                    <td> {{ $project->creator ? $project->creator->first_name : 'N/A' }}
                        , At {{ $project->created_at->format('Y-m-d H:i:s') }}
                    </td>
                    <td> 
                        @foreach($project->updaters as $updater)
                        - {{ $updater['user']->first_name }} {{ $updater['user']->last_name }} 
                        , At {{ \Carbon\Carbon::parse($updater['updated_at'])->format('Y-m-d H:i:s') }}
                        <br>
                        @endforeach
                    </td>
                    <td>
                <a href="{{ route('admin.project.edit', $project->id) }}" class="btn-success"><i class="uil uil-edit"></i></a>
                
                <form action="{{ route('admin.project.destroy', $project->id) }}" method="POST" style="display:inline-block;">
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
    </div>{{ $projects->links('layouts.custom-pagination') }}
</div>
@endsection