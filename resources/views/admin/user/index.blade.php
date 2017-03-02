@extends('layout.admin')

@section('custom-styles')
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Category</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{URL::route('admin.home')}}">Home</a>
                </li>
                <li class="active">
                    <a href="#">User</a>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>User Account Directory</h5>
            </div>
            <div class="ibox-content">
                {{ Form::open(array('url' => '/admin/users/', 'class' => 'user-search-form', 'method' => 'GET')) }}
                <h4>Search by:</h4>
                <div class="row m-b">
                    <div class="col-sm-4 m-b">
                        {{ Form::text('username', $username,
                            array('class'=>'form-control input-lg', 'maxlength' => 25, 'placeholder' => 'Username')) }}
                    </div>
                    <div class="col-sm-1"><label style="line-height: 42px;">and/or</label></div>
                    <div class="col-sm-4 m-b">
                        {!! Form::text('email', $email, array('class'=>'form-control input-lg', 'maxlength' => 25, 'placeholder' => 'Email')) !!}
                    </div>
                    <div class="col-sm-2"><button class="btn btn-lg btn-primary" type="submit">Submit</button></div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Result</h5>
            </div>
            <div class="ibox-content">
            @if (isset($users))
                <table class="table user-table">
                  <thead>
                    <tr>
                        <th>Username</th>
                        <th>User Info</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Posted Jobs</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($users as $user)
                    <tr>
                        <td class="text-center" width="100">
                            <img src="{{ userImageSmall($user) }}" style="width: 70px; height: 70px; border-radius: 50%;"/>
                            <h5>{{ full_name($user) }}</h5>
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->jobs->count() }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
            @endif
            </div>
        </div>
    </div>
@stop

@section('custom-scripts')
    <script>
        TradeAdmin.init();
    </script>
@endsection

