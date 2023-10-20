@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Create New Student Violation Record</h2>
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
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="student_id">Student </label>
                    {!! Form::select('student_id', $students, null, [
                        'class' => '
                                                                                                                                                                                        form-control',
                    ]) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="violation_id">Violation </label>
                    {!! Form::select('violation_id', $violations, null, [
                        'class' => '
                                                                                                                                                                                        form-control',
                    ]) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="guidance_id">Guidance </label>
                    {!! Form::select('guidance_id', $guidances, null, [
                        'class' => '
                                                                                                                                                                                        form-control',
                    ]) !!}
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
        </form>
    </div>
@endsection
