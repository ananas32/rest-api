<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class TaskController extends Controller
{
    public function getInfo($id)
    {
        $url = url('api/tasks/' . $id);
        $response = Curl::to($url)
            ->get();
        return json_decode($response);
    }

    public function show($id)
    {
        $task = $this->getInfo($id);
        return view('task-show', compact('task', 'json'));
    }

    public function edit($id)
    {
        $task = $this->getInfo($id);
        $path = '/api/tasks/' . $task->id;
        $method = 'PUT';
        $users = $this->getUsers();

        return view('task-create-edit', compact('task', 'json', 'path', 'method', 'users'));
    }

    public function create()
    {
        $path = '/api/tasks/';
        $method = 'POST';
        $users = $this->getUsers();
        return view('task-create-edit', compact('users', 'task', 'json', 'path', 'method'));
    }

    public function getUsers()
    {
        $url = url('api/users?paginate=false');
        return json_decode(Curl::to($url)->get())   ;
    }
}
