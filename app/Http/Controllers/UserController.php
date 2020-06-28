<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class UserController extends Controller
{
    public function getInfo($id)
    {
        $url = url('api/users/' . $id);
        $response = Curl::to($url)
            ->get();
        return json_decode($response);
    }

    public function show($id)
    {
        $user = $this->getInfo($id);
        return view('user-show', compact('user', 'json'));
    }

    public function edit($id)
    {
        $user = $this->getInfo($id);
        $path = '/api/users/'.$user->user_id;
        $method = 'PUT';
        return view('user-create-edit', compact('user', 'json', 'path', 'method'));
    }

    public function create()
    {
        $path = '/api/users/';
        $method = 'POST';
        return view('user-create-edit', compact('user', 'json', 'path', 'method'));
    }
}
