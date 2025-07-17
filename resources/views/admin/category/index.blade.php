@extends('layouts.admin')
@section('content')
                <div class="title">
                    <i class="uil uil-star"></i>
                    <span class="text">Categories</span>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                <a href="{{ route('admin.category.create')}}" class="btn btn-success btn-sm me-1"><i class="uil uil-plus">Add New</i></a>
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Categories Records</h4>
                        {{-- <p class="card-description"></code> --}}
                        </p>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th> # </th>
                              <th> Category Name </th>
                              <th> Image </th>
                              <th> Portfolio </th>
                              <th> Projects </th>
                              <th> Created By </th>
                              <th> Updated By </th>
                              <th> Action </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($categories as $category)
                            <tr>
                              <td> {{ $category->id }} </td>
                              <td> {{ $category->name }} </td>
                              <td>
                              <img src="{{ Storage::url( $path .'/'. $category->image) }}" alt="Category Image"width="100" class="table-image"></td>
                              <td>{{ $category->portfolio ? $category->portfolio->name : 'N/A' }}</td>
                              </td>
                              <td>
                                * {{ $category->projects->count() }} Projects
                                <br>
                                @foreach($category->projects as $project)
                                  <span class="badge badge-primary">{{ $project->name }}</span><br>
                                @endforeach
                              </td>
                              <td>
                             - {{ $category->creator ? $category->creator->first_name : 'N/A' }}
                              </td>
                              <td>@foreach($category->updaters as $updater)

                              - {{ $updater['user']->first_name }} {{ $updater['user']->last_name }} 
                                      , At {{ \Carbon\Carbon::parse($updater['updated_at'])->format('Y-m-d H:i:s') }}
                                    <br>
                              @endforeach
                              </td>
                              <td>
                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn-success"><i class="uil uil-edit"></i></a>
                
                <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display:inline-block;">
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
                    </div>{{ $categories->links('layouts.custom-pagination') }}
                  </div>   
@endsection