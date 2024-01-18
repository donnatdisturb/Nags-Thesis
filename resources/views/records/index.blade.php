@extends('layouts.app')
@section('content')
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .image-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 5px;
        }

        .image-container img {
            width: 100%;
            height: auto;
            display: block;
            margin: 0;
        }
    </style>

    {{-- <br> --}}

    <div class="image-container">
        <img src="{{ asset('images/18.png') }}" alt="Flexible Image">
    </div>   
    {{-- <img src="{{ asset('images/18.png') }}" width="1090px" style="padding:5px; margin:0px" />
    <br> --}}
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
