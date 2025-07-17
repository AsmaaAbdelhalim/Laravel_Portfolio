@extends('layouts.admin')
@section('content')
<style>
  .icon-item {
    display: inline-block;
    margin: 10px;
    text-align: center;
    cursor: pointer;
}

.icon-item:hover {
    opacity: 0.7;
}

  </style>
                <div class="title">
                    <i class="uil uil-star"></i>
                    <span class="text">Services</span>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                  <a href="{{ route('admin.service.create')}}" class="btn btn-success btn-sm me-1"><i class="uil uil-plus">Add New</i></a>
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Services Records</h4>
                        {{-- <p class="card-description"></code> --}}
                        </p>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th> # </th>
                              <th> Icon </th>
                              <th> Service Name </th>
                              <th> Description </th>
                              <th> Manage </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($services as $service)
                            <tr>
                              <td> {{ $service -> id }} </td>
                              <td> <i class="{{$service -> icon}}" ></i>
                              <span class="iconify" data-icon="{{ $service->icon }}" data-inline="false" style="font-size: 24px;"></span>

                            </td>
                              {{-- <td> <i class="fab {{ $service -> icon }}"  aria-hidden="true"></i></td> --}}
                              <td> {{ $service -> name }} </td>
                              <td> 
                                <p class="text-wrap">
                                  {{ $service -> description }}
                                </p>
                                {{-- {{ substr($service -> description,0,30) }}  ... --}}
                                </td>
                                <td>
                <a href="{{ route('admin.service.edit', $service->id) }}" class="btn-success"><i class="uil uil-edit"></i></a>
                
                <form action="{{ route('admin.service.destroy', $service->id) }}" method="POST" style="display:inline-block;">
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
                    </div>{{ $services->links('layouts.custom-pagination') }}
                  </div>
@endsection