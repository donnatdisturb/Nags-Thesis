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
        <img src="{{ asset('images/11.png') }}" alt="Flexible Image">
    </div> 

    <div class="container">
        <form method="POST" action="{{ route('announcement.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title" class="control-label">Headline</label>
                <input type="text" class="form-control" id="title" name="title" required="true">
                @if ($errors->has('title'))
                    <small>{{ $errors->first('title') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="content" class="control-label">Content:</label>
                <textarea id="content" name="content" rows="4" cols="121" value="{{ old('content') }}"></textarea>
                @if ($errors->has('content'))
                    <small>{{ $errors->first('content') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="image" class="control-label">Public Material</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
        </form>
    </div>
@endsection
