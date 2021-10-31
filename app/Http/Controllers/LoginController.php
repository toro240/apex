<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginPostRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('login');
    }

    public function login(LoginPostRequest $request): View|Factory|RedirectResponse|Application
    {
        $name = $request->get('name');
        $password = $request->get('password');
        $user = User::getAuthorizationUser($name, $password);
        if (is_null($user)) {
            return Redirect::back()->withInput()->withErrors(array('message' => 'Incorrect Name or Password.'));
        }

        Auth::login($user);
        \Log::debug(print_r($user, true));
        return $user->is_change_password ? Redirect::to('/home') : Redirect::to('/changePassword');
    }
}
