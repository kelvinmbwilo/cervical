@extends("layout.master")

@section('title')
Users
@stop
@section('subtitle')
User management
@stop
@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Users</li>

@stop

@section('contents')
<div id="listuser">
        @include('user.list')
</div>
@stop