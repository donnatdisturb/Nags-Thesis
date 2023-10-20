@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('/images/30.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <br>
    <div class="container">
        <form method="POST" action="{{ route('studentrecord.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="date_recorded" class="control-label">Date Recorded</label>
                <input type="date" class="form-control" id="date_recorded" name="date_recorded" required="true">
                @if ($errors->has('date_recorded'))
                    <small>{{ $errors->first('date_recorded') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="remarks" class="control-label">Remarks</label>
                <input type="text" class="form-control" id="remarks" name="remarks" required="true">
                @if ($errors->has('remarks'))
                    <small>{{ $errors->first('remarks') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="student_id">Student </label>
                {!! Form::select('student_id', $students, null, [
                    'class' => '
                                                                                                                                                                                                                                                                                                                                    form-control',
                ]) !!}
            </div>
            <div class="form-group">
                <label for="violation_id">Violation </label>
                {!! Form::select('violation_id', $violations, null, [
                    'class' => '
                                                                                                                                                                                                                                                                                                                                    form-control',
                ]) !!}
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
        </form>
    </div>
@endsection
