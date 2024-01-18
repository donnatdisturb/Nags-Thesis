{{-- @extends('layouts.app')
@section('content')

@endsection --}}
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
<!----------- CREATE MODAL ----------->
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

<!------------------------CONFIRMATION MODAL--------------------------->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Do you want to update or delete this event?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="updateEventBtn">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteEventBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!--------------------UPDATE MODAL--------------------------->
 <div class="modal fade" id="updateCoachingModal" tabindex="-1" role="dialog" aria-labelledby="updateCoachingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coachingModalLabel">Update Coaching Schedule:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="updateCoachingForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="updateEventId" name="id">
        <div class="form-group">
            <label for="updateCoachingDate">Date</label>
            <input type="date" class="form-control" id="updateCoachingDate" name="coachingDate">
        </div>
        <div class="form-group">
            <label for="updateStartTime">Start Time</label>
            <input type="time" class="form-control" id="updateStartTime" name="starttime">
        </div>
        <div class="form-group">
            <label for="updateEndTime">End Time</label>
            <input type="time" class="form-control" id="updateEndTime" name="endtime">
        </div>
        <div class="form-group">
            <label for="updateStudentName">Student Name</label>
            <input type="text" class="form-control" id="updateStudentName" name="updateStudentName" disabled>
        </div>
        <div class="form-group">
            <label for="updateProfessorName">Professor Name</label>
            <input type="text" class="form-control" id="updateProfessorName" name="updateProfessorName" disabled>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="UpdateCoaching">Update</button>
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
            }
        });
    });

      function openCoachingForm(date) {
            $('#coachingDate').val(date);
            $('#coachingModal').modal('show');
        }

        $('#saveCoaching').click(function () {
            var SITEURL = "{{ url('/') }}";
            var formData = $('#coachingForm').serialize();

$(document).ready(function () {
    var SITEURL = "{{ url('/') }}";
    var today = moment().startOf('day');
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
            if (start.isBefore(today)) {
                alertMessage("Date is passed due. Please select another date");
            return;
        } else {
            var clickedDate = start.format('YYYY-MM-DD');
            openCoachingForm(clickedDate);
        }
        },
        eventClick: function (event, jsEvent, view) {
    $('#confirmationModal').modal('show');
    
    $('#updateEventBtn').click(function() {
    var eventId = event.id; 
    var studentName = event.studentName; 
    var professorName = event.professorName;
    $('#updateCoachingDate').val(event.start.format('YYYY-MM-DD'));
    $('#updateStartTime').val(event.start.format('HH:mm'));
    $('#updateEndTime').val(event.end.format('HH:mm'));
    $('#updateStudentName').val(studentName);
    $('#updateProfessorName').val(professorName);

    $('#updateCoachingModal').modal('show');
    $('#confirmationModal').modal('hide');
});

$('#UpdateCoaching').click(function () {
    var eventId = event.id;
    var updatedCoachingDate = $('#updateCoachingDate').val();
    var updatedStartTime = $('#updateStartTime').val();
    var updatedEndTime = $('#updateEndTime').val();
    console.log("eventId: " + eventId);
    console.log("updatedCoachingDate: " + updatedCoachingDate);
    console.log("updatedStartTime: " + updatedStartTime);
    console.log("updatedEndTime: " + updatedEndTime);

    $.ajax({
        url: SITEURL + '/fullcalenderAjax',
        data: {
            id: eventId,
            coachingDate: updatedCoachingDate,
            starttime: updatedStartTime,
            endtime: updatedEndTime,
            type: 'update'
        },
        type: "POST",
        success: function (response) {
            displayMessage("Event Updated Successfully");
            $('#updateCoachingModal').modal('hide');
            $('#calendar').fullCalendar('refetchEvents'); 
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
});

    $('#deleteEventBtn').click(function() {
        var eventId = event.id; 
        $.ajax({
            url: SITEURL + '/fullcalenderAjax',
            data: {
                id: eventId,
                type: 'delete'
            },
            type: "POST",
            success: function (response) {
                displayMessage("Event Deleted Successfully");
                $('#confirmationModal').modal('hide');
                $('#calendar').fullCalendar('removeEvents', eventId);
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });
},


            overlap: false,
            
        });
    });
    
    function isTimeSlotAvailable(start, end, events) {
        for (let i = 0; i < events.length; i++) {
            if (
                (start >= events[i].start && start < events[i].end) ||
                (end > events[i].start && end <= events[i].end) ||
                (start <= events[i].start && end >= events[i].end)
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

        function alertMessage(message) {
    toastr.error(message, 'Event', { "positionClass": "toast-top-right" }); // Use toastr to display a red error message
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

