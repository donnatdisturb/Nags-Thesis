{{-- @extends('dashboard') --}}
@extends('layouts.app')
@section('content')
    <br>
    <img src="{{ asset('images/3.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <link href="{{ URL::asset('css/searchstyle.css') }}" rel="stylesheet">

    <div class="container">

        <br>

        <form action="{{ route('studsearch') }}" method="GET" class="forms">
            <input type="search" placeholder="Search" class="search-field" name="search" required />
            <button type="submit" class="search-button">
                <img src="https://www.kindacode.com/wp-content/uploads/2020/12/search.png">
            </button>
        </form>

        <br />
        @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div><br />
        @endif

        <table class="table table-striped">
            <tr>
                <a href="{{ route('studentrecordindex') }}" class="btn btn-success a-btn-slide-text">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    <span><i class="fa fa-refresh"></i><strong> REFRESH</strong></span>
                </a>

                <a href="{{ route('studentrecord.create') }}" class="btn btn-primary a-btn-slide-text">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    <span><i class="fa fa-plus"></i><strong> ADD NEW STUDENT VIOLATION RECORD</strong></span>
                </a>
                <br>
            </tr>
            <br>

            {{-- <tr>{{ link_to_route('studentrecord.create', 'Add new Student Violation Record:')}}</tr> --}}
            <thead>
                <tr>
                    <th>Student Record ID</th>
                    <th>Date Recorded</th>
                    <th>Remarks </th>
                    <th>Student</th>
                    <th>Violation </th>
                    <th>Punishment</th>
                    <th>Guidance</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Review Evidence</th>

                </tr>
            </thead>
            <tbody>


                @foreach ($studentrecords as $studentrecord)
                    <tr>
                        <td>{{ $studentrecord->id }}</td>
                        <td>{{ $studentrecord->date_recorded }}</td>
                        <td>{{ $studentrecord->remarks }}</td>
                        <td>{{ $studentrecord->students->fname }} {{ $studentrecord->students->lname }}</td>
                        <td>{{ $studentrecord->violations->name }}</td>
                        <td>{{ $studentrecord->violations->punishments->name }}</td>
                        <td>{{ $studentrecord->guidances->fname }}</td>
                        <td>{{ $studentrecord->status }}</td>

                        <td>
                            <form action="{{ url('/studentrecord/update/' . $studentrecord->id) }}" method="get"
                                class="forms">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <select name="status" id="type" class="form-select">
                                    <?php $statuss = ['APPROVED', 'DISAPPROVED']; ?>
                                    @foreach ($statuss as $status)
                                        <option value={{ $status }}
                                            {{ old('status') == $status ? 'selected' : '' }}>
                                            {{ $status }}</option>
                                    @endforeach
                                    @if ($errors->has('status'))
                                        <small>{{ $errors->first('status') }}</small>
                                    @endif
                                </select>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </td>

                        {{-- <td> --}}
                        <td><a href="{{ route('studentrecord.show', $studentrecord->id) }}" class="btn btn-danger">Show</a>
                        </td>

                        </td>

                        </form>
                @endforeach


            </tbody>
        </table>
        <br>
        {{-- For Pagination --}}
        {!! $studentrecords->links() !!}
    </div>
@endsection
