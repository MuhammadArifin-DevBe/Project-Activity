<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $activities = ActivityForm::with('creator')->latest()->take(5)->get();

        $totalForms = ActivityForm::count(); // total semua form
        $totalUsers = \App\Models\User::where('role', 'user')->count(); // hanya user biasa

        return view('admin.dashboard', compact('activities', 'totalForms', 'totalUsers'));
    }


    public function userDashboard()
    {
        $activities = auth()->user()->user()->latest()->take(5)->get();
        $totalActivities = auth()->user()->user()->count();
        $latestActivity = $activities->first();

        return view('user.dashboard', compact('activities', 'totalActivities', 'latestActivity'));
    }
}
