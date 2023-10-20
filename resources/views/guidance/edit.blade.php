@extends('layouts.app')
@section('content')
    <br>
    <h2 style="text-align: center; font-weight: 1000">EDIT GUIDANCE</h2>
    <hr style="position: relative; top: 20px; border: none; height: 10px; background: #2c1616; margin: 10px;">
    <div class="container">
        {{ Form::model($guidances, ['route' => ['guidance.update', $guidances->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="image" class="control-label">Customer Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="{{ asset('storage/images/' . $guidances->guidance_img) }}" style="width: 150px;height: 150px" />
                @if ($errors->has('image'))
                    <small>{{ $errors->first('image') }}</small>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="fname">First Name:</label>
                {!! Form::text('fname', $guidances->fname, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="lname">Last Name:</label>
                {!! Form::text('lname', $guidances->lname, ['class' => 'form-control']) !!}
            </div>
        </div>



        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-top:60px">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    </div>
@endsection
