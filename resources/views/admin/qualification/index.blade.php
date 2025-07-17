@extends('layouts.admin')

@section('content')

                <div class="title">
                    <i class="uil uil-star"></i>
                    <span class="text">Qualifications</span>
                </div>

                <div class="col-lg-12 grid-margin stretch-card">
                  <a href="{{ route('admin.qualification.create')}}" class="btn btn-success btn-sm me-1"><i class="uil uil-plus">Add New</i></a>
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Qualifications Records</h4>
                        {{-- <p class="card-description"></code> --}}
                        </p>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th> # </th>
                              <th> Title </th>
                              <th> Aassociation </th>
                              <th> Type </th>
                              <th> From / To </th>
                              <th> Manage </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($qualifications as $qualification)
                            <tr>
                              <td> {{ $qualification -> id }} </td>
                              <td> {{ $qualification -> title }} </td>
                              <td> {{ $qualification -> association }} </td>
                              <td> {{ $qualification -> type }}</td>
                              <td> {{ $qualification -> from }} - {{ $qualification -> to }} </td>
                              <td>
                <a href="{{ route('admin.qualification.edit', $qualification->id) }}" class="btn-success"><i class="uil uil-edit"></i></a>
                
                <form action="{{ route('admin.qualification.destroy', $qualification->id) }}" method="POST" style="display:inline-block;">
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
                    </div>{{ $qualifications->links('layouts.custom-pagination') }}
                  </div>
@endsection