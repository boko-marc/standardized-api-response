<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, JsonResponseTrait;


    public function index()
    {
        $users = User::get();

        return JsonResponseTrait::success('Get users', $users);
    }

    public function show(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!is_null($user)) {
            return JsonResponseTrait::success('User found', $user);
        }
        return JsonResponseTrait::error('User not found');
    }
}
