@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/26.png') }}" width="1090px" style="padding:5px; margin:0px" />
    <div class="guidance-profile py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-transparent text-center">
                            @foreach ($guidanceinfo->chunk(4) as $guidance)
                                @foreach ($guidance as $userdisplay)
                                    <img src="{{ asset('storage/images/' . $userdisplay->guidance_img) }}"
                                        style="width: 200px; height: 250px" />
                                    <h3 style="font-weight: 1000; text-transform: uppercase;">{{ $userdisplay->fname }}
                                        {{ $userdisplay->lname }}</h3>
                        </div>
                        <div class="card-body" style="text-align:center;">
                            <p class="mb-0"><strong class="pr-1">Guidance ID:</strong>{{ $userdisplay->id }}</p>
                            <br>
                            <p><a href="{{ route('guidance.editprofile', $userdisplay->id) }}" class="btn btn-warning">Edit
                                    Profile</a>
                                <a href="{{ route('password.update', $userdisplay->id) }}" class="btn btn-info">Update
                                    Password</a>
                            </p>


                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-transparent border-0">
                            <h3 class="mb-0"><i class="fas fa-address-card pr-1"></i>GUIDANCE'S INFORMATION</h3>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Last Name:</th>
                                    <td width="2%">:</td>
                                    <td>{{ $userdisplay->lname }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">First Name:</th>
                                    <td width="2%">:</td>
                                    <td>{{ $userdisplay->fname }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">Email</th>
                                    <td width="2%">:</td>
                                    <td>{{ $userdisplay->user->email }}</td>
                                </tr>
                                <tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endforeach
@endsection
