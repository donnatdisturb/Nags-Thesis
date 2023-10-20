@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/24.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <div class="container">
        <div class="container">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-12">
                        <div class="card-body row no-gutters align-items-center">
                            <div class="col-auto">

                            </div>
                            <div class="col">
                                <form method="GET" action="{{ route('dashboard.filter') }}" enctype="multipart/form-data">
                                    <select name="year" class="custom-select">
                                        <p> Select Academic Year:</p>
                                        <option selected value="">Choose A.Y here:</option>
                                        @foreach ($timestamp as $years)
                                            <option value="{{ $years->year }}">{{ $years->year }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-auto">
                                <br>
                                <br>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                    </form>

                </div>

            </div>

            <div class="container"
                style="background-color: white; border: 12px solid #c5675b; border-radius: 10px; margin-top: 15px; margin-bottom: 15px;">
                {!! $studentViolation->container() !!}
            </div>
            {!! $studentViolation->script() !!}
        </div>

        <div class="container">
            <div class="guidance-profile py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent border-0">
                                    <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Chart Data:</h3>
                                </div>
                                <div class="card-body pt-0">
                                    @foreach ($data as $datas)
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="30%">Month of {{ $datas->month }} </th>
                                                <td width="2%">:</td>
                                                <td> a total record of <b> {{ $datas->count }}</td>
                                            </tr>

                                            <tr>
                                        </table>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent border-0">
                                    <h3 class="mb-0"><i class="far fa-clone pr-1"></i>HERE ARE THE LIST OF YOUR VIOLATIONS
                                    </h3>
                                </div>
                                <div class="card-body pt-0">
                                    @foreach ($data3 as $data3s)
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="30%"> Violation Record {{ $data3s->date_recorded }}</th>
                                                <td width="2%"> :</td>
                                                <td>you have committed <b>{{ $data3s->violations->name }}</b>
                                                    which falls under the category of
                                                    <b>{{ $data3s->violations->category }}</b>. Remarks:
                                                    <b>{{ $data3s->remarks }}</b>
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

        </body>
    @endsection
