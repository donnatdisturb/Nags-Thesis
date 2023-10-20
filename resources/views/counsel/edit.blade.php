@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/20.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <br>
    <div class="container">

        <ul class="errors">
            @foreach ($errors->all() as $message)
                <li>
                    <p>{{ $message }}</p>
                </li>
            @endforeach
        </ul>



        @csrf
        @method('PUT')

        <form method="POST" action="{{ route('counsel.update', $counsels->id) }}" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="description" class="control-label">ID No.</label>
                <input type="text" class="form-control" id="counsel_id" name="counsel_id" value="{{ $counsels->id }}"
                    readonly>
                @if ($errors->has('counsel_id'))
                    <small>{{ $errors->first('counsel_id') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="description" class="control-label">Student ID:</label>
                <input type="text" class="form-control" id="student_id" name="student_id"
                    value="{{ $counsels->student->id }}" readonly="readonly">
                @if ($errors->has('student_id'))
                    <small>{{ $errors->first('student_id') }}</small>
                @endif
            </div>


            <div class="form-group">
                <label for="description" class="control-label">Student Name:</label>
                <input type="text" class="form-control" id="student_name" name="student_name"
                    value="{{ $counsels->student->fname }} {{ $counsels->student->lname }}" readonly="readonly">
                @if ($errors->has('counsel_id'))
                    <small>{{ $errors->first('counsel_id') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="description" class="control-label">Schedule Date:</label>
                <input type="date" class="form-control" id="scheduled_date" name="scheduled_date"
                    value="{{ old('scheduled_date', $counsels->scheduled_date) }}">
                @if ($errors->has('scheduled_date'))
                    <small>{{ $errors->first('scheduled_date') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="description" class="control-label">Start Time:</label>
                <input type="time" class="form-control" id="start_time" name="start_time"
                    value="{{ old('start_time', $counsels->start_time) }}">
                @if ($errors->has('start_time'))
                    <small>{{ $errors->first('start_time') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="description" class="control-label">End Time:</label>
                <input type="time" class="form-control" id="end_time" name="end_time"
                    value="{{ old('end_time', $counsels->end_time) }}">
                @if ($errors->has('start_time'))
                    <small>{{ $errors->first('start_time') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="description" class="control-label">Status</label>
                <select class="form-control" name="Status" value="{{ old('Status', $counsels->Status) }}">
                    {{-- <option selected>Status...</option> --}}
                    <option value="PENDING">PENDING</option>
                    <option value="ATTENDED">ATTENDED</option>
                    <option value="DID NOT ATTEND">DID NOT ATTEND</option>
                </select>
                @if ($errors->has('status'))
                    <small>{{ $errors->first('status') }}</small>
                @endif
            </div>




            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
    </div>
    </div>
    <br>
    </form>
@endsection
