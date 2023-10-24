@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/22.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <div class="container">

        <ul class="errors">
            @foreach ($errors->all() as $message)
                <li>
                    <p>{{ $message }}</p>
                </li>
            @endforeach
        </ul>

        <form method="post" action="{{ route('counsel.store') }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
           
           
            <!-- Other form fields here -->
        
            <div class="form-group">
                <label for="description" class="control-label">Student Name:</label>
                <input type="text" class="form-control" id="student_name" name="student_name"
                    value="{{ $students->fname }} {{ $students->lname }}"readonly="readonly">
                @if ($errors->has('student_name'))
                    <small>{{ $errors->first('student_name') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="description" class="control-label">Schedule Date:</label>
                <input type="date" class="form-control" id="scheduled_date" name="scheduled_date">
                @if ($errors->has('scheduled_date'))
                    <small>{{ $errors->first('scheduled_date') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="description" class="control-label">Start Time:</label>
                <input type="time" class="form-control" id="start_time" name="start_time">
                @if ($errors->has('start_time'))
                    <small>{{ $errors->first('start_time') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="end_time" class="control-label">End Time:</label>
                <input type="time" class="form-control" id="end_time" name="end_time">
                @if ($errors->has('end_time'))
                    <small>{{ $errors->first('end_time') }}</small>
                @endif
            </div>




            <button type="submit" class="btn btn-primary">Save</button>

            <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
    </div>
    </div>
    <br>
    </form>
    
@endsection
