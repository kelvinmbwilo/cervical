@extends("layout.master")

@section('title')
User Management
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