@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/27.png') }}" width="1090px" style="padding:5px; margin:0px" />
    <br>
    <div class="container">
        {{ Form::model($guidance, ['route' => ['guidanceprofile.update', $guidance->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}


        <div class="form-group">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="image" class="control-label">Guidance Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="{{ asset('storage/images/' . $guidance->guidance_img) }}" style="width: 150px;height: 150px" />
                @if ($errors->has('image'))
                    <small>{{ $errors->first('image') }}</small>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>

    </div>
    {!! Form::close() !!}
@endsection
