@extends('layouts.post')
@section('content')
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <h1 style="text-align: center; font-weight: 1000">ANNOUNCEMENTS</h1>
    @foreach ($announcements->chunk(3) as $announcementsChunk)
        <div class="row" style="padding: 30px;">
            @foreach ($announcementsChunk as $announcement)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ asset('/storage/images/' . $announcement->announcement_img) }}" class="img-responsive">
                        <div class="caption" style="text-align: center;">
                            <h3 style="font-weight: 1000; text-transform: uppercase;">
                                <span>{{ $announcement->title }}</span>
                            </h3>
                            <hr>
                            <h4><span>{{ $announcement->content }}</span></h4>
                            <p class="m-0">Posted last:
                                {{ \Carbon\Carbon::createFromTimestamp(strtotime($announcement->created_at))->format('F d, Y |H:i:s') }}

                            <div class="clearfix">

                                <a href="{{ route('announcements.show', ['id' => $announcement->id]) }}"
                                    class="btn btn-primary pull-right" role="button"><i class="fas fa-info"></i> Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
