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
                              <th> Action </th>
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
                                <td>
    <form action="" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-primary">Reply</button>
    </form>
    @if (!$contact->reply)
    <form action="" method="POST">
        @csrf
        <textarea name="reply" rows="5" class="form-control" required></textarea>
        <button class="btn btn-primary mt-2">Send Reply</button>
    </form>
@else
    <p><strong>Reply Sent:</strong> {{ $contact->reply }}</p>
@endif

</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>    {{ $contacts->links('layouts.custom-pagination') }}
                </div>
@endsection