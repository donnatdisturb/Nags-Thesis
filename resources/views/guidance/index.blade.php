@extends('layouts.app')
@section('content')
    
    <style>
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
        <img src="{{ asset('images/13.png') }}" alt="Flexible Image">
    </div> 
    {{-- <img src="{{ asset('images/13.png') }}" width="1090px" style="padding:5px; margin:0px" /> --}}
    <div class="container">
        <br />
        @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div><br />
        @endif

        <div class="container">

            <div class="col-xs-6">
                <form method="post" enctype="multipart/form-data" action="{{ route('guidanceImport') }}">
                    @csrf
                    <input type="file" id="uploadName" name="guidance_upload" required>

            </div>

            @error('guidance_upload')
                <small>{{ $message }}</small>
            @enderror
            <button type="submit" class="btn btn-info btn-primary ">Import Excel File</button>
            </form>

        </div>

        <table class="table table-striped">
            <br>
            <tr><a href="{{ route('guidance.create') }}" class="btn btn-primary a-btn-slide-text">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    <span><i class="fa fa-plus"></i><strong> ADD NEW GUIDANCE: </strong></span>
                </a><br>
            </tr>
            <thead>
                <tr>
                    <th>Guidance ID</th>
                    <th>Guidance Image</th>
                    <th>Guidance First Name</th>
                    <th>Guidance Last Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guidances as $guidance)
                    <tr>
                        <td>{{ $guidance->id }}</td>
                        <td><img src="{{ asset('public/images/' . $guidance->guidance_img) }}"
                                style="width: 150px;height: 150px" /></td>
                        <td>{{ $guidance->fname }}</td>
                        <td>{{ $guidance->lname }}</td>
                        <td>
                        <td>
                        </td>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $guidances->links() !!}

    </div>
@endsection
