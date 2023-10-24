<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
<body>
<div class="container">
    <h1>COACHING SCHEDULE</h1>
    <div id='calendar'></div>
</div>

<div class="modal fade" id="coachingModal" tabindex="-1" role="dialog" aria-labelledby="coachingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coachingModalLabel">Coaching Schedule Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="coachingForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="coachingDate">Date</label>
                        <input type="date" class="form-control" id="coachingDate" name="coachingDate" >
                    </div>
                    <div class="form-group">
                        <label for="starttime">Start Time</label>
                        <input type="time" class="form-control" id="starttime" name="starttime">
                    </div>
                    <div class="form-group">
                        <label for="endtime">End Time</label>
                        <input type="time" class="form-control" id="endtime" name="endtime">
                    </div>
                    <div class="form-group">
                        <label for="student">Student:</label>
                        <select class="form-control" id="student" name="student">
                            <option value="" disabled selected>Select a Student</option>
                            @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->fname }} {{ $student->lname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guidance">Person in Charge:</label>
                        <select class="form-control" id="guidance" name="guidance">
                            <option value="" disabled selected>Select a professor:</option>
                            @foreach($guidance as $guidances)
                                <option value="{{ $guidances->id }}">{{ $guidances->fname }} {{ $guidances->lname }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCoaching">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var SITEURL = "{{ url('/') }}";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: SITEURL + "/fullcalender",
        displayEventTime: true,
        eventRender: function (event, element, view) {
            var displayTitle = event.title;
            element.find('.fc-title').html(displayTitle);
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay, jsEvent, view) {
            var clickedDate = start.format('YYYY-MM-DD');
            openCoachingForm(clickedDate);
        },
        eventDrop: function (event, delta, revertFunc) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var displayTitle = event.title;
            $.ajax({
                url: SITEURL + '/fullcalenderAjax',
                data: {
                    title: displayTitle,
                    start: start,
                    end: end,
                    id: event.id,
                    type: 'update'
                },
                type: "POST",
                success: function (response) {
                    displayMessage("Event Updated Successfully");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    revertFunc();
                }
            });
        },
        eventClick: function (event, jsEvent, view) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: SITEURL + '/fullcalenderAjax',
                    data: {
                        id: event.id,
                        type: 'delete'
                    },
                    success: function (response) {
                        calendar.fullCalendar('removeEvents', event.id);
                        displayMessage("Event Deleted Successfully");
                    }
                });
            }
            },
            overlap: false,
        });
    });
    function isTimeSlotAvailable(start, end, events) {
        for (let i = 0; i < events.length; i++) {
            if (
                (start >= events[i].start && start < events[i].end) ||
                (end > events[i].start && end <= events[i].end)
                ) {
                return false;
            }
        }
        return true;
    }
    
    function openCoachingForm(date) {
        $('#coachingDate').val(date);
        $('#coachingModal').modal('show');
    }
    
    $('#saveCoaching').click(function () {
        var SITEURL = "{{ url('/') }}";
        var formData = $('#coachingForm').serialize();
        var start = $('#coachingDate').val() + ' ' + $('#starttime').val();
        var end = $('#coachingDate').val() + ' ' + $('#endtime').val();
        var events = $('#calendar').fullCalendar('clientEvents');
        
        if (isTimeSlotAvailable(start, end, events)) {
            $.ajax({
                url: SITEURL + "/fullcalenderAjax?type=add",
                type: "POST",
                data: formData,
                success: function (data) {
                    displayMessage("Event Created Successfully");
                    $('#coachingModal').modal('hide');
                    $('#calendar').fullCalendar('refetchEvents');
                }
            });
        } 
        else {
            displayMessage("Time slot is already taken. Please choose a different time.");
            alert('Time slot is already taken. Please choose a different time.');
        }
    });
    
    function displayMessage(message) {
        toastr.success(message, 'Event');
        }
        </script>
        
        <script>
        $(document).on('show.bs.modal', '#coachingModal', function() {
            var studentDropdown = $('#student');
            studentDropdown.empty();
            studentDropdown.append('<option value="" disabled selected>Select a Student</option>');
            @foreach($students as $student)
            studentDropdown.append('<option value="{{ $student->id }}">{{ $student->fname }} {{ $student->lname }}</option>');
            @endforeach
        });
        </script>
</body>
</html>
