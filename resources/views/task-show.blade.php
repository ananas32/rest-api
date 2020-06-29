@extends('layouts.app')
@section('content')
    <div class="container">
        Task # {{ $task->id }} <a href="{{ url('tasks') }}">back</a>
        <div class="row">
            <div class=".col-md-6"><b>Title</b>:</div>
            <div class=".col-md-6">{{ $task->title }}</div>
        </div>
        <div class="row">
            <div class=".col-md-6"><b>Description</b>:</div>
            <div class=".col-md-6">{{ $task->description }}</div>
        </div>
        <div class="row">
            <div class=".col-md-6"><b>User id</b>:</div>
            <div class=".col-md-6">{{ $task->user_id }}</div>
        </div>
        <div class="row">
            <div class=".col-md-6"><b>Status</b>:</div>
            <div class=".col-md-6">{{ $task->status }}</div>
        </div>
        <div class="row">
            <div class=".col-md-6"><b>Created at</b>:</div>
            <div class=".col-md-6">{{ $task->created_at }}</div>
        </div>
        <div class="row">
            <div class=".col-md-6"><b>Updated at</b>:</div>
            <div class=".col-md-6">{{ $task->updated_at }}</div>
        </div>
    </div>
@endsection
