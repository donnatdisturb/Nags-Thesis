{{-- @extends('dashboard') --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h2>UPDATE PASSWORD:</h2>
    {{ Form::model($student,['route' => ['password.update',$student->id],'method'=>'PUT','enctype' =>'multipart/form-data']) }}

  <div class="form-group">
    <div class="form-group">
        <label for="remarks" class="control-label">Enter Old Password:</label>
        <input type="password" class="form-control" id="oldpassword" name="oldpassword" required = "true">
          @if($errors->has('oldpassword'))
          <small>{{ $errors->first('oldpassword') }}</small>
        @endif
      </div> 
      <div class="form-group">
        <label for="remarks" class="control-label">Enter New Password:</label>
        <input type="password" class="form-control" id="newpassword" name="newpassword" required = "true">
          @if($errors->has('newpassword'))
          <small>{{ $errors->first('newpassword') }}</small>
        @endif
      </div> 

</div>
{{-- <button type="submit" class="btn btn-primary">Update</button> --}}
<a href="{{ route ('password.update', $student->id)}}" class="btn btn-warning">Update</a>
{{-- <a href="{{StudentController@edit', $student->id}}" class="btn btn-default" role="button">Update</a> --}}
<a href="{{route('studentprofile')}}" class="btn btn-default" role="button">Cancel</a>

</div>
{!! Form::close() !!} 
@endsection