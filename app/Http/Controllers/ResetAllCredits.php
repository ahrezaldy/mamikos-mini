<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ResetAllCredits extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = User::where('type', '!=', User::ADMIN_ROLE)->get();
        foreach ($users as $user) {
            $data = [];
            if ($user->type === User::REGULAR_USER_ROLE) {
                $data['credits'] = 20;
            } elseif ($user->type === User::PREMIUM_USER_ROLE) {
                $data['credits'] = 40;
            }
            $user->update($data);
        }
        return $users;
    }
}
