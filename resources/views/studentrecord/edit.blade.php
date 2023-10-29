@extends('layouts.app')
@section('content')
    <style>
        body {
            background: #C7AD7F;
        }

        textarea {
            /*resize: none;
                                                                                                                                                                                                                                          border: 1px solid #ced4da;
                                                                                                                                                                                                                                          padding: .375rem .75rem;
                                                                                                                                                                                                                                          color: #495057;*/
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
    </style>

    <br>
    <img src="{{ asset('images/17.png') }}" width="1090px" style="padding:5px; margin:0px" />
    <BR>

    <div class="container">
        <h2>Edit Student Record</h2>
        {{ Form::model($studentrecords, ['route' => ['students.update', $studentrecords->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        {{--   
   <div class="form-group" >
    <label for="student_id" class="control-label">Student:</label>
     {!! Form::select('student_id',$students, $studentrecords->student_id,['class' => 'form-control form-select']) !!}
    @if ($errors->has('student_id'))
     <div class="alert alert-danger">{{ $errors->first('student_id') }}</div>
    @endif 
</div>  --}}

        {{-- <div class="form-group">
            <label for="description" class="control-label">Student ID:</label>
            <input type="text" class="form-control" id="student_id" name="student_id"
                value="{{ $studentrecords->students->id }}" readonly="readonly">
            @if ($errors->has('student_id'))
                <small>{{ $errors->first('student_id') }}</small>
            @endif
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Student Name:</label>
            <input type="text" class="form-control" id="student_name" name="student_name"
                value="{{ $studentrecords->students->fname }} {{ $studentrecords->students->lname }}" readonly="readonly">
            @if ($errors->has('counsel_id'))
                <small>{{ $errors->first('counsel_id') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="date_recorded" class="control-label">Date Recorded</label>
            <input type="date" class="form-control " id="date_recorded" name="date_recorded"
                value="{{ old('date_recorded', $studentrecords->date_recorded) }}">
            @if ($errors->has('date_recorded'))
                <div class="alert alert-danger">{{ $errors->first('date_recorded') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="remarks" class="control-label">Detailed Report</label>
            {{ Form::textarea('remarks', null, ['class' => 'form-control', 'id' => 'remarks']) }}
            @if ($errors->has('remarks'))
                <small>{{ $errors->first('remarks') }}</small>
            @endif
        </div>


        <div class="form-group">
            <label for="violation_id" class="control-label">Violation Commited:</label>
            {!! Form::select('violation_id', $violations, $studentrecords->violation_id, [
                'class' => 'form-control form-select',
            ]) !!}

            @if ($errors->has('violation_id'))
                <div class="alert alert-danger">{{ $errors->first('violation_id') }}</div>
            @endif
        </div> --}}
        <div class="container">
            <div class="col-md-12 col-md-offset-12">
                <h1>GROOMING SERVICE DETAIL</h1>

                <div class="form-group mb-3">
                    <label for=""><strong>Service Name: </strong></label>
                    <td>{{ $groomingservice->title }}</td>
                </div>
                <div class="form-group mb-3">
                    <label for=""><strong>Description: </strong></label>
                    <td>{{ $groomingservice->description }}</td>
                </div>
                <div class="form-group mb-3">
                    <label for=""><strong>Grooming Cost: </strong></label>
                    <td>{{ $groomingservice->grooming_cost }}</td>
                </div>
            </div>

            <div>
                <a href="{{ url()->previous() }}" class="btn btn-primary" role="button">Back</a>
            </div>
            </form>
        </div>

        <div class="form-group">
            <label for="description" class="control-label">evidence</label>
            {{-- <video controls alt="School Tour" style="display: block;margin-left: auto;margin-right: auto;">
                <video src="{{ asset('/storage/videos/' . $studentrecords->evidence) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video> --}}
            <br>
            <video width="1125" height="auto" controls>
                <source src="{{ URL::asset('/storage/videos/' . $studentrecords->evidence) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>



        <div class="form-group">
            <label for="description" class="control-label">Status</label>
            <select class="form-control" name="Status" value="{{ old('Status', $studentrecords->status) }}">
                {{-- <option selected>Status...</option> --}}
                <option value="APPROVED">APPROVED</option>
                <option value="DISAPPROVED">DISAPPROVED</option>

            </select>
            @if ($errors->has('status'))
                <small>{{ $errors->first('status') }}</small>
            @endif
        </div>






        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
    </div>
    </div>
    {!! Form::close() !!}
@endsection
