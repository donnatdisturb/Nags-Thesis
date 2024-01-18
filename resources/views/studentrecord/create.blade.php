@extends('layouts.app')
@section('content')
    <style>
        textarea {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            background-color: white;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
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

<div class="image-container">
    <img src="{{ asset('images/30.png') }}" alt="Flexible Image">
</div>
    <div class="container">
        <div id="time"></div>

        <form method="POST" action="{{ route('studentrecord.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="date_recorded" class="control-label">Date Recorded</label>
                <input type="date" class="form-control" id="date_recorded" name="date_recorded" required="true">
                @if ($errors->has('date_recorded'))
                    <small>{{ $errors->first('date_recorded') }}</small>
                @endif
            </div>
          
            {{-- <div class="form-group">
                <label for="section">Year Level:</label><br>
                @foreach ($Yearlevel as $yearLevelId => $yearLevelName)
                    <label class="radio">
                        <input type="radio" name="year_level" value="{{ $yearLevelId }}"> {{ $yearLevelName }}
                    </label><br>
                @endforeach
            </div> --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>Year Level</th>
                        {{-- <th>Select</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Yearlevel as $yearLevelId => $yearLevelName)
                        <tr>
                            <td>{{ $yearLevelName }}</td>
                            <td>
                                <label class="radio">
                                    <input type="radio" name="year_level" value="{{ $yearLevelId }}"> Select
                                </label>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>     

            <div class="form-group">
                <label for= "section">Section:</label><br>
                @foreach ($sections as $sectionId => $sectionName)
                    <label class="radio">
                        <input type="radio" name="section" value="{{ $sectionId }}"> {{ $sectionName }}
                    </label><br>
                @endforeach
            </div>
    
            <div class="form-group">
                <label for="student_id">Student</label>
                {!! Form::select('student_id', $students, null, [
                    'class' => 'form-control',
                    'id' => 'student_id',
                ]) !!}
            </div>
          
            <div class="form-group">
                <label for="violation_id">Violation:</label>
                <br>
                @foreach ($violations as $violationId => $violationStatement)
                    <label class="radio">
                        <input type="radio" name="violation_id" value="{{ $violationId }}" class="violation-radio"> {{ $violationStatement }}
                    </label><br>
                @endforeach
            </div>

            {{-- <div class="form-group">
                <label for="violation_id">Violation:</label>
                <select name="violation_id" class="form-control">
                    @foreach ($violations as $violationId => $violationStatement)
                        <option value="{{ $violationId }}">{{ $violationStatement }}</option>
                    @endforeach
                </select>
            </div> --}}
            {{-- <div class="form-group">
                <label for="violation_id">Violations:</label>
                <br>
                @foreach ($violations as $violationId => $violationStatement)
                    <div class="form-check">
                        <input type="checkbox" name="violation_id[]" value="{{ $violationId }}" class="form-check-input">
                        <label class="form-check-label">{{ $violationStatement }}</label>
                    </div>
                @endforeach
            </div> --}}
            
            <div class="form-group">
                <label for="punishment">Offense Count:</label>
                <input type="text" class="form-control" id="offenseCount" name="offenseCount" readonly>
            </div>
            
            <div class="form-group">
                <label for="punishment">Punishment:</label>
                <input type="text" class="form-control" id="punishment" name="punishment" readonly>
            </div>

            <div class="form-group">
                <label for="remarks">Remarks:</label>
                <input type="text" class="form-control" id="remarks" name="remarks" >
            </div>

            <div class="form-group ">
                <label for="image" class="control-label">Upload evidence if you any:</label>
                <input type="file" class="form-control" id="video" name="video">
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
        </form>
    </div>

    <script type="text/javascript">

        document.addEventListener("DOMContentLoaded", function() {
            function showTime() {
                var timeElement = document.getElementById('time');
                if (timeElement) {
                    var date = new Date();
                    var utcDate = new Date(date.toUTCString());
                    utcDate.setHours(utcDate.getHours() + 8);
                    var usDate = new Date(utcDate);
                    timeElement.innerHTML = usDate.toUTCString();
                }
            }

            setInterval(showTime, 1000);
        });
    </script>

    <script>
        $(document).ready(function () {
            var selectedStudentId;
            var studentsDropdown = $('#student_id');
            var originalStudentsData = {!! json_encode($studentsWithYearLevel) !!};
            console.log(originalStudentsData);

             // Function to get the offense level for the selected student and violation
        function getOffenseLevel(studentId, violationId) {
            console.log('Student ID:', studentId);
            console.log('Violation ID:', violationId);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/getOffenseLevel', // Adjust the URL to match your route
                method: 'POST',
                data: {
                    studentId: studentId,
                    violationId: violationId,
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
                },
                success: function (response) {
    // Update the offense count text box
    updateOffenseCount(response.offenseLevel);

    // Update the punishment text box and punishment ID text box
    updatePunishmentAndId(response.punishment, response.punishmentId);
},
            });
        }

        studentsDropdown.on('change', function () {
            selectedStudentId = studentsDropdown.val();
            console.log('Selected Student ID:'+selectedStudentId)
            updatePunishment();
        });

        $('.violation-radio').on('change', function () {
    updatePunishment();
});


        function updatePunishment() {
    if (selectedStudentId) {
        var selectedViolationId = $('input[name="violation_id"]:checked').val();
        if (selectedViolationId) {
            getOffenseLevel(selectedStudentId, selectedViolationId);
        }
    }
}

function updateOffenseCount(offenseLevel) {
    $('#offenseCount').val(offenseLevel);
}


function updatePunishmentAndId(punishment, punishmentId) {
    $('#punishment').val(punishment);
    $('#punishmentId').val(punishmentId);
}

        $('.violation-radio:checked').change();
    
            $('input[name="year_level"], input[name="section"]').on('change', function () {
                var selectedYearLevel = $('input[name="year_level"]:checked').val();
                var selectedSection = $('input[name="section"]:checked').val();
                var filteredStudents = {};

                $.each(originalStudentsData, function (studentId, studentsWithYearLevel) {
                    var studentYearLevel = studentsWithYearLevel.year_level;
                    var studentSection = studentsWithYearLevel.section;
                    var studentId = studentsWithYearLevel.id;
                    if ((selectedYearLevel === "" || studentYearLevel == selectedYearLevel) &&
                    (selectedSection === "" || studentSection == selectedSection)) {
                        filteredStudents[studentId] = studentsWithYearLevel.fname + ' ' + studentsWithYearLevel.lname ;
                    }
                });
                console.log('Selected Year Level:', selectedYearLevel);
                console.log('Selected Section:', selectedSection);
                console.log('Filtered Students:', filteredStudents);

                studentsDropdown.empty();
                studentsDropdown.append($('<option>', {
                    value: '',
                    text: '--- Select Student ---'
                }));
                
                $.each(filteredStudents, function (studentId, studentName) {
                    studentsDropdown.append($('<option>', {
                        value: studentId,
                        text: studentName
                    }));
                });
            });
        });
    </script>
    
@endsection