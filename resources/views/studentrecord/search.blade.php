@extends('layouts.app')
@section('content')
    <div class="container">


        {{-- <h2>Student Records</h2> --}}
        {{-- <button onclick=location ="{{ route('studsearch') }}">Refresh</button>
   <form action="{{ route('studsearch') }}" method="GET">
	<br>
    <input type="text" name="search" required/>
    <button type="submit">Search</button>

</form> --}}
        <img src="{{ asset('images/3.png') }}" width="1090px" style="padding:5px; margin:0px" />
        @if ($studsearch->isNotEmpty())
            <br>
            <h3 style="font-weight: 1000; text-transform: uppercase; text-align: center;">{{ request('search') }}'S VIOLATION
                RECORDS</h3>
            {{-- <h2>{{request('search')}}</h2> --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr><a href="{{ route('studentrecordindex') }}" class="btn btn-success a-btn-slide-text">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            <span><i class="fa fa-refresh"></i><strong> BACK</strong></span>
                        </a></tr>
                    <thead>
                        <tr>
                            <th>Student Record ID</th>
                            <th>Student ID</th>
                            <!-- <th>Student Name</th> -->

                            <th>Date Recorded</th>
                            <th>Remarks</th>
                            <th>Violation</th>
                            <th>Punishment</th>
                            <th>Assigned Guidance</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studsearch as $ssearch)
                            <tr>
                                <td>{{ $ssearch->id }}</td>
                                <td>{{ $ssearch->id }}</td>

                                <!-- <td>{{ $ssearch->fname }}</td> -->
                                <td>{{ $ssearch->date_recorded }}</td>
                                <td>{{ $ssearch->remarks }}</td>
                                <td>{{ $ssearch->name }}</td>
                                <td>{{ $ssearch->name }}</td>
                                <td>{{ $ssearch->fname }}</td>
                        @endforeach
                </table>
            </div>
        @else
            <div>
                <h2>Not found</h2>
            </div>
        @endif
    @endsection
