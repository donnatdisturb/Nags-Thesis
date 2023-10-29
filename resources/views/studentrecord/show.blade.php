@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12 col-md-offset-12">
            {{-- <h1>GROOMING SERVICE DETAIL</h1> --}}

            <br>
            <img src="{{ asset('images/31.png') }}" width="1090px" style="padding:5px; margin:0px" />
            <BR>
            <div>
                <a href="{{ route('studentrecordindex') }}" class="btn btn-success" role="button">Back</a>
            </div>


            <div class="form-group">
                {{-- <label for="description" class="control-label">evidence</label> --}}
                <br>
                <video width="1125" height="auto" controls>
                    <source src="{{ URL::asset('/storage/videos/' . $studentrecords->evidence) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>


            {{-- 
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
        </div> --}}
        </div>


        </form>
    </div>
@endsection
