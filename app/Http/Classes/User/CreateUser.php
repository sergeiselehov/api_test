<?php

namespace App\Http\Classes\User;

use App\Models\User;

class CreateUser
{
    public function __invoke(array $data): User
    {
        $user = new User;
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();
        return $user;
    }
}
