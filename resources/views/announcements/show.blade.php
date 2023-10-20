@extends('layouts.post')
@section('content')
    <link href="{{ URL::asset('css/comment.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <br>
    <div class="container">
        <div class="container features">
            <div class="row">
                <img src="{{ asset('/storage/images/' . $announcements->announcement_img) }}"
                    style="display: block;margin-left: auto;margin-right: auto;">
            </div>
        </div>

        <div class="container p-3 my-3 border" style="border: black;">
            <h3 style="font-weight: 1000; text-transform: uppercase; text-align: center;">
                <span>{{ $announcements->title }}</span>
            </h3>
            <p>{{ $announcements->content }}</p>
        </div>

        <hr style="position: relative; top: 20px; border: none; height: 10px; background: #2c1616; margin-bottom: 50px;">
        <div class="container" style="background-color:#2c1616;">
            <img src="{{ asset('images/comment-banner.png') }}" style="padding:0px; margin:0px" width=1092px alt=banner
                height=150px />
            @foreach ($comments as $commentss)
                <div class="comment-thread">
                    <div class="comment" id="comment-1">
                        <div class="comment-heading">

                            <div class="comment-info">
                                <a href="#" class="comment-author">{{ $commentss->name }}
                                    ({{ $commentss->email }})
                                </a>
                                <p class="m-0">
                                    {{ \Carbon\Carbon::createFromTimestamp(strtotime($commentss->created_at))->format('F d, Y |H:i:s') }}
                                </p>
                            </div>
                        </div>
                        <div class="comment-body">
                            <p>{{ $commentss->comment }}</p>
                        </div>
                    </div>
            @endforeach

            <style>
                textarea {
                    display: block;
                    width: 100%;
                    padding: 0.375rem 0.75rem;
                    font-size: 0.9rem;
                    font-weight: 400;
                    line-height: 1.6;
                    color: #212529;
                    background-color: #f8fafc;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    appearance: none;
                    border-radius: 0.25rem;
                    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                }
            </style>


            <form action="{{ route('comment.create') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $announcements->id }}" class="form-control" name="announcement_id" />

                <div class="form-group">
                    <label for="name" class="control-label" style="color: white;">Name</label>
                    <input type="text" class="form-control " id="name" name="name" value="{{ old('name') }}"
                        placeholder="Enter Name">
                    @if ($errors->has('name'))
                        <small>{{ $errors->first('name') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email" class="control-label" style="color: white;">E-mail</label>
                    <input type="text" class="form-control " id="email" name="email" value="{{ old('email') }}"
                        placeholder="Enter Email">
                    @if ($errors->has('email'))
                        <small>{{ $errors->first('email') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="comment" class="control-label" style="color: white;">Comment:</label>
                    <textarea id="comment" name="comment" rows="4" cols="121" value="{{ old('comment') }}"
                        placeholder="Enter Comment"></textarea>
                    @if ($errors->has('comment'))
                        <small>{{ $errors->first('comment') }}</small>
                    @endif
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
                </div>
                <br>
            </form>
        </div>
    </div>
    <br>
@endsection
