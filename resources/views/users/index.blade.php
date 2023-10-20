@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    {{-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"> --}}
    {{-- <h1 class="m-0">{{ __('Users') }}</h1> --}}
    <br>
    {{-- <h2 style="text-align: center; font-weight: 1000">LIST OF ALL USERS IN THE SYSTEM</h2>
        <hr style= "position: relative; top: 20px; border: none; height: 10px; background: #2c1616; margin: 10px;"> --}}
    <img src="{{ asset('images/12.png') }}" width="1269px" style="padding:5px; margin:0px" />
    <BR>
    {{-- </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div> --}}
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    {{-- <div class="alert alert-info">
                        Sample table page
                    </div> --}}

                    <div class="card">
                        <div class="card-body p-0">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{ $users->links() }}
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
