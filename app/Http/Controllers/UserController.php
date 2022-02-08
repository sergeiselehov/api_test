<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Classes\User\CreateUser;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUser $createUser
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request, CreateUser $createUser): JsonResponse
    {
        $user = $createUser($request->all());
        return response()->json($user);
    }
}
