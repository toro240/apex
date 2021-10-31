<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordPostRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ChangePasswordController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('changePassword');
    }

    public function update(ChangePasswordPostRequest $request): RedirectResponse
    {
        $password = $request->get('password');
        $confirmPassword = $request->get('confirmPassword');
        if ($password !== $confirmPassword) {
            return Redirect::back()->withInput()->withErrors(array('message' => 'Password are not matching.'));
        }

        $user = Auth::user();
        User::updatePassword($user->id, $password);

        return Redirect::to('/home');
    }
}
