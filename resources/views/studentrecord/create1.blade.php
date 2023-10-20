@extends('layouts.app')
@section('content')
    <style>
        textarea {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            background-color: white;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    </style>

    <div class="container">
        <h2>Report a Violation:</h2>
        <form method="POST" action="{{ route('studentviolationreport.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="date_recorded" class="control-label">Date:</label>
                <input type="date" class="form-control" id="date_recorded" name="date_recorded" required="true">
                @if ($errors->has('date_recorded'))
                    <small>{{ $errors->first('date_recorded') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="remarks" class="control-label">Detailed Report:</label>
                <textarea id="remarks" name="remarks" rows="4" cols="121" value="{{ old('content') }}"></textarea>
                @if ($errors->has('remarks'))
                    <small>{{ $errors->first('remarks') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="student_id">Violator: </label>
                {!! Form::select('student_id', $students, null, [
                    'class' => '
                                                                                                                                                                                                                                                                                                                    form-control',
                ]) !!}
            </div>
            <div class="form-group">
                <label for="violation_id">Violation Committed</label>
                {!! Form::select('violation_id', $violations, null, [
                    'class' => '
                                                                                                                                                                                                                                                                                                                    form-control',
                ]) !!}
            </div>


            <div class="form-group ">
                <label for="image" class="control-label">Upload evidence if you have any:</label>
                <input type="file" class="form-control" id="video" name="video">
            </div>



            <div class="form-group">
                <label for="guidance_id">Report to: </label>
                {!! Form::select('guidance_id', $guidances, null, [
                    'class' => '
                                                                                                                                                                                                                                                                                                                    form-control',
                ]) !!}
            </div>

            <button type="submit" class="btn btn-primary">Report</button>
            <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
        </form>
    </div>
@endsection
