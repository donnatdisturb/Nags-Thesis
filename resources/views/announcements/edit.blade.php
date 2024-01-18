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
        <img src="{{ asset('images/21.png') }}" alt="Flexible Image">
    </div> 

    <BR>
    <div class="container">
        {{ Form::model($announcements, ['route' => ['announcement.update', $announcements->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}

        <div class="form-group">
            <label for="title" class="control-label">Headline</label>
            {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title']) }}
            @if ($errors->has('title'))
                <small>{{ $errors->first('title') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="postedby" class="control-label">Posted By: </label>
            {!! Form::select('postedby', $guidances, $announcements->postedby, ['class' => 'form-control form-select']) !!}
        </div>

        <div class="form-group">
            <label for="content" class="control-label">Contents</label>
            {{ Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content']) }}
            @if ($errors->has('content'))
                <small>{{ $errors->first('content') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="image" class="control-label">Publication Material</label>
            <br>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ asset('/images/' . $announcements->announcement_img) }}" width=100% alt=banner height=100%>
            @if ($errors->has('image'))
                <small>{{ $errors->first('image') }}</small>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
        </div>
    </div>
    <br>
    {!! Form::close() !!}
    </div>
@endsection
