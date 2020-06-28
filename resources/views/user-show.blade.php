@extends('layouts.app')
@section('content')
    <div class="container">
        User # {{ $user->user_id }} <a href="{{ url('users') }}">back</a>
        <div class="row">
            <div class=".col-md-6"><b>Name</b>:</div>
            <div class=".col-md-6">{{ $user->first_name }}</div>
        </div>
        <div class="row">
            <div class=".col-md-6"><b>Last name</b>:</div>
            <div class=".col-md-6">{{ $user->last_name }}</div>
        </div>
        <div class="row">
            <div class=".col-md-6"><b>Email</b>:</div>
            <div class=".col-md-6">{{ $user->email }}</div>
        </div>
        <div class="row">
            <div class=".col-md-6"><b>Created at</b>:</div>
            <div class=".col-md-6">{{ $user->created_at }}</div>
        </div>
        <div class="row">
            <div class=".col-md-6"><b>Updated at</b>:</div>
            <div class=".col-md-6">{{ $user->updated_at }}</div>
        </div>
    </div>
@endsection
