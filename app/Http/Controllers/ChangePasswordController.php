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
    /**
     * 初回パスワード変更画面
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('changePassword');
    }

    /**
     * 初回パスワード変更処理
     * @param ChangePasswordPostRequest $request
     * @return RedirectResponse
     */
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
