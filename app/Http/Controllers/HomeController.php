<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(): Factory|View|Application
    {
        $user = Auth::user();
        return view('home', [
            'isJoinedGroup' => GroupMember::whereUserId($user->id)->exists()
        ]);
    }
}
