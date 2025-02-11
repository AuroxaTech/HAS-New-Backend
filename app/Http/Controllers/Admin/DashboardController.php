<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalLandlords = User::where('role', 'landlord')->count();
        $totalServiceProviders = User::where('role', 'service_provider')->count();
        $totalVisitors = User::where('role', 'visitor')->count();
        $totalTenants = User::where('role', 'tenant')->count();

        return view('partials.dashboard.index', compact('totalUsers', 'totalLandlords', 'totalServiceProviders', 'totalVisitors', 'totalTenants'));
    }
    public function getLandlord()
    {

        $data = User::where('role', 'landlord')->get();
        return view('partials.dashboard.landlord', compact('data'));
    }

    public function getVisitor()
    {

        $data = User::where('role', 'visitor')->get();
        return view('partials.dashboard.visitor', compact('data'));
    }

    public function getServiceProvider()
    {

        $data = User::where('role', 'service_provider')->get();
        return view('partials.dashboard.service_provider', compact('data'));
    }

    public function getTenant()
    {

        $data = User::where('role', 'tenant')->get();
        return view('partials.dashboard.tenant', compact('data'));
    }
}
