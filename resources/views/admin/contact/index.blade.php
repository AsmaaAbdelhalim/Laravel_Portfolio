@extends('layouts.admin')
@section('content')

<div class="title">
    <i class="uil uil-star"></i>
    <span class="text">Contacts</span>
</div>
<div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Contacts Records</h4>
                        {{-- <p class="card-description"></code> --}}
                        </p>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th> # </th>
                              <th> Name </th>
                              <th> Email </th>
                              <th> Phone </th>
                              <th> Subject </th>
                              <th> Message </th>
                              <th> Time </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{$contact->name}}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact-> message}}</td>
                                <td>{{ $contact->created_at }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>    {{ $contacts->links('layouts.custom-pagination') }}
                </div>
@endsection