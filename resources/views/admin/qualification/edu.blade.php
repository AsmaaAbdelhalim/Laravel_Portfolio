@extends('layouts.admin')

@section('content')
                <div class="title">
                    <i class="uil uil-star"></i>
                    <span class="text">Education</span>
                </div>

                <div class="col-lg-12 grid-margin stretch-card">
                  <a href="{{ route('admin.qualification.create')}}" class="btn btn-success btn-sm me-1"><i class="uil uil-plus">Add New</i></a>
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Education Records</h4>
                        {{-- <p class="card-description"></code> --}}
                        </p>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th> # </th>
                              <th> Title </th>
                              <th> Aassociation </th>
                              <th> Description </th>
                              <th> From / To </th>
                              <th> Manage </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($educations as $education)
                            <tr>
                              <td> {{ $education -> id }} </td>
                              <td>{{ $education -> title }} </td>
                              <td> {{ $education -> association }} </td>
                              <td> {{ substr($education -> description,0,20)  }} ...  </td>
                              <td> {{ $education -> from }} - {{ $education -> to }} </td>
                              <td>
                <a href="{{ route('admin.qualification.edit', $education->id) }}" class="btn-success"><i class="uil uil-edit"></i></a>
                
                <form action="{{ route('admin.qualification.destroy', $education->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="uil uil-trash-alt"></i>
                    </button>
                </form>
            </td>
                            </tr>
                            <tr>
                                
                                @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
{{-- 
            </div>
        </div> --}}
@endsection
