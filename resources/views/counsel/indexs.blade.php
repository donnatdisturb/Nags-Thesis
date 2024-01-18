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
    <!-- ... (rest of your modal code) ... -->
</div>

<!------------------------CONFIRMATION MODAL--------------------------->
<!-- ... (rest of your confirmation modal code) ... -->

<!--------------------UPDATE MODAL--------------------------->
<!-- ... (rest of your update modal code) ... -->

<script>
    // ... (rest of your JavaScript code) ...
</script>

<script>
    // ... (rest of your JavaScript code) ...
</script>

</body>
</html>