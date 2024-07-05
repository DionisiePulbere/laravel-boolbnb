<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Sponsorship;
use App\Models\View;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        $totalSponsors = Sponsorship::count();
        $totalViews = View::count();
        $totalMessages = Message::count();

        $data = [
            'user' => $user,
            'totalSponsors' => $totalSponsors,
            'totalViews' => $totalViews,
            'totalMessages' => $totalMessages,
        ];

        return view('admin.dashboard', $data);
    }
}
