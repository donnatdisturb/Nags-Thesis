@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/16.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <div class="container">

        {{ Form::model($students, ['route' => ['student.update', $students->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
        <div class="form-group">
            <label for="image" class="control-label">Student Image</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ asset('storage/images/' . $students->student_img) }}" style="width: 150px;height: 150px" />
            @if ($errors->has('image'))
                <small>{{ $errors->first('image') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="fname">First Name:</label>
            {!! Form::text('fname', $students->fname, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="lname">Last Name:</label>
            {!! Form::text('lname', $students->lname, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="section_id">Section </label>
            {!! Form::select('section_id', $sections, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="course_id">Course </label>
            {!! Form::select('course_id', $courses, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
        </div>
        <br>


        {!! Form::close() !!}
    </div>
@endsection
