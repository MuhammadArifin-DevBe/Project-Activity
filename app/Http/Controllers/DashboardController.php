<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $activities = $user->hasRole('admin')
            ? ActivityForm::with('creator')->latest()->take(5)->get()
            : $user->activityForms()->latest()->take(5)->get();



        return view('dashboard', compact('activities'));
    }
}
