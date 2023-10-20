@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/15.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <div class="container">
        <br />
        @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div><br />
        @endif

        <div class="container">

            <div class="col-xs-6">
                <h6>Import List of Students</h6>
                <form method="post" enctype="multipart/form-data" action="{{ route('studentImport') }}">
                    @csrf
                    <input type="file" id="uploadName" name="student_upload" required>
            </div>

            @error('student_upload')
                <small>{{ $message }}</small>
            @enderror
            <button type="submit" class="btn btn-info btn-primary ">Import Excel File</button>
            </form>
        </div>
        <BR>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Profile</th>
                    <th>fname</th>
                    <th>lname</th>
                    <th>Section ID</th>
                    <th>Course ID</th>
                    <th colspan="2">Action</th>

                </tr>
            </thead>
            <tbody>


                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td><img src="{{ asset('storage/images/' . $student->student_img) }}"
                                style="width: 150px;height: 150px" /></td>
                        <td>{{ $student->fname }}</td>
                        <td>{{ $student->lname }}</td>
                        <td>{{ $student->section->sectionname }}</td>
                        <td>{{ $student->course->coursename }}</td>
                        <td><a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning">Edit</a></td>
                    </tr>
                @endforeach


            </tbody>
        </table>
        {!! $students->links() !!}

    </div>
@endsection
