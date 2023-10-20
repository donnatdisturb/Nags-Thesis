@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/10.png') }}" width="1269px"style="padding:5px; margin:0px" />

    <div class="container">
        <br />
        @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div><br />
        @endif

        <div class="container">
            <table class="table table-striped">
                <tr><a href="{{ route('announcement.create') }}" class="btn btn-primary a-btn-slide-text">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        <span><i class="fa fa-plus"></i><strong> ADD NEW ANNOUNCEMENT</strong></span>
                    </a><br>
                </tr>
                <thead>
                    <tr>
                        <th>Announcement ID</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Posted By</th>
                        <th>Publication Material</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($announcements as $announcement)
                        <tr>
                            <td>{{ $announcement->id }}</td>
                            <td>{{ $announcement->title }}</td>
                            <td>{{ $announcement->content }}</td>
                            <td>{{ $announcement->lname . ', ' . $announcement->fname }}</td>
                            <td><img src="{{ asset('/storage/images/' . $announcement->announcement_img) }}"
                                    style="width: 150px;height: 150px" /></td>
                            <td><a href="{{ route('announcements.edit', $announcement->id) }}"
                                    class="btn btn-warning">Edit</a></td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            {!! $announcements->links() !!}

        </div>
    @endsection
