@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/14.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <br>
    <div class="container">
        <form method="POST" action="{{ route('guidance.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="image" class="control-label">Guidance Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fname" class="control-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" required="true">
                @if ($errors->has('fname'))
                    <small>{{ $errors->first('fname') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="lname" class="control-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" required="true">
                @if ($errors->has('lname'))
                    <small>{{ $errors->first('lname') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="email" class="control-label">Email:</label>
                <input type="text" class="form-control" id="email" name="email" required="true">
                @if ($errors->has('email'))
                    <small>{{ $errors->first('email') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="password" class="control-label">Password:</label>
                <input type="text" class="form-control" id="password" name="password" required="true">
                @if ($errors->has('password'))
                    <small>{{ $errors->first('password') }}</small>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
        </form>
    </div>
    <br>
@endsection
