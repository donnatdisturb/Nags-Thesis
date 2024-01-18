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
        <img src="{{ asset('images/8.png') }}" alt="Flexible Image">
    </div>

    {{-- <img src="{{ asset('images/8.png') }}" width="1090px" style="padding:5px; margin:0px" /> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-12">
                <div class="card-body row no-gutters align-items-center">
                    <div class="col-auto">

                    </div>
                    <div class="col">
                        <form method="GET" action="{{ route('dashboard.filter2') }}" enctype="multipart/form-data">
                            <select name="year" class="custom-select">
                                <p> Select Academic Year:</p>
                                <option selected value="">Choose A.Y here:</option>
                                @foreach ($timestamp as $years)
                                    <option value="{{ $years->year }}">{{ $years->year }}</option>
                                @endforeach
                            </select>

                    </div>
                    <div class="col-auto">
                        <br><br>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="container">
        @if (empty($TopViolator))
            <div id="app2"></div>
        @else
            <div class="container"
                style="background-color: white; border: 12px solid #c5675b; border-radius: 10px; margin-top: 15px; margin-bottom: 15px;">
                {!! $TopViolator->container() !!}
            </div>
            {!! $TopViolator->script() !!}
        @endif
    </div>

    <div class="column">
        <div class="container">
            <div class="guidance-profile py-4">
                <div class="container">
                    <div class="row">
                        {{-- <div class="col-lg-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent border-0">
                                    <h3 class="mb-0"><i class="far fa-clone pr-1"></i>VIOLATOR:</h3>
                                </div>
                                <div class="card-body pt-0">
                                    @foreach ($student as $students)
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="30%"> Top Violator</th>
                                                <td width="2%"> :</td>
                                                <td>The student with the most record is <b>{{ $students->fname }}
                                                        {{ $students->lname }}</b> with {{ $students->total }} records</td>
                                            </tr>

                                            <tr>
                                        </table>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div> --}}


                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-transparent border-0">
                                            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Chart Data:</h3>
                                        </div>
                                        <div class="card-body pt-0">
                                            @foreach ($data as $violators)
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="30%">Violator Name: <b> {{ $violators->fname }}
                                                                {{ $violators->lname }} </th>
                                                        <td width="2%">:</td>
                                                        <td> </b> with a total record of <b>{{ $violators->total }}
                                                                violations</b></td>
                                                    </tr>

                                                    <tr>
                                                </table>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr
                    style="position: relative; top: 20px; border: none; height: 10px; background: #2c1616; margin-bottom: 50px;">
                <img src="{{ asset('images/9.png') }}" width="1090px" style="padding:5px; margin:0px" />
                <div class="container">
                    <div class="container">
                        @if (empty($violationrecord))
                            <div id="app2"></div>
                        @else
                            <div class="container"
                                style="background-color: white; border: 12px solid #c5675b; border-radius: 10px; margin-top: 15px; margin-bottom: 15px;">
                                {!! $violationrecord->container() !!}
                            </div>
                            {!! $violationrecord->script() !!}
                        @endif
                    </div>

                    <div class="container">
                        <div class="container">
                            <div class="guidance-profile py-4">
                                <div class="container">
                                    <div class="row">
                                        {{-- <div class="col-lg-12">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-transparent border-0">
                                                <h3 class="mb-0"><i class="far fa-clone pr-1"></i>VIOLATOR:</h3>
                                            </div>
                                            <div class="card-body pt-0">
                                                @foreach ($topcategory as $category)
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th width="30%">The violations most commited by the students
                                                                is<b> {{ $category->name }} </b> </th>
                                                            <td width="2%"> :</td>
                                                            <td>with <b>{{ $category->count }}</b> records</td>
                                                        </tr>

                                                        <tr>
                                                    </table>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div> --}}
                                        <div class="col-lg-12">
                                            <div class="card shadow-sm">
                                                <div class="card-header bg-transparent border-0">
                                                    <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Chart Data:</h3>
                                                </div>
                                                <div class="card-body pt-0">
                                                    @foreach ($dataV as $category)
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th width="30%">Violation <b> {{ $category->name }} </th>
                                                                <td width="2%">:</td>
                                                                <td> </b> with a total record of <b>
                                                                        {{ $category->total }}</b>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                        </table>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        </body>
                    @endsection
