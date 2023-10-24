@extends('layouts.post')
@section('content')
    <br>

    <img src="{{ asset('images/StudentHandbook.png') }}"
    style=" width: 1285px; display: block;margin-left: auto;margin-right: auto;" />
    
    <div class="container p-3 my-3 border">
        <iframe src="{{ asset('file/TUP-Student-Handbook.pdf') }}" width="100%" height="500px"></iframe>
    </div>
@endsection
