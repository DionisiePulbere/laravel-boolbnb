<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Sponsorship;
use App\Models\View;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();

        $user->load('apartments.messages', 'apartments.views');
        $apartmentsCount = $user->apartments->count();
        $messagesCount = $user->apartments->pluck('messages')->flatten()->count();
        $sponsorsCount = $user->apartments()->where('visibility', 1)->count();
        $viewsCount = $user->apartments->pluck('views')->flatten()->count();
        

        $userData = [
            'total_apartments' => $apartmentsCount,
            'total_sponsors' => $sponsorsCount,
            'total_views' => $viewsCount,
            'total_messages' => $messagesCount,
        ];

        // $data = [
        //     'user' => $user,
        //     'totalSponsors' => $totalSponsors,
        //     'totalViews' => $totalViews,
        //     'totalMessages' => $totalMessages,
        // ];

        return view('admin.dashboard', compact('userData'));
    }
}
