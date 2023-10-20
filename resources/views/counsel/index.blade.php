@extends('layouts.app')
@section('content')


    <br>
    <img src="{{ asset('images/19.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <div class="container">
        <div id="calendar"></div>
        <br />
        @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div><br />
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID No.</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Student Name</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($counsel as $counsils)
                    <tr>
                        <td>{{ $counsils->id }}</td>
                        <td>{{ $counsils->scheduled_date }}</td>
                        <td>{{ $counsils->start_time }}</td>
                        <td>{{ $counsils->end_time }}</td>
                        <td>{{ $counsils->student->fname }} {{ $counsils->student->lname }}</td>
                        <td>{{ $counsils->Status }}</td>

                        <td> <a href="{{ route('counsel.edit', $counsils->id) }}">
                                <i class="fas fa-clipboard" aria-hidden="true" style="font-size:24px"></i>Update</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>

        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '8:00:00',
                    slotMaxTime: '19:00:00',
                    events: @json($events),
                });
                calendar.render();
            });
        </script>
        
        @endpush

     
    @endsection
