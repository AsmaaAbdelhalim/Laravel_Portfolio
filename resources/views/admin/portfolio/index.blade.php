@extends('layouts.admin')
@section('content')

                <div class="title">
                    <i class="uil uil-star"></i>
                    <span class="text">Portfolios</span>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                  <a href="{{ route('admin.portfolio.create')}}" class="btn btn-success btn-sm me-1"><i class="uil uil-plus">Add New</i></a>
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Portfolios Records</h4>
                        {{-- <p class="card-description"></code> --}}
                        </p>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th> # </th>
                              <th> Name </th>
                              <th> Image </th>
                              <th> Description </th>
                              <th> categories </th>
                              <th> Created By </th>
                              <th> Updated By </th>
                              <th> Manage </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($portfolios as $portfolio)
                            <tr>
                              <td> {{ $portfolio -> id }} </td>
                              <td> {{ $portfolio -> name }} </td>
                              <td>
                                  @if($portfolio->image)
                                      <img src="{{ Storage::url($path . '/' . $portfolio->image) }}" alt="{{ $portfolio->name }}" class="table-image">
                                  @else
                                      <span>No image</span>
                                  @endif
                                  </td>
                                  <td> {{ $portfolio->description }} </td>
                                  <td>
                                    * {{ $portfolio->categories->count() }} Categories
                                    <br>
                                    @foreach($portfolio->categories as $category)
                                      <span class="badge badge-primary">{{ $category->name }}</span><br>
                                    @endforeach
                                  <td> {{ $portfolio->creator ? $portfolio->creator->first_name : 'N/A' }}
                                
                                  , At {{ $portfolio->created_at->format('Y-m-d H:i:s') }}
                                </td>
                                  <td> 
                                    @foreach($portfolio->updaters as $updater)
                                      - {{ $updater['user']->first_name }} {{ $updater['user']->last_name }} 
                                      , At {{ \Carbon\Carbon::parse($updater['updated_at'])->format('Y-m-d H:i:s') }}
                                    <br>
                                    @endforeach
                                  </td>
                                  <td>
                <a href="{{ route('admin.portfolio.edit', $portfolio->id) }}" class="btn-success"><i class="uil uil-edit"></i></a>
                
                <form action="{{ route('admin.portfolio.destroy', $portfolio->id) }}" method="POST" style="display:inline-block;">
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
                    </div>{{ $portfolios->links('layouts.custom-pagination') }}
                  </div>
@endsection