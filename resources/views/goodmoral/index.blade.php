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
        <img src="{{ asset('images/3.png') }}" alt="Flexible Image">
    </div>
    {{-- <img src="{{ asset('images/3.png') }}" width="1269px" style="padding:5px; margin:0px" /> --}}
    <link href="{{ URL::asset('css/searchstyle.css') }}" rel="stylesheet">

    <div class="container">
        <br>

        @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div><br />
        @endif

        <div style="margin-bottom: 10px;">
            <a href="{{ route('goodmoralindex') }}" class="btn btn-success a-btn-slide-text">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <span><i class="fa fa-refresh"></i><strong> REFRESH</strong></span>
            </a>

            {{-- @if (!auth()->user()->isGuidance()) --}}
                @php
                    $userRequestCount = App\Models\GoodMoral::where('student_id', auth()->user()->id)->count();
                @endphp

                @if ($userRequestCount === 0) 
                    <a href="{{ route('goodmoralstore') }}" class="btn btn-primary a-btn-slide-text">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        <span><i class="fa fa-plus"></i><strong> Request Good Moral</strong></span>
                    </a>
                @endif
            {{-- @endif --}}
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Request ID</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Claiming Schedule</th>
                    @if (auth()->user()->isGuidance())
                        <th>Update</th>
                        <th>Delete</th>
                        <th>Schedule</th> 
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($goodmorals as $goodmoral)
                    <tr>
                        <td>{{ $goodmoral->student_id }}</td>
                        <td>
                            @if($goodmoral->student) 
                                {{ $goodmoral->student->fname }} 
                            @else
                                N/A 
                            @endif
                        </td>
                        <td>{{ $goodmoral->id }}</td>
                        <td>{{ $goodmoral->description }}</td>
                        <td>{{ $goodmoral->status }}</td>
                        <td>{{ $goodmoral->schedule_date }}</td>

                        @if (auth()->user()->isGuidance())
                            <td>
                                @if ($goodmoral->status === 'pending')
                                    <form action="{{ route('goodmoralupdate', ['id' => $goodmoral->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status">
                                            <option value="pending" {{ $goodmoral->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="done" {{ $goodmoral->status === 'done' ? 'selected' : '' }}>Done</option>
                                            <option value="denied" {{ $goodmoral->status === 'denied' ? 'selected' : '' }}>Denied</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                @if ($goodmoral->status === 'pending' || $goodmoral->status === 'denied' || $goodmoral->status === 'done')
                                    <form action="{{ route('goodmoraldelete', ['id' => $goodmoral->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('goodmoralschedule', ['id' => $goodmoral->id]) }}" method="POST">
                                    @csrf
                                    <label for="schedule_date">Choose schedule date:</label>
                                    <input type="date" id="schedule_date" name="schedule_date">
                                    <button type="submit" class="btn btn-primary">Set Schedule Date</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
