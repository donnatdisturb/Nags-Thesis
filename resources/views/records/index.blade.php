@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/18.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <br>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records->chunk(4) as $students)
                        @foreach ($students as $recorddisplay)
                            <tr>
                                <td>{{ $recorddisplay->id }}</td>
                                <td>{{ $recorddisplay->fname }}</td>
                                <td>{{ $recorddisplay->lname }}</td>
                                <td>
                                    <a href="{{ route('profilerecord', $recorddisplay->id) }}">
                                        <i class="fas fa-edit" aria-hidden="true" style="font-size:24px"></i>View Record
                                        Profile</a>
                                </td>


                            </tr>

                </tbody>
                @endforeach
                @endforeach
            </table>

        </div>
    </div>
    </div>
@endsection
