@extends('layouts.app')
@section('content')
    <img src="{{ asset('images/8.png') }}" width="1269px" style="padding:5px; margin:0px" />
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
                <img src="{{ asset('images/9.png') }}" style="padding:5px; margin:0px" />
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
