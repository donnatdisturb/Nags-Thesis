{{-- @extends('dashboard') --}}
@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/25.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <div class="student-profile py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-transparent text-center">
                            @foreach ($studentinfo->chunk(4) as $students)
                                @foreach ($students as $userdisplay)
                                    <img src="{{ asset('storage/images/' . $userdisplay->student_img) }}"
                                        style="width: 200px; height: 250px" />
                                    <h3 style="font-weight: 1000; text-transform: uppercase;">{{ $userdisplay->fname }}
                                        {{ $userdisplay->lname }}</h3>
                        </div>
                        <div class="card-body" style="text-align:center;">
                            <p class="mb-0"><strong class="pr-1">Student ID:</strong>{{ $userdisplay->id }}</p>
                            <p class="mb-0"><strong class="pr-1">Course ID:</strong>{{ $userdisplay->course_id }}</p>
                            <p class="mb-0"><strong class="pr-1">Section ID:</strong>{{ $userdisplay->course_id }}</p>
                            <br>
                            {{-- <button style="font-size:13px">Edit <i class="fa fa-edit"></i></button> --}}
                            <p><a href="{{ route('editprofile', $userdisplay->id) }}" class="btn btn-warning">Edit
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
                            <h3 class="mb-0"><i class="fas fa-address-card pr-1"></i>GENERAL INFORMATION</h3>
                        </div>
                        <div class="card-body pt-0"">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Section Name</th>
                                    <td width="2%">:</td>
                                    <td>{{ $userdisplay->section->sectionname }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">Course Name</th>
                                    <td width="2%">:</td>
                                    <td>{{ $userdisplay->course->coursename }}</td>
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
                    <div class="card shadow-sm">
                        <div class="card-header bg-transparent border-0">
                            <h3 class="mb-0"><i class="fas fa-user-friends pr-1"></i>FAMILY INFORMATION</h3>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Guardian Name</th>
                                    <td width="2%">:</td>
                                    <td>{{ $userdisplay->studentfamily->fname }}{{ $userdisplay->studentfamily->lname }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%">Contact Number</th>
                                    <td width="2%">:</td>
                                    <td>{{ $userdisplay->studentfamily->phone }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">Address:</th>
                                    <td width="2%">:</td>
                                    <td>{{ $userdisplay->studentfamily->address }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">Email:</th>
                                    <td width="2%">:</td>
                                    <td>{{ $userdisplay->studentfamily->email }}</td>
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
